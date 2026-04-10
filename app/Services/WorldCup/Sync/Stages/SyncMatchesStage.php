<?php

declare(strict_types=1);

namespace App\Services\WorldCup\Sync\Stages;

use App\Models\WorldCup\Stadium;
use App\Models\WorldCup\Team;
use App\Models\WorldCup\WorldCupMatch;
use App\Services\ApiFootball\ApiFootballService;
use App\Services\WorldCup\Sync\SyncStageInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

final class SyncMatchesStage implements SyncStageInterface
{
    public function __construct(private readonly ApiFootballService $api)
    {
    }

    public function name(): string
    {
        return 'matches';
    }

    public function run(array $context): array
    {
        $leagueId = (int) ($context['league_id'] ?? 0);
        $season = (int) ($context['season'] ?? 0);
        $tournamentId = (int) ($context['tournament_id'] ?? 0);

        if ($tournamentId <= 0) {
            throw new \RuntimeException('Tournament kaydı bulunamadı.');
        }

        $teams = Team::withoutGlobalScopes()
            ->where('tournament_id', $tournamentId)
            ->whereNotNull('external_id')
            ->get()
            ->keyBy('external_id');

        $stadiums = Stadium::withoutGlobalScopes()
            ->where('tournament_id', $tournamentId)
            ->whereNotNull('external_id')
            ->get()
            ->keyBy('external_id');

        $data = $this->api->getFixtures($leagueId, $season);
        $rows = $data['response'] ?? [];

        $processed = 0;
        $skipped = 0;
        $warnings = 0;

        if (empty($rows)) {
            return [
                'processed' => 0,
                'skipped' => 0,
                'warnings' => 1,
                'errors' => 0,
            ];
        }

        foreach ($rows as $row) {
            $fixture = $row['fixture'] ?? null;
            $teamsData = $row['teams'] ?? null;
            $goals = $row['goals'] ?? [];
            $score = $row['score'] ?? [];
            $league = $row['league'] ?? [];

            if (! is_array($fixture) || ! is_array($teamsData)) {
                $skipped++;
                continue;
            }

            $externalId = (string) ($fixture['id'] ?? '');
            if ($externalId === '') {
                $skipped++;
                continue;
            }

            $homeId = (string) ($teamsData['home']['id'] ?? '');
            $awayId = (string) ($teamsData['away']['id'] ?? '');

            if ($homeId === '' || $awayId === '') {
                $skipped++;
                continue;
            }

            $homeTeam = $teams->get($homeId)
                ?? $this->resolveTeam($teamsData['home'] ?? [], $tournamentId, $teams);
            $awayTeam = $teams->get($awayId)
                ?? $this->resolveTeam($teamsData['away'] ?? [], $tournamentId, $teams);

            if (! $homeTeam || ! $awayTeam) {
                $warnings++;
                $skipped++;
                continue;
            }

            $venue = $fixture['venue'] ?? [];
            $stadiumId = null;

            // API Venue Verilerini Al
            $venueId = is_array($venue) ? ($venue['id'] ?? null) : null;
            $venueName = is_array($venue) ? (trim((string) ($venue['name'] ?? ''))) : '';
            $venueCity = is_array($venue) ? (trim((string) ($venue['city'] ?? ''))) : '';

            // Standart Match-Stadium Eşleşme Mantığı (ID 4 dışındakiler için veya fallback olarak)
            if ($venueId) {
                $stadium = $stadiums->get('id:' . $venueId);
                $stadiumId = $stadium?->id;
            } elseif ($venueName !== '') {
                $fallbackKey = 'hash:' . sha1(mb_strtolower($venueName) . '|' . mb_strtolower($venueCity));
                $stadium = $stadiums->get($fallbackKey);
                $stadiumId = $stadium?->id;
            }

            $winnerTeamId = null;
            if (($teamsData['home']['winner'] ?? null) === true) {
                $winnerTeamId = $homeTeam->id;
            } elseif (($teamsData['away']['winner'] ?? null) === true) {
                $winnerTeamId = $awayTeam->id;
            }

            $record = WorldCupMatch::withoutGlobalScopes()
                ->where('tournament_id', $tournamentId)
                ->where('external_id', $externalId)
                ->first();

            if (! $record) {
                $record = new WorldCupMatch();
                $record->tournament_id = $tournamentId;
                $record->external_id = $externalId;
            }

            $record->stage = $league['round'] ?? $record->stage;
            $record->round_name = $league['round'] ?? $record->round_name;
            $record->match_number = $fixture['id'] ?? $record->match_number;
            $record->home_team_id = $homeTeam->id;
            $record->away_team_id = $awayTeam->id;
            $record->stadium_id = $stadiumId;
            $record->winner_team_id = $winnerTeamId;
            $record->kickoff_at = isset($fixture['date']) ? Carbon::parse($fixture['date']) : $record->kickoff_at;
            $record->status = $fixture['status']['short'] ?? $record->status;
            $record->home_score = $goals['home'] ?? $record->home_score;
            $record->away_score = $goals['away'] ?? $record->away_score;
            $record->home_penalty_score = $score['penalty']['home'] ?? $record->home_penalty_score;
            $record->away_penalty_score = $score['penalty']['away'] ?? $record->away_penalty_score;
            $record->referee = $fixture['referee'] ?? $record->referee;
            $record->attendance = $fixture['attendance'] ?? $record->attendance;
            $record->summary_api = $fixture['status']['long'] ?? $record->summary_api;

            // Helper Venue Alanlarını Doldur
            $record->venue_name_api = $venueName !== '' ? $venueName : $record->venue_name_api;
            $record->venue_city_api = $venueCity !== '' ? $venueCity : $record->venue_city_api;
            $record->venue_external_id_api = $venueId ? (string) $venueId : $record->venue_external_id_api;

            // FAZ 7 & 8 — Guard: Tournament ID 4 (2026 World Cup) için Match-Stadium Protection
            if ($tournamentId) {
                if ($record->is_locked) {
                    // Kilitli kaydı atla (stadium_id dokunma)
                } else {
                    // Canonical mapping kontrol et (slot_number üzerinden)
                    if ($record->slot_number) {
                        $canonicalMap = \Illuminate\Support\Facades\DB::table('world_cup_match_stadium_map')
                            ->where('tournament_id', $tournamentId)
                            ->where('slot_number', $record->slot_number)
                            ->first();

                        if ($canonicalMap) {
                            // EK GUARD 1 — HARD LOCK: Canonical mapping varsa ZORLA set et
                            $record->stadium_id = $canonicalMap->stadium_id;
                        } else {
                            // EK GUARD 2 — FAIL SAFE: Mapping yoksa stadium_id DEĞİŞTİRME
                        }
                    }
                }
            }
 else {
                // Diğer turnuvalar için standart akış (API verisini kabul et)
                $record->stadium_id = $stadiumId;
            }

            $record->save();
            $processed++;
        }

        return [
            'processed' => $processed,
            'skipped' => $skipped,
            'warnings' => $warnings,
            'errors' => 0,
        ];
    }

    /**
     * @param array<string, mixed> $teamData
     */
    private function resolveTeam(array $teamData, int $tournamentId, \Illuminate\Support\Collection $teams): ?Team
    {
        $externalId = (string) ($teamData['id'] ?? '');
        $name = trim((string) ($teamData['name'] ?? ''));

        if ($externalId === '' || $name === '') {
            return null;
        }

        $existing = Team::withoutGlobalScopes()
            ->where('tournament_id', $tournamentId)
            ->where('external_id', $externalId)
            ->first();

        if ($existing) {
            $teams->put($externalId, $existing);
            return $existing;
        }

        $record = new Team();
        $record->tournament_id = $tournamentId;
        $record->external_id = $externalId;
        $record->name_api = $name;
        $record->short_name_api = $teamData['code'] ?? null;
        $record->fifa_code = $teamData['code'] ?? null;
        $record->flag_image_api = $teamData['logo'] ?? null;
        $record->slug = $this->resolveUniqueSlug(Str::slug($name), $tournamentId, null);
        $record->save();

        $teams->put($externalId, $record);

        return $record;
    }

    private function resolveUniqueSlug(string $baseSlug, int $tournamentId, ?int $recordId): string
    {
        $slug = $baseSlug !== '' ? $baseSlug : Str::random(8);
        $counter = 1;

        while (Team::withoutGlobalScopes()
            ->where('tournament_id', $tournamentId)
            ->where('slug', $slug)
            ->when($recordId, fn ($query) => $query->where('id', '!=', $recordId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

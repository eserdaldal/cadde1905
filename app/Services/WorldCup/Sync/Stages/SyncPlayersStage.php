<?php

declare(strict_types=1);

namespace App\Services\WorldCup\Sync\Stages;

use App\Models\WorldCup\Player;
use App\Models\WorldCup\Team;
use App\Services\ApiFootball\ApiFootballService;
use App\Services\WorldCup\Sync\SyncStageInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

final class SyncPlayersStage implements SyncStageInterface
{
    public function __construct(private readonly ApiFootballService $api)
    {
    }

    public function name(): string
    {
        return 'players';
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

        $gsTeamId = (int) Config::get('services.api_football_wc.team_id', 645);
        $gsPlayerIds = $gsTeamId > 0 ? $this->fetchPlayerIdsByTeam($gsTeamId, $season) : [];

        $processed = 0;
        $skipped = 0;
        $warnings = 0;
        $errors = 0;

        $page = 1;
        $maxPages = 50;
        $totalPages = 1;

        do {
            $data = $this->api->getPlayersByLeague($leagueId, $season, $page);
            $rows = $data['response'] ?? [];
            $paging = $data['paging'] ?? [];
            $totalPages = (int) ($paging['total'] ?? 1);

            foreach ($rows as $row) {
                $playerData = $row['player'] ?? null;
                $statistics = Arr::first($row['statistics'] ?? []);

                if (! is_array($playerData) || ! is_array($statistics)) {
                    $skipped++;
                    continue;
                }

                $externalId = (string) ($playerData['id'] ?? '');
                $name = (string) ($playerData['name'] ?? '');
                $teamId = (string) ($statistics['team']['id'] ?? '');

                if ($externalId === '' || $name === '' || $teamId === '') {
                    $skipped++;
                    continue;
                }

                $team = $teams->get($teamId);
                if (! $team) {
                    $warnings++;
                    $skipped++;
                    continue;
                }

                $record = Player::withoutGlobalScopes()
                    ->where('tournament_id', $tournamentId)
                    ->where('external_id', $externalId)
                    ->first();

                if (! $record) {
                    $record = new Player();
                    $record->tournament_id = $tournamentId;
                    $record->external_id = $externalId;
                }

                $record->team_id = $team->id;
                $record->name_api = $name;
                $record->shirt_number = $statistics['games']['number'] ?? $record->shirt_number;
                $record->position = $statistics['games']['position'] ?? $record->position;
                $record->date_of_birth = isset($playerData['birth']['date']) ? Carbon::parse($playerData['birth']['date']) : $record->date_of_birth;
                $record->nationality = $playerData['nationality'] ?? $record->nationality;
                $record->club_name_api = $statistics['team']['name'] ?? $record->club_name_api;
                $record->image_api = $playerData['photo'] ?? $record->image_api;

                if (! $record->slug) {
                    $record->slug = $this->resolveUniqueSlug(Str::slug($name), $tournamentId, $record->id);
                }

                if (! $record->gs_relation_lock && in_array((int) $externalId, $gsPlayerIds, true)) {
                    $record->is_galatasaray_related = true;
                }

                $record->save();
                $processed++;
            }

            $page++;
        } while ($page <= $totalPages && $page <= $maxPages);

        if ($processed === 0 && $skipped === 0) {
            $warnings++;
        }

        if ($page > $maxPages && $totalPages > $maxPages) {
            $warnings++;
        }

        return [
            'processed' => $processed,
            'skipped' => $skipped,
            'warnings' => $warnings,
            'errors' => $errors,
        ];
    }

    /**
     * @return array<int>
     */
    private function fetchPlayerIdsByTeam(int $teamId, int $season): array
    {
        $ids = [];
        $page = 1;
        $maxPages = 10;
        $totalPages = 1;

        do {
            $data = $this->api->getPlayersByTeam($teamId, $season, $page);
            $rows = $data['response'] ?? [];
            $paging = $data['paging'] ?? [];
            $totalPages = (int) ($paging['total'] ?? 1);

            foreach ($rows as $row) {
                $playerData = $row['player'] ?? null;
                if (! is_array($playerData)) {
                    continue;
                }

                $id = $playerData['id'] ?? null;
                if ($id) {
                    $ids[] = (int) $id;
                }
            }

            $page++;
        } while ($page <= $totalPages && $page <= $maxPages);

        return array_values(array_unique($ids));
    }

    private function resolveUniqueSlug(string $baseSlug, int $tournamentId, ?int $recordId): string
    {
        $slug = $baseSlug !== '' ? $baseSlug : Str::random(8);
        $counter = 1;

        while (Player::withoutGlobalScopes()
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

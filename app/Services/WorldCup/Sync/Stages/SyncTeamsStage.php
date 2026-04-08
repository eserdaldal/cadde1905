<?php

declare(strict_types=1);

namespace App\Services\WorldCup\Sync\Stages;

use App\Models\WorldCup\Team;
use App\Services\ApiFootball\ApiFootballService;
use App\Services\WorldCup\Sync\SyncStageInterface;
use Illuminate\Support\Str;

final class SyncTeamsStage implements SyncStageInterface
{
    public function __construct(private readonly ApiFootballService $api)
    {
    }

    public function name(): string
    {
        return 'teams';
    }

    public function run(array $context): array
    {
        $leagueId = (int) ($context['league_id'] ?? 0);
        $season = (int) ($context['season'] ?? 0);
        $tournamentId = (int) ($context['tournament_id'] ?? 0);

        if ($tournamentId <= 0) {
            throw new \RuntimeException('Tournament kaydı bulunamadı.');
        }

        $data = $this->api->getTeams($leagueId, $season);
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
            $teamData = $row['team'] ?? null;
            if (! is_array($teamData)) {
                $skipped++;
                continue;
            }

            $externalId = (string) ($teamData['id'] ?? '');
            $name = (string) ($teamData['name'] ?? '');

            if ($externalId === '' || $name === '') {
                $skipped++;
                continue;
            }

            $slug = Str::slug($name);

            $record = Team::withoutGlobalScopes()
                ->where('tournament_id', $tournamentId)
                ->where('external_id', $externalId)
                ->first();

            if (! $record) {
                $record = new Team();
                $record->tournament_id = $tournamentId;
                $record->external_id = $externalId;
            }

            $record->name_api = $name;
            $record->short_name_api = $teamData['code'] ?? $record->short_name_api;
            $record->fifa_code = $teamData['code'] ?? $record->fifa_code;
            $record->flag_image_api = $teamData['logo'] ?? $record->flag_image_api;

            if (! $record->slug) {
                $record->slug = $this->resolveUniqueSlug($slug, $tournamentId, $record->id);
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

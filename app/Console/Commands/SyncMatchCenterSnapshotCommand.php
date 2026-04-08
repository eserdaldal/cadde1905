<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Sports\SportsSnapshotSyncService;
use Illuminate\Console\Command;
use Throwable;

final class SyncMatchCenterSnapshotCommand extends Command
{
    protected $signature = 'sports:sync-match-center
                            {--team_id= : Override API_FOOTBALL_TEAM_ID}
                            {--season= : Override API_FOOTBALL_SEASON}';

    protected $description = 'Sync match center data from API-Football into sports_snapshots table';

    public function handle(SportsSnapshotSyncService $syncService): int
    {
        $teamId = (int) ($this->option('team_id') ?: config('services.api_football.team_id', 645));
        $season = (int) ($this->option('season') ?: config('services.api_football.season', 2025));

        try {
            $result = $syncService->syncMatchCenter($teamId, $season);

            $this->info('Match center snapshot sync tamamlandı.');
            $this->line('team_id: ' . (string) $result['team_id']);
            $this->line('season: ' . (string) $result['season']);
            $this->line('cache_key: ' . (string) $result['cache_key']);
            $this->line('next_match_saved: ' . ($result['next_match_saved'] ? 'true' : 'false'));
            $this->line('upcoming_count: ' . (string) $result['upcoming_count']);
            $this->line('last_matches_count: ' . (string) $result['last_matches_count']);

            return self::SUCCESS;
        } catch (Throwable $e) {
            report($e);

            $this->error('Match center snapshot sync başarısız oldu.');
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}
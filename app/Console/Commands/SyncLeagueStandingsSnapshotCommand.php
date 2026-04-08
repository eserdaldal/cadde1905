<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Sports\SportsSnapshotSyncService;
use Illuminate\Console\Command;
use Throwable;

final class SyncLeagueStandingsSnapshotCommand extends Command
{
    protected $signature = 'sports:sync-standings
                            {--league_id= : Override API_FOOTBALL_LEAGUE_ID}
                            {--season= : Override API_FOOTBALL_SEASON}
                            {--limit=20 : Standings row limit to persist}';

    protected $description = 'Sync league standings data from API-Football into sports_snapshots table';

    public function handle(SportsSnapshotSyncService $syncService): int
    {
        $leagueId = (int) ($this->option('league_id') ?: config('services.api_football.league_id', 203));
        $season = (int) ($this->option('season') ?: config('services.api_football.season', 2025));
        $resultLimit = max(1, (int) ($this->option('limit') ?: 20));

        try {
            $result = $syncService->syncLeagueStandings($leagueId, $season, $resultLimit);

            $this->info('League standings snapshot sync tamamlandı.');
            $this->line('league_id: ' . (string) $result['league_id']);
            $this->line('season: ' . (string) $result['season']);
            $this->line('result_limit: ' . (string) $result['result_limit']);
            $this->line('rows_count: ' . (string) $result['rows_count']);

            return self::SUCCESS;
        } catch (Throwable $e) {
            report($e);

            $this->error('League standings snapshot sync başarısız oldu.');
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}
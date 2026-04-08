<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\WorldCup\Sync\WorldCupSyncService;
use Illuminate\Console\Command;
use Throwable;

final class WorldCupSyncCommand extends Command
{
    protected $signature = 'worldcup:sync
                            {--stage= : Belirli bir stage (tournament,teams,stadiums,matches,players,standings)}
                            {--league_id= : API_FOOTBALL_LEAGUE_ID override}
                            {--season= : API_FOOTBALL_SEASON override}';

    protected $description = 'World Cup minimum sync (API-Football)';

    public function handle(WorldCupSyncService $syncService): int
    {
        $stage = $this->option('stage') ?: null;
        $leagueId = $this->option('league_id');
        $season = $this->option('season');

        $options = [];

        if ($leagueId !== null && $leagueId !== '') {
            $options['league_id'] = (int) $leagueId;
        }

        if ($season !== null && $season !== '') {
            $options['season'] = (int) $season;
        }

        try {
            $result = $syncService->sync($stage, $options);

            $this->info('World Cup sync tamamlandı.');
            $this->line('batch_uuid: ' . ($result['batch_uuid'] ?? ''));

            foreach (($result['results'] ?? []) as $name => $stageResult) {
                $this->line(sprintf(
                    '%s -> processed:%d skipped:%d warnings:%d errors:%d',
                    $name,
                    $stageResult['processed'] ?? 0,
                    $stageResult['skipped'] ?? 0,
                    $stageResult['warnings'] ?? 0,
                    $stageResult['errors'] ?? 0,
                ));
            }

            return self::SUCCESS;
        } catch (Throwable $e) {
            report($e);

            $this->error('World Cup sync başarısız oldu.');
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Services\WorldCup\Sync;

use App\Models\WorldCup\SyncLog;
use App\Models\WorldCup\WorldCup;
use App\Services\WorldCup\Sync\Stages\SyncMatchesStage;
use App\Services\WorldCup\Sync\Stages\SyncPlayersStage;
use App\Services\WorldCup\Sync\Stages\SyncStandingsStage;
use App\Services\WorldCup\Sync\Stages\SyncStadiumsStage;
use App\Services\WorldCup\Sync\Stages\SyncTeamsStage;
use App\Services\WorldCup\Sync\Stages\SyncTournamentStage;
use App\Services\WorldCup\DataHealth\WorldCupFetchPolicyService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Throwable;

final class WorldCupSyncService
{
    public function __construct(
        private readonly WorldCupFetchPolicyService $fetchPolicy
    ) {
    }

    /**
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function sync(?string $onlyStage = null, array $options = []): array
    {
        $leagueId = (int) ($options['league_id'] ?? Config::get('services.api_football_wc.league_id'));
        $season = (int) ($options['season'] ?? Config::get('services.api_football_wc.season'));
        $force = (bool) ($options['force'] ?? false);

        if ($leagueId <= 0 || $season <= 0) {
            throw new \InvalidArgumentException('API_FOOTBALL_WC_LEAGUE_ID ve API_FOOTBALL_WC_SEASON tanımlı olmalı.');
        }

        $batchUuid = (string) Str::uuid();
        $tournamentExternalId = $leagueId . '_' . $season;

        $tournament = WorldCup::withoutGlobalScopes()
            ->where('external_id', $tournamentExternalId)
            ->first();

        $context = [
            'league_id' => $leagueId,
            'season' => $season,
            'batch_uuid' => $batchUuid,
            'tournament_external_id' => $tournamentExternalId,
            'tournament' => $tournament,
            'tournament_id' => $tournament?->id,
            'force' => $force,
        ];

        $stages = $this->buildStages();

        if ($onlyStage !== null && ! isset($stages[$onlyStage])) {
            $valid = implode(', ', array_keys($stages));
            throw new \InvalidArgumentException('Geçersiz stage: ' . $onlyStage . '. Geçerli: ' . $valid);
        }

        $stageKeys = $onlyStage ? [$onlyStage] : array_keys($stages);
        $results = [];

        // Special handling for tournament creation
        if ($onlyStage !== 'tournament' && ! ($context['tournament_id'] ?? null)) {
            $tournamentStage = $stages['tournament'];
            $startedAt = Carbon::now();
            $results['tournament'] = $this->runStage($tournamentStage, $context, $startedAt, $batchUuid);
            
            $context['tournament'] = WorldCup::withoutGlobalScopes()
                ->where('external_id', $tournamentExternalId)
                ->first();
            $context['tournament_id'] = $context['tournament']?->id;
        }

        foreach ($stageKeys as $key) {
            if ($key === 'tournament' && isset($results['tournament'])) {
                continue;
            }

            $stage = $stages[$key];
            $startedAt = Carbon::now();

            try {
                $results[$key] = $this->runStage($stage, $context, $startedAt, $batchUuid);
            } catch (Throwable $e) {
                $this->logStage(
                    dataset: $stage->name(),
                    context: $context,
                    startedAt: $startedAt,
                    finishedAt: Carbon::now(),
                    processed: 0,
                    skipped: 0,
                    warnings: 0,
                    errors: 1,
                    status: 'failed',
                    errorSummary: $e->getMessage(),
                    batchUuid: $batchUuid,
                );

                throw $e;
            }
        }

        return [
            'batch_uuid' => $batchUuid,
            'results' => $results,
        ];
    }

    /**
     * @return array<string, SyncStageInterface>
     */
    private function buildStages(): array
    {
        return [
            'tournament' => app(SyncTournamentStage::class),
            'teams' => app(SyncTeamsStage::class),
            'stadiums' => app(SyncStadiumsStage::class),
            'matches' => app(SyncMatchesStage::class),
            'players' => app(SyncPlayersStage::class),
            'standings' => app(SyncStandingsStage::class),
        ];
    }

    /**
     * @param array<string, mixed> $context
     * @return array{processed:int, skipped:int, warnings:int, errors:int}
     */
    private function runStage(SyncStageInterface $stage, array $context, Carbon $startedAt, string $batchUuid): array
    {
        $tournamentId = $context['tournament_id'] ?? null;
        $force = $context['force'] ?? false;

        // Fetch Policy Guard
        if ($tournamentId !== null) {
            $decision = $this->fetchPolicy->shouldFetch($stage->name(), $tournamentId, $force);
            
            if (!$decision->isAllowed()) {
                $this->logStage(
                    dataset: $stage->name(),
                    context: $context,
                    startedAt: $startedAt,
                    finishedAt: Carbon::now(),
                    processed: 0,
                    skipped: 1,
                    warnings: 0,
                    errors: 0,
                    status: 'success', // Skip is considered a successful avoidance
                    errorSummary: '[' . strtoupper($decision->reason) . '] ' . ($decision->message ?? 'Atlandı'),
                    batchUuid: $batchUuid,
                );

                return [
                    'processed' => 0,
                    'skipped' => 1,
                    'warnings' => 0,
                    'errors' => 0,
                    'skip_reason' => $decision->reason
                ];
            }
        }

        $result = $stage->run($context);

        $this->logStage(
            dataset: $stage->name(),
            context: $context,
            startedAt: $startedAt,
            finishedAt: Carbon::now(),
            processed: $result['processed'],
            skipped: $result['skipped'],
            warnings: $result['warnings'],
            errors: $result['errors'],
            status: $result['errors'] > 0 ? 'partial' : 'success',
            errorSummary: null,
            batchUuid: $batchUuid,
        );

        return $result;
    }

    /**
     * @param array<string, mixed> $context
     */
    private function logStage(
        string $dataset,
        array $context,
        Carbon $startedAt,
        Carbon $finishedAt,
        int $processed,
        int $skipped,
        int $warnings,
        int $errors,
        string $status,
        ?string $errorSummary,
        ?string $batchUuid = null,
    ): void {
        SyncLog::query()->withoutGlobalScopes()->create([
            'tournament_id' => $context['tournament_id'] ?? null,
            'dataset' => $dataset,
            'source' => 'api-football',
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
            'records_processed' => $processed,
            'records_skipped' => $skipped,
            'warnings_count' => $warnings,
            'errors_count' => $errors,
            'status' => $status,
            'error_summary' => $errorSummary,
            'batch_uuid' => $batchUuid,
        ]);
    }
}

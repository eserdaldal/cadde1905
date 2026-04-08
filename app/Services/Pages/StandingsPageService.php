<?php

declare(strict_types=1);

namespace App\Services\Pages;

use App\Services\Sports\SportsSnapshotService;
use Illuminate\Support\Facades\Cache;
use Throwable;

final class StandingsPageService
{
    public function __construct(
        private readonly SportsSnapshotService $sportsSnapshotService,
    ) {
    }

    /**
     * @return array{
     *     pageTitle:string,
     *     status:string,
     *     table:array<int,array<string,mixed>>,
     *     meta:array<string,mixed>
     * }
     */
    public function build(): array
    {
        $leagueId = (int) config('services.api_football.league_id', 203);
        $season = (int) config('services.api_football.season', 2025);
        $resultLimit = 20;
        $ttlSeconds = (int) config('services.api_football.cache_ttl_league_table', 3600);

        $cacheKey = sprintf(
            'page.standings.league_%d.season_%d.limit_%d',
            $leagueId,
            $season,
            $resultLimit
        );

        try {
            /** @var array{
             *     status:string,
             *     table:array<int,array<string,mixed>>,
             *     meta:array<string,mixed>
             * } $payload
             */
            $payload = Cache::remember($cacheKey, $ttlSeconds, function () use ($leagueId, $season, $resultLimit): array {
                return $this->sportsSnapshotService->getLeagueStandingsPayload(
                    $leagueId,
                    $season,
                    $resultLimit
                );
            });

            return [
                'pageTitle' => 'Süper Lig Puan Durumu',
                'status' => (string) ($payload['status'] ?? 'empty'),
                'table' => isset($payload['table']) && is_array($payload['table']) ? $payload['table'] : [],
                'meta' => [
                    'source' => (string) (($payload['meta']['source'] ?? 'sports_snapshots')),
                    'snapshot_stale' => (bool) (($payload['meta']['snapshot_stale'] ?? false)),
                    'cache_key' => $cacheKey,
                    'cache_ttl' => $ttlSeconds,
                    'league_id' => $leagueId,
                    'season' => $season,
                    'limit' => $resultLimit,
                ],
            ];
        } catch (Throwable $e) {
            report($e);

            return [
                'pageTitle' => 'Süper Lig Puan Durumu',
                'status' => 'error',
                'table' => [],
                'meta' => [
                    'source' => 'sports_snapshots',
                    'cache_key' => $cacheKey,
                    'cache_ttl' => $ttlSeconds,
                    'league_id' => $leagueId,
                    'season' => $season,
                    'limit' => $resultLimit,
                    'error_message' => $e->getMessage(),
                ],
            ];
        }
    }
}
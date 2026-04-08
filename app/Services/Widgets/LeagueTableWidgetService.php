<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Services\Sports\SportsSnapshotService;
use App\Support\Widgets\WidgetCache;
use Throwable;

final class LeagueTableWidgetService
{
    public function __construct(
        private readonly SportsSnapshotService $sportsSnapshotService,
    ) {
    }

    /**
     * @return array{
     *     title:string,
     *     status:string,
     *     props:array<string,mixed>,
     *     data:array<string,mixed>,
     *     meta:array<string,mixed>
     * }
     */
    public function build(): array
    {
        $leagueId = (int) config('services.api_football.league_id', 203);
        $season = (int) config('services.api_football.season', 2025);
        $fullLimit = 20;
        $widgetLimit = 10;
        $ttlSeconds = (int) config('services.api_football.cache_ttl_league_table', 3600);

        try {
            $rows = WidgetCache::remember(
                'league_table',
                $ttlSeconds,
                function () use ($leagueId, $season, $fullLimit, $widgetLimit): array {
                    $table = $this->sportsSnapshotService->getLeague(
                        'league_standings_full',
                        $leagueId,
                        $season,
                        $fullLimit
                    );

                    if (! is_array($table) || $table === []) {
                        return [];
                    }

                    return array_slice($table, 0, $widgetLimit);
                },
                'league',
                [
                    'league_id' => $leagueId,
                    'season' => $season,
                    'limit' => $widgetLimit,
                ],
            );

            if ($rows === []) {
                return $this->emptyState('Lig tablosu verisi bulunamadı.');
            }

            return [
                'title' => 'Süper Lig',
                'status' => 'ok',
                'props' => [
                    'message' => null,
                    'detail_url' => '/puan-durumu',
                ],
                'data' => [
                    'rows' => $rows,
                ],
                'meta' => [
                    'source' => 'sports_snapshots',
                    'cache_ttl' => $ttlSeconds,
                    'league_id' => $leagueId,
                    'season' => $season,
                    'limit' => $widgetLimit,
                ],
            ];
        } catch (Throwable $e) {
            report($e);

            return [
                'title' => 'Süper Lig',
                'status' => 'error',
                'props' => [
                    'message' => 'Lig tablosu geçici olarak alınamadı.',
                    'detail_url' => '/puan-durumu',
                ],
                'data' => [
                    'rows' => [],
                ],
                'meta' => [
                    'source' => 'sports_snapshots',
                    'cache_ttl' => $ttlSeconds,
                    'league_id' => $leagueId,
                    'season' => $season,
                    'limit' => $widgetLimit,
                ],
            ];
        }
    }

    /**
     * @return array{
     *     title:string,
     *     status:string,
     *     props:array<string,mixed>,
     *     data:array<string,mixed>,
     *     meta:array<string,mixed>
     * }
     */
    private function emptyState(string $message): array
    {
        return [
            'title' => 'Süper Lig',
            'status' => 'empty',
            'props' => [
                'message' => $message,
                'detail_url' => '/puan-durumu',
            ],
            'data' => [
                'rows' => [],
            ],
            'meta' => [
                'source' => 'sports_snapshots',
            ],
        ];
    }
}
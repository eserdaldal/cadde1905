<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Services\Sports\ApiFootballService;
use App\Support\Widgets\WidgetCache;
use Throwable;

final class LastMatchesWidgetService
{
    public function __construct(
        private readonly ApiFootballService $apiFootballService = new ApiFootballService(),
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
        $teamId = (int) config('services.api_football.team_id', 645);
        $season = (int) config('services.api_football.season', 2025);
        $limit = 3;
        $ttlSeconds = (int) config('services.api_football.cache_ttl_last_matches', 1800);

        try {
            $matches = WidgetCache::remember(
                'last_matches',
                $ttlSeconds,
                fn (): array => $this->apiFootballService->getLastMatches($teamId, $season, $limit),
                'team',
                [
                    'team_id' => $teamId,
                    'season' => $season,
                    'limit' => $limit,
                ],
            );

            if ($matches === []) {
                return $this->emptyState('Son maç verisi bulunamadı.');
            }

            return [
                'title' => 'Son Maçlar',
                'status' => 'ok',
                'props' => [
                    'message' => null,
                    'detail_url' => '/mac',
                ],
                'data' => [
                    'items' => $matches,
                ],
                'meta' => [
                    'source' => 'api_football',
                    'cache_ttl' => $ttlSeconds,
                    'team_id' => $teamId,
                    'season' => $season,
                    'limit' => $limit,
                ],
            ];
        } catch (Throwable $e) {
            report($e);

            return [
                'title' => 'Son Maçlar',
                'status' => 'error',
                'props' => [
                    'message' => 'Son maçlar geçici olarak alınamadı.',
                    'detail_url' => '/mac',
                ],
                'data' => [
                    'items' => [],
                ],
                'meta' => [
                    'source' => 'api_football',
                    'cache_ttl' => $ttlSeconds,
                    'team_id' => $teamId,
                    'season' => $season,
                    'limit' => $limit,
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
            'title' => 'Son Maçlar',
            'status' => 'empty',
            'props' => [
                'message' => $message,
                'detail_url' => '/mac',
            ],
            'data' => [
                'items' => [],
            ],
            'meta' => [
                'source' => 'api_football',
            ],
        ];
    }
}
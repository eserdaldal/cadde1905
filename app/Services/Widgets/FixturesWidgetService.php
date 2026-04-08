<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Services\Sports\ApiFootballService;
use App\Support\Widgets\WidgetCache;
use Throwable;

final class FixturesWidgetService
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
        $ttlSeconds = (int) config('services.api_football.cache_ttl_fixtures', 3600);

        try {
            $fixtures = WidgetCache::remember(
                'fixtures',
                $ttlSeconds,
                fn (): array => $this->apiFootballService->getUpcomingFixtures($teamId, $season, $limit),
                'team',
                [
                    'team_id' => $teamId,
                    'season' => $season,
                    'limit' => $limit,
                ],
            );

            if ($fixtures === []) {
                return $this->emptyState('Yaklaşan maç verisi bulunamadı.');
            }

            return [
                'title' => 'Fikstür',
                'status' => 'ok',
                'props' => [
                    'message' => null,
                    'detail_url' => '/mac',
                ],
                'data' => [
                    'items' => $fixtures,
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
                'title' => 'Fikstür',
                'status' => 'error',
                'props' => [
                    'message' => 'Fikstür geçici olarak alınamadı.',
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
            'title' => 'Fikstür',
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
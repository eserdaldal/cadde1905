<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Services\Sports\SportsSnapshotService;
use App\Support\Widgets\WidgetCache;
use Throwable;

final class NextMatchWidgetService
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
        $teamId = (int) config('services.api_football.team_id', 645);
        $season = (int) config('services.api_football.season', 2025);
        $ttlSeconds = (int) config('services.api_football.cache_ttl_next_match', 900);

        try {
            $nextMatch = WidgetCache::remember(
                'next_match',
                $ttlSeconds,
                fn (): ?array => $this->sportsSnapshotService->getTeam('next_match', $teamId, $season),
                'team',
                [
                    'team_id' => $teamId,
                    'season' => $season,
                ],
            );

            if (! is_array($nextMatch) || $nextMatch === []) {
                return $this->emptyState('Sıradaki maç verisi bulunamadı.');
            }

            return [
                'title' => 'Sonraki Maç',
                'status' => 'ok',
                'props' => [
                    'message' => null,
                    'detail_url' => $nextMatch['detail_url'] ?? '/mac',
                ],
                'data' => [
                    'next' => $nextMatch,
                    'home_name' => $nextMatch['home_name'] ?? '',
                    'home_logo' => $nextMatch['home_logo'] ?? '',
                    'away_name' => $nextMatch['away_name'] ?? '',
                    'away_logo' => $nextMatch['away_logo'] ?? '',
                    'league_name' => $nextMatch['league_name'] ?? '',
                    'league_logo' => $nextMatch['league_logo'] ?? '',
                    'match_datetime' => $nextMatch['match_datetime'] ?? '',
                    'venue_name' => $nextMatch['venue_name'] ?? '',
                ],
                'meta' => [
                    'source' => 'sports_snapshots',
                    'cache_ttl' => $ttlSeconds,
                    'team_id' => $teamId,
                    'season' => $season,
                ],
            ];
        } catch (Throwable $e) {
            report($e);

            return [
                'title' => 'Sonraki Maç',
                'status' => 'error',
                'props' => [
                    'message' => 'Maç verisi geçici olarak alınamadı.',
                    'detail_url' => '/mac',
                ],
                'data' => [
                    'next' => null,
                ],
                'meta' => [
                    'source' => 'sports_snapshots',
                    'cache_ttl' => $ttlSeconds,
                    'team_id' => $teamId,
                    'season' => $season,
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
            'title' => 'Sonraki Maç',
            'status' => 'empty',
            'props' => [
                'message' => $message,
                'detail_url' => '/mac',
            ],
            'data' => [
                'next' => null,
            ],
            'meta' => [
                'source' => 'sports_snapshots',
            ],
        ];
    }
}
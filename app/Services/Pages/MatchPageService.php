<?php

declare(strict_types=1);

namespace App\Services\Pages;

use App\Services\Sports\SportsSnapshotService;
use Illuminate\Support\Facades\Cache;
use Throwable;

final class MatchPageService
{
    public function __construct(
        private readonly SportsSnapshotService $sportsSnapshotService,
    ) {
    }

    /**
     * @return array{
     *     pageTitle:string,
     *     status:string,
     *     match:array<string,mixed>|null,
     *     upcoming:array<int,array<string,mixed>>,
     *     last_matches:array<int,array<string,mixed>>,
     *     meta:array<string,mixed>
     * }
     */
    public function build(): array
    {
        $teamId = (int) config('services.api_football.team_id', 645);
        $season = (int) config('services.api_football.season', 2025);
        $ttlSeconds = (int) config('services.api_football.cache_ttl_next_match', 900);

        $cacheKey = sprintf(
            'page.match_center.team_%d.season_%d',
            $teamId,
            $season
        );

        try {
            /** @var array{
             *     status:string,
             *     match:array<string,mixed>|null,
             *     upcoming:array<int,array<string,mixed>>,
             *     last_matches:array<int,array<string,mixed>>,
             *     meta:array<string,mixed>
             * } $payload
             */
            $payload = Cache::remember($cacheKey, $ttlSeconds, function () use ($teamId, $season): array {
                return $this->sportsSnapshotService->getMatchCenterPayload($teamId, $season);
            });

            return [
                'pageTitle' => 'Maç Merkezi',
                'status' => (string) ($payload['status'] ?? 'empty'),
                'match' => isset($payload['match']) && is_array($payload['match']) ? $payload['match'] : null,
                'upcoming' => isset($payload['upcoming']) && is_array($payload['upcoming']) ? $payload['upcoming'] : [],
                'last_matches' => isset($payload['last_matches']) && is_array($payload['last_matches']) ? $payload['last_matches'] : [],
                'meta' => [
                    'source' => (string) (($payload['meta']['source'] ?? 'sports_snapshots')),
                    'snapshot_stale' => (bool) (($payload['meta']['snapshot_stale'] ?? false)),
                    'cache_key' => $cacheKey,
                    'cache_ttl' => $ttlSeconds,
                    'team_id' => $teamId,
                    'season' => $season,
                ],
            ];
        } catch (Throwable $e) {
            report($e);

            return [
                'pageTitle' => 'Maç Merkezi',
                'status' => 'error',
                'match' => null,
                'upcoming' => [],
                'last_matches' => [],
                'meta' => [
                    'source' => 'sports_snapshots',
                    'cache_key' => $cacheKey,
                    'cache_ttl' => $ttlSeconds,
                    'team_id' => $teamId,
                    'season' => $season,
                    'error_message' => $e->getMessage(),
                ],
            ];
        }
    }
}
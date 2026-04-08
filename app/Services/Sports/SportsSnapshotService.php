<?php

declare(strict_types=1);

namespace App\Services\Sports;

use App\Models\SportsSnapshot;
use Carbon\CarbonImmutable;

final class SportsSnapshotService
{
    public function getTeamSnapshot(string $snapshotKey, int $teamId, int $season): ?SportsSnapshot
    {
        return SportsSnapshot::query()
            ->forTeam($snapshotKey, $teamId, $season)
            ->first();
    }

    public function getLeagueSnapshot(
        string $snapshotKey,
        int $leagueId,
        int $season,
        int $resultLimit = 0
    ): ?SportsSnapshot {
        return SportsSnapshot::query()
            ->forLeague($snapshotKey, $leagueId, $season, $resultLimit)
            ->first();
    }

    /**
     * @return array<string, mixed>|array<int, array<string, mixed>>|null
     */
    public function getTeam(string $snapshotKey, int $teamId, int $season): array|null
    {
        $snapshot = $this->getTeamSnapshot($snapshotKey, $teamId, $season);

        if (! $snapshot instanceof SportsSnapshot) {
            return null;
        }

        return is_array($snapshot->payload) ? $snapshot->payload : null;
    }

    /**
     * @return array<string, mixed>|array<int, array<string, mixed>>|null
     */
    public function getLeague(
        string $snapshotKey,
        int $leagueId,
        int $season,
        int $resultLimit = 0
    ): array|null {
        $snapshot = $this->getLeagueSnapshot($snapshotKey, $leagueId, $season, $resultLimit);

        if (! $snapshot instanceof SportsSnapshot) {
            return null;
        }

        return is_array($snapshot->payload) ? $snapshot->payload : null;
    }

    public function putTeam(
        string $snapshotKey,
        int $teamId,
        int $season,
        array $payload,
        int $ttlSeconds
    ): SportsSnapshot {
        return $this->putScoped(
            snapshotKey: $snapshotKey,
            scopeType: 'team',
            scopeId: $teamId,
            teamId: $teamId,
            season: $season,
            resultLimit: 0,
            payload: $payload,
            ttlSeconds: $ttlSeconds,
        );
    }

    public function putLeague(
        string $snapshotKey,
        int $leagueId,
        int $season,
        int $resultLimit,
        array $payload,
        int $ttlSeconds
    ): SportsSnapshot {
        return $this->putScoped(
            snapshotKey: $snapshotKey,
            scopeType: 'league',
            scopeId: $leagueId,
            teamId: 0,
            season: $season,
            resultLimit: $resultLimit,
            payload: $payload,
            ttlSeconds: $ttlSeconds,
        );
    }

    public function isExpired(?SportsSnapshot $snapshot): bool
    {
        if (! $snapshot instanceof SportsSnapshot) {
            return true;
        }

        if ($snapshot->expires_at === null) {
            return false;
        }

        return $snapshot->expires_at->isPast();
    }

    /**
     * @return array{
     *     status:string,
     *     match:array<string,mixed>|null,
     *     upcoming:array<int,array<string,mixed>>,
     *     last_matches:array<int,array<string,mixed>>,
     *     meta:array<string,mixed>
     * }
     */
    public function getMatchCenterPayload(int $teamId, int $season): array
    {
        $nextMatchSnapshot = $this->getTeamSnapshot('next_match', $teamId, $season);
        $upcomingSnapshot = $this->getTeamSnapshot('upcoming_fixtures', $teamId, $season);
        $lastMatchesSnapshot = $this->getTeamSnapshot('last_matches', $teamId, $season);

        $match = $this->getTeam('next_match', $teamId, $season);
        $upcoming = $this->getTeam('upcoming_fixtures', $teamId, $season);
        $lastMatches = $this->getTeam('last_matches', $teamId, $season);

        $matchData = is_array($match) && $match !== [] ? $match : null;
        $upcomingData = is_array($upcoming) ? $upcoming : [];
        $lastMatchesData = is_array($lastMatches) ? $lastMatches : [];

        $hasAnyData = $matchData !== null || $upcomingData !== [] || $lastMatchesData !== [];

        $isStale = $this->isExpired($nextMatchSnapshot)
            || $this->isExpired($upcomingSnapshot)
            || $this->isExpired($lastMatchesSnapshot);

        return [
            'status' => $hasAnyData ? 'ok' : 'empty',
            'match' => $matchData,
            'upcoming' => $upcomingData,
            'last_matches' => $lastMatchesData,
            'meta' => [
                'source' => 'sports_snapshots',
                'snapshot_stale' => $hasAnyData ? $isStale : false,
                'team_id' => $teamId,
                'season' => $season,
            ],
        ];
    }

    /**
     * @return array{
     *     status:string,
     *     table:array<int,array<string,mixed>>,
     *     meta:array<string,mixed>
     * }
     */
    public function getLeagueStandingsPayload(int $leagueId, int $season, int $resultLimit = 20): array
    {
        $standingsSnapshot = $this->getLeagueSnapshot(
            'league_standings_full',
            $leagueId,
            $season,
            $resultLimit
        );

        $table = $this->getLeague(
            'league_standings_full',
            $leagueId,
            $season,
            $resultLimit
        );

        $tableData = is_array($table) ? $table : [];
        $hasData = $tableData !== [];

        return [
            'status' => $hasData ? 'ok' : 'empty',
            'table' => $tableData,
            'meta' => [
                'source' => 'sports_snapshots',
                'snapshot_stale' => $this->isExpired($standingsSnapshot),
                'league_id' => $leagueId,
                'season' => $season,
                'limit' => $resultLimit,
            ],
        ];
    }

    private function putScoped(
        string $snapshotKey,
        string $scopeType,
        int $scopeId,
        int $teamId,
        int $season,
        int $resultLimit,
        array $payload,
        int $ttlSeconds
    ): SportsSnapshot {
        $ttlSeconds = max(60, $ttlSeconds);

        $json = json_encode(
            $payload,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        $checksum = sha1($json !== false ? $json : '[]');
        $now = CarbonImmutable::now();

        /** @var SportsSnapshot $snapshot */
        $snapshot = SportsSnapshot::query()->updateOrCreate(
            [
                'snapshot_key' => $snapshotKey,
                'scope_type' => $scopeType,
                'scope_id' => $scopeId,
                'season' => $season,
                'result_limit' => $resultLimit,
            ],
            [
                'team_id' => $teamId,
                'payload' => $payload,
                'checksum' => $checksum,
                'last_success_at' => $now,
                'expires_at' => $now->addSeconds($ttlSeconds),
            ]
        );

        return $snapshot;
    }
}
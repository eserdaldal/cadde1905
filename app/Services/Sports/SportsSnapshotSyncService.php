<?php

declare(strict_types=1);

namespace App\Services\Sports;

use Illuminate\Support\Facades\Cache;

final class SportsSnapshotSyncService
{
    public function __construct(
        private readonly ApiFootballService $apiFootballService,
        private readonly SportsSnapshotService $sportsSnapshotService,
    ) {
    }

    /**
     * @return array{
     *     status:string,
     *     cache_key:string,
     *     team_id:int,
     *     season:int,
     *     next_match_saved:bool,
     *     upcoming_count:int,
     *     last_matches_count:int
     * }
     */
    public function syncMatchCenter(int $teamId, int $season): array
    {
        $nextMatch = $this->apiFootballService->getNextMatch($teamId, $season);
        $upcomingFixtures = $this->apiFootballService->getUpcomingFixtures($teamId, $season, 5);
        $lastMatches = $this->apiFootballService->getLastMatches($teamId, $season, 5);

        $this->sportsSnapshotService->putTeam(
            'next_match',
            $teamId,
            $season,
            is_array($nextMatch) ? $nextMatch : [],
            (int) config('services.api_football.cache_ttl_next_match', 900)
        );

        $this->sportsSnapshotService->putTeam(
            'upcoming_fixtures',
            $teamId,
            $season,
            $upcomingFixtures,
            (int) config('services.api_football.cache_ttl_fixtures', 3600)
        );

        $this->sportsSnapshotService->putTeam(
            'last_matches',
            $teamId,
            $season,
            $lastMatches,
            (int) config('services.api_football.cache_ttl_last_matches', 1800)
        );

        \App\Events\Sports\SportsSnapshotUpdated::dispatch(
            'match_center_update',
            'team',
            $teamId,
            $season
        );

        return [
            'status' => 'ok',
            'cache_key' => 'event_dispatched',
            'team_id' => $teamId,
            'season' => $season,
            'next_match_saved' => is_array($nextMatch) && $nextMatch !== [],
            'upcoming_count' => count($upcomingFixtures),
            'last_matches_count' => count($lastMatches),
        ];
    }

    /**
     * @return array{
     *     status:string,
     *     league_id:int,
     *     season:int,
     *     result_limit:int,
     *     rows_count:int
     * }
     */
    public function syncLeagueStandings(int $leagueId, int $season, int $resultLimit = 20): array
    {
        $rows = $this->apiFootballService->getLeagueStandings($leagueId, $season, $resultLimit);

        $this->sportsSnapshotService->putLeague(
            'league_standings_full',
            $leagueId,
            $season,
            $resultLimit,
            $rows,
            (int) config('services.api_football.cache_ttl_league_table', 3600)
        );

        \App\Events\Sports\SportsSnapshotUpdated::dispatch(
            'league_standings_update',
            'league',
            $leagueId,
            $season
        );

        return [
            'status' => 'ok',
            'league_id' => $leagueId,
            'season' => $season,
            'result_limit' => $resultLimit,
            'rows_count' => count($rows),
        ];
    }
}
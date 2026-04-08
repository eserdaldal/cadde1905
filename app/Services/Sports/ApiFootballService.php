<?php

declare(strict_types=1);

namespace App\Services\Sports;

use Carbon\Carbon;

final class ApiFootballService
{
    public function __construct(
        private readonly ApiFootballClient $client = new ApiFootballClient(),
    ) {
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getNextMatch(?int $teamId = null, ?int $season = null): ?array
    {
        $teamId ??= (int) config('services.api_football.team_id', 645);
        $season ??= (int) config('services.api_football.season', 2025);

        $payload = $this->client->get('/fixtures', [
            'team' => $teamId,
            'season' => $season,
            'next' => 1,
        ]);

        $response = $payload['response'] ?? null;

        if (! is_array($response) || $response === []) {
            return null;
        }

        $fixture = $response[0] ?? null;

        if (! is_array($fixture)) {
            return null;
        }

        return $this->normalizeFixture($fixture);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getLeagueStandings(?int $leagueId = null, ?int $season = null, int $limit = 10): array
    {
        $leagueId ??= (int) config('services.api_football.league_id', 203);
        $season ??= (int) config('services.api_football.season', 2025);

        $payload = $this->client->get('/standings', [
            'league' => $leagueId,
            'season' => $season,
        ]);

        $response = $payload['response'] ?? null;

        if (! is_array($response) || $response === []) {
            return [];
        }

        $first = $response[0] ?? null;
        if (! is_array($first)) {
            return [];
        }

        $league = is_array($first['league'] ?? null) ? $first['league'] : [];
        $standingsGroups = $league['standings'] ?? null;

        if (! is_array($standingsGroups) || $standingsGroups === []) {
            return [];
        }

        $table = $standingsGroups[0] ?? null;

        if (! is_array($table)) {
            return [];
        }

        $normalized = [];

        foreach ($table as $row) {
            if (! is_array($row)) {
                continue;
            }

            $team = is_array($row['team'] ?? null) ? $row['team'] : [];
            $all = is_array($row['all'] ?? null) ? $row['all'] : [];
            $goalsDiff = $row['goalsDiff'] ?? 0;

            $normalized[] = [
                'rank' => (int) ($row['rank'] ?? 0),
                'team_id' => (int) ($team['id'] ?? 0),
                'team_name' => (string) ($team['name'] ?? ''),
                'team_logo' => (string) ($team['logo'] ?? ''),
                'points' => (int) ($row['points'] ?? 0),
                'played' => (int) ($all['played'] ?? 0),
                'won' => (int) ($all['win'] ?? 0),
                'drawn' => (int) ($all['draw'] ?? 0),
                'lost' => (int) ($all['lose'] ?? 0),
                'goals_diff' => (int) $goalsDiff,
                'form' => (string) ($row['form'] ?? ''),
                'is_galatasaray' => (int) ($team['id'] ?? 0) === (int) config('services.api_football.team_id', 645),
            ];
        }

        return array_slice($normalized, 0, max(1, $limit));
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getUpcomingFixtures(?int $teamId = null, ?int $season = null, int $limit = 3): array
    {
        $teamId ??= (int) config('services.api_football.team_id', 645);
        $season ??= (int) config('services.api_football.season', 2025);

        $payload = $this->client->get('/fixtures', [
            'team' => $teamId,
            'season' => $season,
            'next' => $limit,
        ]);

        $response = $payload['response'] ?? null;

        if (! is_array($response) || $response === []) {
            return [];
        }

        $items = [];

        foreach ($response as $fixture) {
            if (! is_array($fixture)) {
                continue;
            }

            $items[] = $this->normalizeFixture($fixture);
        }

        return $items;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getLastMatches(?int $teamId = null, ?int $season = null, int $limit = 3): array
    {
        $teamId ??= (int) config('services.api_football.team_id', 645);
        $season ??= (int) config('services.api_football.season', 2025);

        $payload = $this->client->get('/fixtures', [
            'team' => $teamId,
            'season' => $season,
            'last' => $limit,
        ]);

        $response = $payload['response'] ?? null;

        if (! is_array($response) || $response === []) {
            return [];
        }

        $items = [];

        foreach ($response as $fixture) {
            if (! is_array($fixture)) {
                continue;
            }

            $normalized = $this->normalizeFixture($fixture);

            $goals = is_array($fixture['goals'] ?? null) ? $fixture['goals'] : [];
            $homeGoals = $goals['home'] ?? null;
            $awayGoals = $goals['away'] ?? null;

            $normalized['home_goals'] = is_numeric($homeGoals) ? (int) $homeGoals : null;
            $normalized['away_goals'] = is_numeric($awayGoals) ? (int) $awayGoals : null;
            $normalized['score'] = $this->buildScore($homeGoals, $awayGoals);
            $normalized['result'] = $this->resolveResult($fixture, $teamId, $homeGoals, $awayGoals);

            $items[] = $normalized;
        }

        return $items;
    }

    /**
     * @param array<string, mixed> $fixture
     * @return array<string, mixed>
     */
    private function normalizeFixture(array $fixture): array
    {
        $fixtureInfo = is_array($fixture['fixture'] ?? null) ? $fixture['fixture'] : [];
        $leagueInfo = is_array($fixture['league'] ?? null) ? $fixture['league'] : [];
        $teamsInfo = is_array($fixture['teams'] ?? null) ? $fixture['teams'] : [];

        $home = is_array($teamsInfo['home'] ?? null) ? $teamsInfo['home'] : [];
        $away = is_array($teamsInfo['away'] ?? null) ? $teamsInfo['away'] : [];
        $venue = is_array($fixtureInfo['venue'] ?? null) ? $fixtureInfo['venue'] : [];
        $status = is_array($fixtureInfo['status'] ?? null) ? $fixtureInfo['status'] : [];

        $dateRaw = $fixtureInfo['date'] ?? null;
        $matchDatetime = '';

        if (is_string($dateRaw) && $dateRaw !== '') {
            try {
                $matchDatetime = Carbon::parse($dateRaw)
                    ->timezone(config('app.timezone', 'UTC'))
                    ->format('d.m.Y H:i');
            } catch (\Throwable) {
                $matchDatetime = $dateRaw;
            }
        }

        $fixtureId = (int) ($fixtureInfo['id'] ?? 0);

        return [
            'fixture_id' => $fixtureId,
            'home_id' => (int) ($home['id'] ?? 0),
            'home_name' => (string) ($home['name'] ?? ''),
            'home_logo' => (string) ($home['logo'] ?? ''),
            'away_id' => (int) ($away['id'] ?? 0),
            'away_name' => (string) ($away['name'] ?? ''),
            'away_logo' => (string) ($away['logo'] ?? ''),
            'league_id' => (int) ($leagueInfo['id'] ?? 0),
            'league_name' => (string) ($leagueInfo['name'] ?? ''),
            'league_logo' => (string) ($leagueInfo['logo'] ?? ''),
            'match_datetime' => $matchDatetime,
            'venue_name' => (string) ($venue['name'] ?? ''),
            'venue_city' => (string) ($venue['city'] ?? ''),
            'status_short' => (string) ($status['short'] ?? ''),
            'status_long' => (string) ($status['long'] ?? ''),
            'is_live' => in_array((string) ($status['short'] ?? ''), ['1H', '2H', 'HT', 'ET', 'P', 'BT'], true),
            'detail_url' => $this->buildFixtureDetailUrl($fixtureId),
            'raw' => $fixture,
        ];
    }

    private function buildScore(mixed $homeGoals, mixed $awayGoals): ?string
    {
        if (! is_numeric($homeGoals) || ! is_numeric($awayGoals)) {
            return null;
        }

        return (string) ((int) $homeGoals) . ' - ' . (string) ((int) $awayGoals);
    }

    private function buildFixtureDetailUrl(int $fixtureId): string
    {
        return '/mac';
    }

    private function resolveResult(array $fixture, int $teamId, mixed $homeGoals, mixed $awayGoals): ?string
    {
        if (! is_numeric($homeGoals) || ! is_numeric($awayGoals)) {
            return null;
        }

        $teams = is_array($fixture['teams'] ?? null) ? $fixture['teams'] : [];
        $home = is_array($teams['home'] ?? null) ? $teams['home'] : [];
        $away = is_array($teams['away'] ?? null) ? $teams['away'] : [];

        $homeId = (int) ($home['id'] ?? 0);
        $awayId = (int) ($away['id'] ?? 0);
        $homeGoals = (int) $homeGoals;
        $awayGoals = (int) $awayGoals;

        if ($homeGoals === $awayGoals) {
            return 'draw';
        }

        $isHomeTeam = $homeId === $teamId;
        $isAwayTeam = $awayId === $teamId;

        if (! $isHomeTeam && ! $isAwayTeam) {
            return null;
        }

        if ($isHomeTeam) {
            return $homeGoals > $awayGoals ? 'win' : 'loss';
        }

        return $awayGoals > $homeGoals ? 'win' : 'loss';
    }
}
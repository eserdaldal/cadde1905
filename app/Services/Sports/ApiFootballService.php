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
     * @return array<string, mixed>|null
     */
    public function getFixtureDetail(int $fixtureId): ?array
    {
        if ($fixtureId <= 0) {
            return null;
        }

        $payload = $this->client->get('/fixtures', [
            'id' => $fixtureId,
        ]);

        $response = $payload['response'] ?? null;

        if (! is_array($response) || $response === []) {
            return null;
        }

        $fixture = $response[0] ?? null;

        if (! is_array($fixture)) {
            return null;
        }

        $normalized = $this->normalizeFixture($fixture);

        $goals = is_array($fixture['goals'] ?? null) ? $fixture['goals'] : [];
        $score = is_array($fixture['score'] ?? null) ? $fixture['score'] : [];
        $teams = is_array($fixture['teams'] ?? null) ? $fixture['teams'] : [];

        $homeGoals = $goals['home'] ?? null;
        $awayGoals = $goals['away'] ?? null;

        $normalized['referee'] = (string) (($fixture['fixture']['referee'] ?? '') ?: '');
        $normalized['home_goals'] = is_numeric($homeGoals) ? (int) $homeGoals : null;
        $normalized['away_goals'] = is_numeric($awayGoals) ? (int) $awayGoals : null;
        $normalized['score'] = $this->buildScore($homeGoals, $awayGoals);
        $normalized['league_round'] = (string) (($fixture['league']['round'] ?? '') ?: '');
        $normalized['home_winner'] = (bool) (($teams['home']['winner'] ?? false));
        $normalized['away_winner'] = (bool) (($teams['away']['winner'] ?? false));
        $normalized['halftime_score'] = $this->buildScore(
            $score['halftime']['home'] ?? null,
            $score['halftime']['away'] ?? null,
        );
        $normalized['fulltime_score'] = $this->buildScore(
            $score['fulltime']['home'] ?? null,
            $score['fulltime']['away'] ?? null,
        );

        return $normalized;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getFixtureLineups(int $fixtureId): array
    {
        if ($fixtureId <= 0) {
            return [];
        }

        $payload = $this->client->get('/fixtures/lineups', [
            'fixture' => $fixtureId,
        ]);

        $response = $payload['response'] ?? null;

        if (! is_array($response) || $response === []) {
            return [];
        }

        $items = [];

        foreach ($response as $lineup) {
            if (! is_array($lineup)) {
                continue;
            }

            $team = is_array($lineup['team'] ?? null) ? $lineup['team'] : [];
            $coach = is_array($lineup['coach'] ?? null) ? $lineup['coach'] : [];
            $colors = is_array($team['colors'] ?? null) ? $team['colors'] : [];
            $playerColors = is_array($colors['player'] ?? null) ? $colors['player'] : [];
            $goalkeeperColors = is_array($colors['goalkeeper'] ?? null) ? $colors['goalkeeper'] : [];

            $items[] = [
                'team' => [
                    'id' => (int) ($team['id'] ?? 0),
                    'name' => (string) ($team['name'] ?? ''),
                    'logo' => (string) ($team['logo'] ?? ''),
                    'colors' => [
                        'player' => [
                            'primary' => $this->normalizeHexColor($playerColors['primary'] ?? null),
                            'number' => $this->normalizeHexColor($playerColors['number'] ?? null),
                            'border' => $this->normalizeHexColor($playerColors['border'] ?? null),
                        ],
                        'goalkeeper' => [
                            'primary' => $this->normalizeHexColor($goalkeeperColors['primary'] ?? null),
                            'number' => $this->normalizeHexColor($goalkeeperColors['number'] ?? null),
                            'border' => $this->normalizeHexColor($goalkeeperColors['border'] ?? null),
                        ],
                    ],
                ],
                'coach' => [
                    'id' => (int) ($coach['id'] ?? 0),
                    'name' => (string) ($coach['name'] ?? ''),
                    'photo' => (string) ($coach['photo'] ?? ''),
                ],
                'formation' => (string) ($lineup['formation'] ?? ''),
                'start_xi' => $this->normalizeLineupPlayers($lineup['startXI'] ?? []),
                'substitutes' => $this->normalizeLineupPlayers($lineup['substitutes'] ?? []),
            ];
        }

        return $items;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getFixtureEvents(int $fixtureId): array
    {
        if ($fixtureId <= 0) {
            return [];
        }

        $payload = $this->client->get('/fixtures/events', [
            'fixture' => $fixtureId,
        ]);

        $response = $payload['response'] ?? null;

        if (! is_array($response) || $response === []) {
            return [];
        }

        $items = [];

        foreach ($response as $event) {
            if (! is_array($event)) {
                continue;
            }

            $time = is_array($event['time'] ?? null) ? $event['time'] : [];
            $team = is_array($event['team'] ?? null) ? $event['team'] : [];
            $player = is_array($event['player'] ?? null) ? $event['player'] : [];
            $assist = is_array($event['assist'] ?? null) ? $event['assist'] : [];

            $items[] = [
                'minute' => (int) ($time['elapsed'] ?? 0),
                'extra' => is_numeric($time['extra'] ?? null) ? (int) $time['extra'] : null,
                'team_id' => (int) ($team['id'] ?? 0),
                'team_name' => (string) ($team['name'] ?? ''),
                'team_logo' => (string) ($team['logo'] ?? ''),
                'player_id' => (int) ($player['id'] ?? 0),
                'player_name' => (string) ($player['name'] ?? ''),
                'assist_id' => (int) ($assist['id'] ?? 0),
                'assist_name' => (string) ($assist['name'] ?? ''),
                'type' => $this->normalizeEventType((string) ($event['type'] ?? '')),
                'detail' => (string) ($event['detail'] ?? ''),
                'comments' => $event['comments'] ?? null,
            ];
        }

        return $items;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getFixtureStatistics(int $fixtureId): array
    {
        if ($fixtureId <= 0) {
            return [];
        }

        $payload = $this->client->get('/fixtures/statistics', [
            'fixture' => $fixtureId,
        ]);

        $response = $payload['response'] ?? null;

        if (! is_array($response) || $response === []) {
            return [];
        }

        $items = [];

        foreach ($response as $teamStats) {
            if (! is_array($teamStats)) {
                continue;
            }

            $team = is_array($teamStats['team'] ?? null) ? $teamStats['team'] : [];
            $stats = $teamStats['statistics'] ?? [];

            $normalizedStats = [];

            if (is_array($stats)) {
                foreach ($stats as $row) {
                    if (! is_array($row)) {
                        continue;
                    }

                    $normalizedStats[] = [
                        'type' => (string) ($row['type'] ?? ''),
                        'value' => $row['value'] ?? null,
                    ];
                }
            }

            $items[] = [
                'team_id' => (int) ($team['id'] ?? 0),
                'team_name' => (string) ($team['name'] ?? ''),
                'team_logo' => (string) ($team['logo'] ?? ''),
                'items' => $normalizedStats,
            ];
        }

        return $items;
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

    /**
     * @param mixed $players
     * @return array<int, array<string, mixed>>
     */
    private function normalizeLineupPlayers(mixed $players): array
    {
        if (! is_array($players)) {
            return [];
        }

        $items = [];

        foreach ($players as $row) {
            if (! is_array($row)) {
                continue;
            }

            $player = is_array($row['player'] ?? null) ? $row['player'] : [];
            $grid = (string) ($player['grid'] ?? '');

            [$gridRow, $gridCol] = $this->parseGrid($grid);

            $items[] = [
                'player_id' => (int) ($player['id'] ?? 0),
                'name' => (string) ($player['name'] ?? ''),
                'number' => is_numeric($player['number'] ?? null) ? (int) $player['number'] : null,
                'pos' => (string) ($player['pos'] ?? ''),
                'grid' => $grid,
                'grid_row' => $gridRow,
                'grid_col' => $gridCol,
            ];
        }

        return $items;
    }

    /**
     * @return array{0:int|null,1:int|null}
     */
    private function parseGrid(string $grid): array
    {
        if ($grid === '' || ! str_contains($grid, ':')) {
            return [null, null];
        }

        [$row, $col] = explode(':', $grid, 2);

        return [
            is_numeric($row) ? (int) $row : null,
            is_numeric($col) ? (int) $col : null,
        ];
    }

    private function normalizeHexColor(mixed $value): ?string
    {
        if (! is_string($value) || $value === '') {
            return null;
        }

        $normalized = ltrim(trim($value), '#');

        if ($normalized === '' || ! ctype_xdigit($normalized)) {
            return null;
        }

        return '#' . strtolower($normalized);
    }

    private function normalizeEventType(string $type): string
    {
        return match (strtolower(trim($type))) {
            'goal' => 'goal',
            'card' => 'card',
            'subst' => 'substitution',
            default => strtolower(trim($type)),
        };
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
        return '/mac/' . $fixtureId;
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

<?php

declare(strict_types=1);

namespace App\Services\Pages;

use App\Services\Sports\ApiFootballService;

final class MatchDetailService
{
    public function __construct(
        private readonly ApiFootballService $apiFootballService,
    ) {
    }

    public function build(int $fixtureId): array
    {
        $match = $this->apiFootballService->getFixtureDetail($fixtureId);

        if ($match === null) {
            return [
                'found' => false,
                'fixture_id' => $fixtureId,
                'match' => null,
                'pitch' => [],
                'events' => [],
                'statistics' => [],
            ];
        }

        $lineups = $this->apiFootballService->getFixtureLineups($fixtureId);
        $events = $this->apiFootballService->getFixtureEvents($fixtureId);
        $statistics = $this->apiFootballService->getFixtureStatistics($fixtureId);

        $teamId = (int) config('services.api_football.team_id', 645);

        $left = null;
        $right = null;

        foreach ($lineups as $team) {
            if (($team['team']['id'] ?? 0) === $teamId) {
                $left = $team;
            } else {
                $right = $team;
            }
        }

        return [
            'found' => true,
            'fixture_id' => $fixtureId,
            'match' => $match,
            'pitch' => [
                'left_team' => $this->mapTeam($left),
                'right_team' => $this->mapTeam($right),
            ],
            'events' => $events,
            'statistics' => $statistics,
        ];
    }

    private function mapTeam(?array $team): array
    {
        if (!$team) {
            return [];
        }

        return [
            'team_id' => $team['team']['id'] ?? 0,
            'team_name' => $team['team']['name'] ?? '',
            'team_logo' => $team['team']['logo'] ?? '',
            'formation' => $team['formation'] ?? '',
            'coach' => $team['coach'] ?? [],
            'colors' => $team['team']['colors'] ?? [],
            'players' => $this->mapPlayers($team['start_xi'] ?? []),
            'bench' => $team['substitutes'] ?? [],
        ];
    }

    private function mapPlayers(array $players): array
    {
        $items = [];

        foreach ($players as $p) {
            $items[] = [
                'number' => $p['number'] ?? $p['player']['number'] ?? null,
                'name' => $p['name'] ?? $p['player']['name'] ?? null,
                'pos' => $p['pos'] ?? $p['player']['pos'] ?? '',
                'grid_row' => $p['grid_row'] ?? null,
                'grid_col' => $p['grid_col'] ?? null,
                'role' => ($p['pos'] ?? $p['player']['pos'] ?? '') === 'G' ? 'goalkeeper' : 'player',
            ];
        }

        return $items;
    }
}

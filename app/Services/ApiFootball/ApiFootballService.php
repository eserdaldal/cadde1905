<?php

declare(strict_types=1);

namespace App\Services\ApiFootball;

use App\Services\ApiFootball\ApiFootballClient;

final class ApiFootballService
{
    public function __construct(private readonly ApiFootballClient $client)
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function getLeague(int $leagueId, int $season): array
    {
        return $this->client->get('leagues', [
            'id' => $leagueId,
            'season' => $season,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function getTeams(int $leagueId, int $season): array
    {
        return $this->client->get('teams', [
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function getFixtures(int $leagueId, int $season): array
    {
        return $this->client->get('fixtures', [
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function getStandings(int $leagueId, int $season): array
    {
        return $this->client->get('standings', [
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function getPlayersByLeague(int $leagueId, int $season, int $page = 1): array
    {
        return $this->client->get('players', [
            'league' => $leagueId,
            'season' => $season,
            'page' => $page,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function getPlayersByTeam(int $teamId, int $season, int $page = 1): array
    {
        return $this->client->get('players', [
            'team' => $teamId,
            'season' => $season,
            'page' => $page,
        ]);
    }
}

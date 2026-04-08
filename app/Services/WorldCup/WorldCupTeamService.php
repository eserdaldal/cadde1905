<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\Group;
use App\Models\WorldCup\Player;
use App\Models\WorldCup\Team;
use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\WorldCupMatch;
use Illuminate\Support\Collection;

class WorldCupTeamService
{
    public function getIndexData(): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $tournamentId = $activeTournament?->id;

        $teams = collect();
        $featuredTeams = collect();
        $groups = collect();

        if ($tournamentId) {
            $teams = Team::query()
                ->with('group')
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->orderBy('sort_order')
                ->orderBy('name_override')
                ->orderBy('name_api')
                ->get();

            $featuredTeams = Team::query()
                ->with('group')
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->orderBy('name_override')
                ->orderBy('name_api')
                ->limit(12)
                ->get();

            $groups = Group::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->orderBy('sort_order')
                ->orderBy('code')
                ->get();
        }

        $filters = [
            'confederations' => $this->buildConfederationFilters($teams),
        ];

        return [
            'activeTournament' => $activeTournament,
            'teams' => $this->mapTeams($teams),
            'featuredTeams' => $this->mapTeams($featuredTeams),
            'groups' => $groups,
            'filters' => $filters,
        ];
    }

    public function getShowData(string $slug): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $team = null;
        $players = collect();
        $matches = collect();

        if ($activeTournament) {
            $team = Team::query()
                ->where('tournament_id', $activeTournament->id)
                ->where('slug', $slug)
                ->first();
        }

        if ($team) {
            $players = Player::query()
                ->where('tournament_id', $team->tournament_id)
                ->where('team_id', $team->id)
                ->where('is_visible', true)
                ->orderBy('shirt_number')
                ->orderBy('name_override')
                ->orderBy('name_api')
                ->get();

            $matches = WorldCupMatch::query()
                ->with(['homeTeam', 'awayTeam', 'stadium'])
                ->where('tournament_id', $team->tournament_id)
                ->where(function ($query) use ($team) {
                    $query->where('home_team_id', $team->id)
                        ->orWhere('away_team_id', $team->id);
                })
                ->where('is_visible', true)
                ->orderByDesc('kickoff_at')
                ->limit(6)
                ->get();
        }

        return [
            'activeTournament' => $activeTournament,
            'team' => $team,
            'players' => $players,
            'matches' => $this->mapMatches($matches),
        ];
    }

    private function buildConfederationFilters(Collection $teams): array
    {
        $defaults = ['Tümü', 'UEFA', 'CONMEBOL', 'CONCACAF', 'CAF', 'AFC', 'OFC'];

        if ($teams->isEmpty()) {
            return $defaults;
        }

        $items = $teams
            ->pluck('confederation')
            ->filter()
            ->map(fn ($value) => trim($value))
            ->filter()
            ->unique()
            ->values()
            ->all();

        if (empty($items)) {
            return $defaults;
        }

        array_unshift($items, 'Tümü');

        return $items;
    }

    private function mapTeams(Collection $teams): array
    {
        return $teams->map(function (Team $team) {
            $groupName = $team->group?->name ?: $team->group?->code;

            return (object) [
                'slug' => $team->slug,
                'name' => $team->name_override ?: $team->name_api,
                'confederation' => $team->confederation,
                'flag_url' => $team->flag_image_api,
                'fifa_ranking' => null,
                'group' => (object) ['name' => $groupName],
            ];
        })->all();
    }

    private function mapMatches(Collection $matches): array
    {
        return $matches->map(function (WorldCupMatch $match) {
            $homeTeam = $match->homeTeam;
            $awayTeam = $match->awayTeam;
            $stadium = $match->stadium;
            $kickoffAt = $match->kickoff_at;

            return (object) [
                'id' => $match->id,
                'round' => $match->round_name ?: $match->stage,
                'date' => $kickoffAt,
                'date_label' => $kickoffAt?->format('d M, H:i'),
                'home' => $homeTeam ? ($homeTeam->name_override ?: $homeTeam->name_api) : null,
                'away' => $awayTeam ? ($awayTeam->name_override ?: $awayTeam->name_api) : null,
                'home_flag_url' => $homeTeam?->flag_image_api,
                'away_flag_url' => $awayTeam?->flag_image_api,
                'home_score' => $match->home_score,
                'away_score' => $match->away_score,
                'stadium' => $stadium ? ($stadium->name_override ?: $stadium->name_api) : null,
            ];
        })->all();
    }
}

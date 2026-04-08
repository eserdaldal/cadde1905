<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\Group;
use App\Models\WorldCup\GroupStanding;
use App\Models\WorldCup\WorldCup;
use Illuminate\Support\Collection;

class WorldCupGroupService
{
    public function __construct(
        protected WorldCupRankingService $rankingService
    ) {}

    public function getIndexData(): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $tournamentId = $activeTournament?->id;

        $groups = collect();
        $standings = collect();
        $qualificationMap = [];

        if ($tournamentId) {
            $groups = Group::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('name', '!=', 'Ranking of third-placed teams')
                ->orderBy('sort_order')
                ->orderBy('code')
                ->get();

            $standings = GroupStanding::query()
                ->with(['group', 'team'])
                ->where('tournament_id', $tournamentId)
                ->whereHas('group', function ($query) {
                    $query->where('name', '!=', 'Ranking of third-placed teams');
                })
                ->orderBy('group_id')
                ->orderBy('position')
                ->orderByDesc('points')
                ->get();

            $qualificationMap = $this->rankingService->getQualificationMap($tournamentId);
        }

        $standingsByGroup = $this->buildStandingsByGroup($groups, $standings, $qualificationMap);

        return [
            'activeTournament' => $activeTournament,
            'groups' => $standingsByGroup,
            'standingsByGroup' => $standingsByGroup,
            'filters' => [
                'groups' => $this->buildGroupFilters($groups),
            ],
        ];
    }

    private function buildStandingsByGroup(Collection $groups, Collection $standings, array $qualificationMap): array
    {
        if ($groups->isEmpty()) {
            return [];
        }

        $groupStandings = $standings->groupBy('group_id');

        return $groups->map(function (Group $group) use ($groupStandings, $qualificationMap) {
            $items = $groupStandings->get($group->id, collect());

            $mappedStandings = $items->map(function (GroupStanding $standing) use ($qualificationMap) {
                $team = $standing->team;
                $qualification = $qualificationMap[$standing->team_id] ?? null;

                return (object) [
                    'played' => $standing->played,
                    'won' => $standing->won,
                    'drawn' => $standing->drawn,
                    'lost' => $standing->lost,
                    'goal_diff' => $standing->goal_difference,
                    'points' => $standing->points,
                    'team' => (object) [
                        'id' => $standing->team_id,
                        'slug' => $team?->slug,
                        'flag_url' => $team?->flag_image_api,
                        'name' => $team?->name_override ?: $team?->name_api ?: 'Takım',
                        'qualification' => $qualification ? (object) $qualification : null,
                    ],
                ];
            })->values();

            return (object) [
                'name' => $group->code ?: $group->name,
                'standings' => $mappedStandings,
            ];
        })->values()->all();
    }

    private function buildGroupFilters(Collection $groups): array
    {
        if ($groups->isEmpty()) {
            return [];
        }

        return $groups
            ->pluck('name')
            ->filter()
            ->unique()
            ->map(fn ($name) => str_replace('Group ', '', $name))
            ->values()
            ->all();
    }
}


<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\GroupStanding;
use App\Models\WorldCup\WorldCup;
use Illuminate\Support\Collection;

class WorldCupRankingService
{
    /**
     * Get qualification map for a specific tournament.
     *
     * @param int|null $tournamentId
     * @return array
     */
    public function getQualificationMap(?int $tournamentId): array
    {
        if (!$tournamentId) {
            return [];
        }

        $tournament = WorldCup::find($tournamentId);
        if (!$tournament) {
            return [];
        }

        $year = $tournament->year;
        $config = config("worldcup.$year");

        // If no config for this year, return empty map (fallback)
        if (!$config) {
            return [];
        }

        $standings = GroupStanding::query()
            ->with(['team', 'group'])
            ->where('tournament_id', $tournamentId)
            ->whereHas('group', function ($query) {
                // Ignore pseudo-groups
                $query->where('name', '!=', 'Ranking of third-placed teams');
            })
            ->orderBy('group_id')
            ->orderBy('position')
            ->get();

        if ($standings->isEmpty()) {
            return [];
        }

        $map = [];
        $thirdPlacedTeams = collect();

        // Step 1: Identify 1st, 2nd, 3rd, 4th
        $groupedStandings = $standings->groupBy('group_id');

        foreach ($groupedStandings as $groupId => $groupItems) {
            foreach ($groupItems as $standing) {
                $pos = (int) $standing->position;
                $teamId = $standing->team_id;

                if ($pos === 1 || $pos === 2) {
                    $map[$teamId] = [
                        'status' => 'qualified_direct',
                        'label' => 'Doğrudan üst tura çıktı',
                    ];
                } elseif ($pos === 3) {
                    // Collect candidate for ranking
                    $thirdPlacedTeams->push($standing);
                } else {
                    $map[$teamId] = [
                        'status' => 'eliminated',
                        'label' => 'Elendi',
                    ];
                }
            }
        }

        // Step 2: Rank the 3rd placed teams
        if ($thirdPlacedTeams->isNotEmpty()) {
            $sortedThirds = $this->rankThirdPlacedTeams($thirdPlacedTeams, $config['ranking_sort_fields']);
            
            $bestThirdSlots = $config['best_third_slots'] ?? 0;

            foreach ($sortedThirds as $index => $standing) {
                $teamId = $standing->team_id;
                
                if ($index < $bestThirdSlots) {
                    $map[$teamId] = [
                        'status' => 'qualified_best_third',
                        'label' => 'En iyi 3.’ler kontenjanından çıkıyor',
                    ];
                } else {
                    $map[$teamId] = [
                        'status' => 'eliminated_third',
                        'label' => '3. sırada ancak yeterli değil',
                    ];
                }
            }
        }

        return $map;
    }

    /**
     * Rank third-placed teams based on config rules.
     */
    private function rankThirdPlacedTeams(Collection $thirds, array $sortFields): Collection
    {
        return $thirds->sort(function ($a, $b) use ($sortFields) {
            foreach ($sortFields as $field => $direction) {
                if ($a->{$field} === $b->{$field}) {
                    continue;
                }

                if ($direction === 'desc') {
                    return $b->{$field} <=> $a->{$field};
                } else {
                    return $a->{$field} <=> $b->{$field};
                }
            }
            return 0;
        })->values();
    }
}

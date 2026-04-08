<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\Group;
use App\Models\WorldCup\GroupStanding;
use App\Models\WorldCup\WorldCup;
use Illuminate\Support\Collection;

class WorldCupStatService
{
    public function getIndexData(): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $tournamentId = $activeTournament?->id;

        $groups = collect();
        $standings = collect();

        if ($tournamentId) {
            $groups = Group::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->orderBy('sort_order')
                ->orderBy('code')
                ->get();

            $standings = GroupStanding::query()
                ->with(['group', 'team'])
                ->where('tournament_id', $tournamentId)
                ->orderBy('group_id')
                ->orderBy('position')
                ->get();
        }

        return [
            'activeTournament' => $activeTournament,
            'groups' => $groups,
            'groupStandings' => $standings,
            'summaryStats' => $this->buildSummaryStats($standings),
            'rankingRows' => [],
            'teamStats' => $this->buildTeamStats($standings),
            'filters' => [
                'groups' => $this->buildGroupFilters($groups),
            ],
        ];
    }

    private function buildGroupFilters(Collection $groups): array
    {
        if ($groups->isEmpty()) {
            return [];
        }

        return $groups
            ->pluck('code')
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function buildSummaryStats(Collection $standings): array
    {
        if ($standings->isEmpty()) {
            return [
                ['label' => 'Toplam Maç', 'value' => '—'],
                ['label' => 'Toplam Gol', 'value' => '—'],
                ['label' => 'Ort. Gol/Maç', 'value' => '—'],
                ['label' => 'Katılımcı Takım', 'value' => '—'],
            ];
        }

        $totalTeams = $standings->pluck('team_id')->unique()->count();
        $totalPlayed = (int) $standings->sum('played');
        $totalMatches = $totalPlayed > 0 ? intdiv($totalPlayed, 2) : 0;
        $totalGoals = (int) $standings->sum('goals_for');
        $avgGoals = $totalMatches > 0 ? round($totalGoals / $totalMatches, 2) : null;

        return [
            ['label' => 'Toplam Maç', 'value' => (string) $totalMatches],
            ['label' => 'Toplam Gol', 'value' => (string) $totalGoals],
            ['label' => 'Ort. Gol/Maç', 'value' => $avgGoals === null ? '—' : number_format($avgGoals, 2, '.', '')],
            ['label' => 'Katılımcı Takım', 'value' => (string) $totalTeams],
        ];
    }

    private function buildTeamStats(Collection $standings): array
    {
        if ($standings->isEmpty()) {
            return [
                ['title' => 'En Çok Gol Atan', 'icon' => '⚽', 'team' => '—', 'value' => '— gol'],
                ['title' => 'En Az Gol Yiyen', 'icon' => '🛡️', 'team' => '—', 'value' => '— gol'],
                ['title' => 'En İyi Averaj', 'icon' => '📈', 'team' => '—', 'value' => '— averaj'],
            ];
        }

        $topScoring = $this->pickTeamByMetric($standings, 'goals_for', 'desc');
        $bestDefense = $this->pickTeamByMetric($standings, 'goals_against', 'asc');
        $bestDifference = $this->pickTeamByMetric($standings, 'goal_difference', 'desc');

        return [
            [
                'title' => 'En Çok Gol Atan',
                'icon' => '⚽',
                'team' => $topScoring['team'] ?? '—',
                'value' => isset($topScoring['value']) ? $topScoring['value'] . ' gol' : '—',
            ],
            [
                'title' => 'En Az Gol Yiyen',
                'icon' => '🛡️',
                'team' => $bestDefense['team'] ?? '—',
                'value' => isset($bestDefense['value']) ? $bestDefense['value'] . ' gol' : '—',
            ],
            [
                'title' => 'En İyi Averaj',
                'icon' => '📈',
                'team' => $bestDifference['team'] ?? '—',
                'value' => isset($bestDifference['value']) ? $bestDifference['value'] . ' averaj' : '—',
            ],
        ];
    }

    private function pickTeamByMetric(Collection $standings, string $field, string $direction): ?array
    {
        $candidates = $standings->filter(fn (GroupStanding $standing) => (bool) $standing->team);

        if ($candidates->isEmpty()) {
            return null;
        }

        $sorted = $direction === 'asc'
            ? $candidates->sortBy($field)->values()
            : $candidates->sortByDesc($field)->values();

        $best = $sorted->first();

        if (! $best) {
            return null;
        }

        return [
            'team' => $best->team?->name_override ?: $best->team?->name_api ?: 'Takım',
            'value' => $best->{$field},
        ];
    }
}

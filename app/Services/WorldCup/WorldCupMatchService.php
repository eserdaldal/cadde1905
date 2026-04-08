<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\WorldCupMatch;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class WorldCupMatchService
{
    public function getIndexData(): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $tournamentId = $activeTournament?->id;

        $matches = collect();
        $featuredMatches = collect();

        if ($tournamentId) {
            $matches = WorldCupMatch::query()
                ->with(['homeTeam', 'awayTeam', 'stadium'])
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->orderBy('kickoff_at')
                ->limit(50)
                ->get();

            $featuredMatches = WorldCupMatch::query()
                ->with(['homeTeam', 'awayTeam', 'stadium'])
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_featured', true)
                ->orderBy('kickoff_at')
                ->limit(6)
                ->get();
        }

        $filters = [
            'rounds' => $this->buildRoundFilters($matches),
        ];

        return [
            'activeTournament' => $activeTournament,
            'matches' => $this->mapMatches($matches),
            'featuredMatches' => $this->mapMatches($featuredMatches),
            'filters' => $filters,
        ];
    }

    public function getShowData(WorldCupMatch $match): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        // Eager load necessary relations for the detail page
        $match->load(['homeTeam', 'awayTeam', 'stadium', 'winnerTeam']);

        return [
            'activeTournament' => $activeTournament,
            'match' => $this->mapMatch($match),
        ];
    }

    public function buildMatchSlug(WorldCupMatch $match): string
    {
        $homeName = $match->homeTeam ? ($match->homeTeam->name_override ?: $match->homeTeam->name_api) : null;
        $awayName = $match->awayTeam ? ($match->awayTeam->name_override ?: $match->awayTeam->name_api) : null;

        return $this->makeMatchSlug($homeName, $awayName, (int) $match->id);
    }

    private function buildRoundFilters(Collection $matches): array
    {
        $defaults = ['Tümü', 'Grup Aşaması', 'Son 32', 'Son 16', 'Çeyrek Final', 'Yarı Final', 'Final'];

        if ($matches->isEmpty()) {
            return $defaults;
        }

        $items = $matches
            ->pluck('round_name')
            ->merge($matches->pluck('stage'))
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

    private function mapMatches(Collection $matches): array
    {
        return $matches->map(function (WorldCupMatch $match) {
            $homeTeam = $match->homeTeam;
            $awayTeam = $match->awayTeam;
            $stadium = $match->stadium;
            $kickoffAt = $match->kickoff_at;

            $homeName = $homeTeam ? ($homeTeam->name_override ?: $homeTeam->name_api) : null;
            $awayName = $awayTeam ? ($awayTeam->name_override ?: $awayTeam->name_api) : null;

            return (object) [
                'id' => $match->id,
                'round' => $match->round_name ?: $match->stage,
                'date' => $kickoffAt,
                'date_key' => $kickoffAt?->format('Y-m-d'),
                'date_label' => $kickoffAt?->format('d M, H:i'),
                'date_heading' => $kickoffAt?->translatedFormat('d F Y, l'),
                'month_label' => $kickoffAt?->format('M'),
                'day_label' => $kickoffAt?->format('d'),
                'time' => $kickoffAt?->format('H:i'),
                'home' => $homeName,
                'away' => $awayName,
                'home_flag_url' => $homeTeam?->flag_image_api,
                'away_flag_url' => $awayTeam?->flag_image_api,
                'home_score' => $match->home_score,
                'away_score' => $match->away_score,
                'stadium' => $stadium ? ($stadium->name_override ?: $stadium->name_api) : null,
                'slug' => $this->makeMatchSlug($homeName, $awayName, (int) $match->id),
            ];
        })->all();
    }

    private function mapMatch(?WorldCupMatch $match): ?object
    {
        if (! $match) {
            return null;
        }

        $homeTeam = $match->homeTeam;
        $awayTeam = $match->awayTeam;
        $stadium = $match->stadium;
        $winnerTeam = $match->winnerTeam;
        $kickoffAt = $match->kickoff_at;

        $homeName = $homeTeam ? ($homeTeam->name_override ?: $homeTeam->name_api) : null;
        $awayName = $awayTeam ? ($awayTeam->name_override ?: $awayTeam->name_api) : null;

        return (object) [
            'id' => $match->id,
            'round' => $match->round_name ?: $match->stage,
            'date' => $kickoffAt,
            'date_label' => $kickoffAt?->format('d M Y, H:i'),
            'status' => $match->status,
            'home_score' => $match->home_score,
            'away_score' => $match->away_score,
            'home_penalty_score' => $match->home_penalty_score,
            'away_penalty_score' => $match->away_penalty_score,
            'homeTeam' => (object) [
                'slug' => $homeTeam?->slug,
                'name' => $homeTeam ? ($homeTeam->name_override ?: $homeTeam->name_api) : null,
                'flag_url' => $homeTeam?->flag_image_api,
                'flag_emoji' => '🏳️',
            ],
            'awayTeam' => (object) [
                'slug' => $awayTeam?->slug,
                'name' => $awayName,
                'flag_url' => $awayTeam?->flag_image_api,
                'flag_emoji' => '🏳️',
            ],
            'stadium' => (object) [
                'name' => $stadium ? ($stadium->name_override ?: $stadium->name_api) : null,
                'city' => $stadium?->city_api,
                'capacity' => $stadium?->capacity,
            ],
            'winnerTeam' => $winnerTeam ? (object) [
                'slug' => $winnerTeam->slug,
                'name' => $winnerTeam->name_override ?: $winnerTeam->name_api,
            ] : null,
            'slug' => $this->makeMatchSlug($homeName, $awayName, (int) $match->id),
        ];
    }

    private function makeMatchSlug(?string $homeName, ?string $awayName, int $matchId): string
    {
        $homeSlug = $homeName ? Str::slug($homeName) : '';
        $awaySlug = $awayName ? Str::slug($awayName) : '';
        $teamsPart = trim($homeSlug . '-' . $awaySlug, '-');
        $teamsPart = $teamsPart !== '' ? $teamsPart : 'match';

        return $teamsPart . '-' . $matchId;
    }
}

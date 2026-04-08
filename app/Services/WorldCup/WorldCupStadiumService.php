<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\Stadium;
use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\WorldCupMatch;
use Illuminate\Support\Collection;

class WorldCupStadiumService
{
    public function getIndexData(): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $tournamentId = $activeTournament?->id;

        $stadiums = collect();
        $featuredStadiums = collect();

        if ($tournamentId) {
            $stadiums = Stadium::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->orderByDesc('is_featured')
                ->orderBy('name_override')
                ->orderBy('name_api')
                ->get();

            $featuredStadiums = Stadium::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_featured', true)
                ->orderBy('name_override')
                ->orderBy('name_api')
                ->limit(12)
                ->get();
        }

        $filters = [
            'countries' => $this->buildCountryFilters($stadiums),
        ];

        return [
            'activeTournament' => $activeTournament,
            'stadiums' => $this->mapStadiums($stadiums),
            'featuredStadiums' => $this->mapStadiums($featuredStadiums),
            'filters' => $filters,
        ];
    }

    public function getShowData(string $slug): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $stadium = null;

        if ($activeTournament) {
            $stadium = Stadium::query()
                ->where('tournament_id', $activeTournament->id)
                ->where('slug', $slug)
                ->first();
        }

        $matches = collect();

        if ($stadium) {
            // FAZ 9: Optimasyon - Eager Loading ve Sıralama (kickoff_at)
            $matches = WorldCupMatch::query()
                ->with(['homeTeam', 'awayTeam', 'stadium']) // Eager Load
                ->where('tournament_id', $stadium->tournament_id)
                ->where('stadium_id', $stadium->id)
                ->where('is_visible', true)
                ->orderBy('kickoff_at', 'asc') // Tarihe göre sıralı
                ->get();
        }

        return [
            'activeTournament' => $activeTournament,
            'stadium' => $stadium ? $this->mapStadium($stadium) : null,
            'relatedMatches' => $this->mapMatches($matches),
        ];
    }

    private function buildCountryFilters(Collection $stadiums): array
    {
        $defaults = ['Tümü'];

        if ($stadiums->isEmpty()) {
            return $defaults;
        }

        $items = $stadiums
            ->pluck('country_api')
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

    private function mapStadiums(Collection $stadiums): array
    {
        return $stadiums->map(function (Stadium $stadium) {
            return (object) [
                'slug' => $stadium->slug,
                'name' => $stadium->name_override ?: $stadium->name_api,
                'city' => $stadium->city_api,
                'country' => $stadium->country_api,
                'capacity' => $stadium->display_capacity,
            ];
        })->all();
    }

    private function mapStadium(Stadium $stadium): object
    {
        // FAZ 9: Tüm yeni içerik alanları veri objesine ekleniyor
        return (object) [
            'slug' => $stadium->slug,
            'name' => $stadium->name_override ?: $stadium->name_api,
            'city' => $stadium->city_api,
            'country' => $stadium->country_api,
            'capacity' => $stadium->display_capacity,
            'description' => $stadium->description,
            'hero_image' => $stadium->hero_image,
            'seating_plan_image' => $stadium->seating_plan_image,
            'gallery' => is_array($stadium->gallery) ? $stadium->gallery : [],
            'address' => $stadium->address,
            'opened_year' => $stadium->opened_year,
            'surface_type' => $stadium->surface_type,
            'meta_title' => $stadium->meta_title,
            'meta_description' => $stadium->meta_description,
            'image_url' => $stadium->image_override ?: (is_array($stadium->gallery) && count($stadium->gallery) > 0 ? $stadium->gallery[0] : null),
        ];
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
                'time' => $kickoffAt?->format('H:i'),
                'kickoff_at' => $kickoffAt,
                'home_score' => $match->home_score,
                'away_score' => $match->away_score,
                'homeTeam' => (object) [
                    'name' => $homeTeam ? ($homeTeam->name_override ?: $homeTeam->name_api) : ($match->home_team_name_api ?? 'Takım 1'),
                    'flag_url' => $homeTeam?->flag_image_api,
                    'flag_emoji' => '🏳️',
                ],
                'awayTeam' => (object) [
                    'name' => $awayTeam ? ($awayTeam->name_override ?: $awayTeam->name_api) : ($match->away_team_name_api ?? 'Takım 2'),
                    'flag_url' => $awayTeam?->flag_image_api,
                    'flag_emoji' => '🏳️',
                ],
                'stadium' => (object) [
                    'name' => $stadium ? ($stadium->name_override ?: $stadium->name_api) : null,
                    'city' => $stadium?->city_api,
                    'slug' => $stadium?->slug,
                ],
            ];
        })->all();
    }
}

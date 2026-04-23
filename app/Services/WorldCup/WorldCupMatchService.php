<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\WorldCupMatch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class WorldCupMatchService
{
    public function getIndexData(Request $request): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $tournamentId = $activeTournament?->id;
        $perPage = $this->resolvePerPage($request);

        $matches = [];
        $featuredMatches = collect();
        $matchesPaginator = $this->emptyPaginator($request, $perPage);
        $hasMatchesDataset = false;
        $roundFilterSource = collect();

        if ($tournamentId) {
            $baseQuery = $this->buildVisibleMatchesBaseQuery($tournamentId);
            $roundFilterSource = (clone $baseQuery)->select(['round_name', 'stage'])->get();

            $matchesPaginator = (clone $baseQuery)
                ->paginate($perPage)
                ->withQueryString();

            $matchesPaginator = $this->mapMatchPaginator($matchesPaginator);
            $hasMatchesDataset = $matchesPaginator->total() > 0;
            $matches = $matchesPaginator->getCollection()->values()->all();

            if (! $hasMatchesDataset) {
                $featuredMatches = WorldCupMatch::query()
                ->with(['homeTeam', 'awayTeam', 'stadium'])
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_featured', true)
                ->orderBy('kickoff_at')
                ->orderBy('id')
                ->limit(6)
                ->get();
            }
        }

        $filters = [
            'rounds' => $this->buildRoundFilters($roundFilterSource),
        ];

        return [
            'activeTournament' => $activeTournament,
            'matches' => $matches,
            'matchesPaginator' => $matchesPaginator,
            'hasMatchesDataset' => $hasMatchesDataset,
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

    private function buildVisibleMatchesBaseQuery(int $tournamentId): Builder
    {
        return WorldCupMatch::query()
            ->with(['homeTeam', 'awayTeam', 'stadium'])
            ->where('tournament_id', $tournamentId)
            ->where('is_visible', true)
            ->orderBy('kickoff_at')
            ->orderBy('id');
    }

    private function resolvePerPage(Request $request): int
    {
        $requested = (int) $request->query('per_page', 0);

        if ($requested > 0) {
            return max(5, min($requested, 60));
        }

        return $this->isMobileRequest($request) ? 10 : 24;
    }

    private function isMobileRequest(Request $request): bool
    {
        $userAgent = Str::lower((string) $request->userAgent());

        if ($userAgent === '') {
            return false;
        }

        if (Str::contains($userAgent, ['ipad', 'tablet'])) {
            return false;
        }

        return Str::contains($userAgent, ['iphone', 'android', 'mobile', 'windows phone', 'opera mini', 'blackberry', 'ipod', 'webos']);
    }

    private function emptyPaginator(Request $request, int $perPage): LengthAwarePaginator
    {
        $paginator = new LengthAwarePaginator(
            items: [],
            total: 0,
            perPage: $perPage,
            currentPage: 1,
            options: [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        $query = $request->query();
        unset($query['page']);

        if (! empty($query)) {
            $paginator->appends($query);
        }

        return $paginator;
    }

    private function mapMatchPaginator(LengthAwarePaginator $paginator): LengthAwarePaginator
    {
        $mappedItems = collect($this->mapMatches($paginator->getCollection()));
        $paginator->setCollection($mappedItems);

        return $paginator;
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

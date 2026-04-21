<?php

namespace App\Services\Search;

use App\Models\News;
use App\Models\Legend;
use App\Models\Trophy;
use App\Models\SeasonArchive;
use App\Models\HistoricalMatch;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SiteSearchService
{
    public function search(string $query): Collection
    {
        $q = trim($query);

        $results = collect();

        $results = $results->merge($this->searchNews($q));
        $results = $results->merge($this->searchLegends($q));
        $results = $results->merge($this->searchTrophies($q));
        $results = $results->merge($this->searchSeasons($q));
        $results = $results->merge($this->searchMatches($q));

        return $results->sortByDesc('score')->values();
    }

    private function searchNews(string $q): Collection
    {
        $results = collect();

        $items = News::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('summary', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get();

        foreach ($items as $item) {
            $score = 0;

            if (stripos($item->title, $q) !== false) $score += 60;
            if (stripos($item->summary ?? '', $q) !== false) $score += 30;
            if (stripos($item->content, $q) !== false) $score += 10;

            $results->push([
                'type' => 'Haber',
                'title' => $item->title,
                'url' => route('news.show', $item->slug),
                'excerpt' => Str::limit(strip_tags($item->summary ?? $item->content), 120),
                'date' => optional($item->published_at)->format('d.m.Y'),
                'score' => $score
            ]);
        }

        return $results;
    }

    private function searchLegends(string $q): Collection
    {
        $results = collect();

        $items = Legend::query()
            ->where('is_published', true)
            ->whereNull('deleted_at')
            ->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('title', 'like', "%{$q}%")
                    ->orWhere('summary', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get();

        foreach ($items as $item) {
            $score = 0;

            if (stripos($item->name, $q) !== false) $score += 80;
            if (stripos($item->title ?? '', $q) !== false) $score += 60;
            if (stripos($item->summary ?? '', $q) !== false) $score += 30;
            if (stripos($item->content, $q) !== false) $score += 10;

            $results->push([
                'type' => 'Efsane',
                'title' => $item->name,
                'url' => route('miras.legends.show', $item->slug),
                'excerpt' => Str::limit(strip_tags($item->summary ?? $item->content), 120),
                'date' => optional($item->published_at)->format('d.m.Y'),
                'score' => $score + 20
            ]);
        }

        return $results;
    }

    private function searchTrophies(string $q): Collection
    {
        $results = collect();

        $items = Trophy::query()
            ->where('is_active', true)
            ->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get();

        foreach ($items as $item) {
            $score = 0;

            if (stripos($item->name, $q) !== false) $score += 80;
            if (stripos($item->description ?? '', $q) !== false) $score += 30;
            if (stripos($item->content ?? '', $q) !== false) $score += 10;

            $results->push([
                'type' => 'Kupa',
                'title' => $item->name,
                'url' => route('miras.trophies.show', $item->slug),
                'excerpt' => Str::limit(strip_tags($item->description ?? $item->content), 120),
                'date' => null,
                'score' => $score + 20
            ]);
        }

        return $results;
    }

    private function searchSeasons(string $q): Collection
    {
        $results = collect();

        $items = SeasonArchive::query()
            ->where('is_published', true)
            ->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('summary', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%")
                    ->orWhere('season_label', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get();

        foreach ($items as $item) {
            $score = 0;

            if (stripos($item->title, $q) !== false) $score += 70;
            if (stripos($item->summary ?? '', $q) !== false) $score += 30;
            if (stripos($item->content ?? '', $q) !== false) $score += 10;

            $results->push([
                'type' => 'Sezon',
                'title' => $item->title,
                'url' => route('miras.seasons.show', $item->slug),
                'excerpt' => Str::limit(strip_tags($item->summary ?? $item->content), 120),
                'date' => $item->start_year . ' - ' . $item->end_year,
                'score' => $score + 15
            ]);
        }

        return $results;
    }

    private function searchMatches(string $q): Collection
    {
        $results = collect();

        $items = HistoricalMatch::query()
            ->where('is_published', true)
            ->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('summary', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%")
                    ->orWhere('opponent', 'like', "%{$q}%")
                    ->orWhere('competition', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get();

        foreach ($items as $item) {
            $score = 0;

            if (stripos($item->title, $q) !== false) $score += 70;
            if (stripos($item->opponent ?? '', $q) !== false) $score += 50;
            if (stripos($item->competition ?? '', $q) !== false) $score += 40;
            if (stripos($item->summary ?? '', $q) !== false) $score += 30;
            if (stripos($item->content ?? '', $q) !== false) $score += 10;

            $results->push([
                'type' => 'Tarihi Maç',
                'title' => $item->title,
                'url' => route('miras.matches.show', $item->slug),
                'excerpt' => Str::limit(strip_tags($item->summary ?? $item->content), 120),
                'date' => optional($item->match_date)->format('d.m.Y'),
                'score' => $score + 15
            ]);
        }

        return $results;
    }
}

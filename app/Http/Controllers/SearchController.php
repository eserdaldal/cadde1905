<?php

namespace App\Http\Controllers;

use App\Services\Search\SiteSearchService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function index(Request $request, SiteSearchService $service)
    {
        $query = trim((string) $request->query('q', ''));
        $activeType = (string) $request->query('type', 'all');

        $allResults = collect();

        if ($query !== '') {
            $allResults = $service->search($query);
        }

        $typeMap = [
            'all' => 'Tümü',
            'Haber' => 'Haberler',
            'Efsane' => 'Efsaneler',
            'Kupa' => 'Kupalar',
            'Sezon' => 'Sezonlar',
            'Tarihi Maç' => 'Tarihi Maçlar',
        ];

        if (! array_key_exists($activeType, $typeMap)) {
            $activeType = 'all';
        }

        $counts = [
            'all' => $allResults->count(),
            'Haber' => $allResults->where('type', 'Haber')->count(),
            'Efsane' => $allResults->where('type', 'Efsane')->count(),
            'Kupa' => $allResults->where('type', 'Kupa')->count(),
            'Sezon' => $allResults->where('type', 'Sezon')->count(),
            'Tarihi Maç' => $allResults->where('type', 'Tarihi Maç')->count(),
        ];

        $filteredResults = $activeType === 'all'
            ? $allResults->values()
            : $allResults->where('type', $activeType)->values();

        $results = $this->paginateCollection(
            $filteredResults,
            perPage: 6,
            page: (int) $request->query('page', 1),
            options: [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('pages.search.index', [
            'query' => $query,
            'results' => $results,
            'counts' => $counts,
            'activeType' => $activeType,
            'typeMap' => $typeMap,
        ]);
    }

    private function paginateCollection(
        Collection $items,
        int $perPage = 10,
        int $page = 1,
        array $options = []
    ): LengthAwarePaginator {
        $page = max($page, 1);
        $total = $items->count();

        $pagedItems = $items->slice(($page - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $pagedItems,
            $total,
            $perPage,
            $page,
            $options
        );
    }
}

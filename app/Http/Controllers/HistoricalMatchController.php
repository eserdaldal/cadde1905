<?php

namespace App\Http\Controllers;

use App\Models\HistoricalMatch;
use Illuminate\View\View;

class HistoricalMatchController extends Controller
{
    public function index(): View
    {
        $items = HistoricalMatch::query()
            ->where('is_published', true)
            ->orderByDesc('match_date')
            ->orderByDesc('id')
            ->paginate(12);

        return view('pages.miras.historical-matches.index', [
            'pageTitle' => 'Tarihi Maçlar',
            'pageDescription' => 'Galatasaray tarihinin seçilmiş, anlatı değeri yüksek maçları.',
            'items' => $items,
        ]);
    }

    public function show(string $slug): View
    {
        $historicalMatch = HistoricalMatch::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.miras.historical-matches.show', [
            'historicalMatch' => $historicalMatch,
            'pageTitle' => $historicalMatch->title,
            'pageDescription' => $historicalMatch->summary,
        ]);
    }
}
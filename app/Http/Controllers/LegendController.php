<?php

namespace App\Http\Controllers;

use App\Models\Legend;
use Illuminate\View\View;

class LegendController extends Controller
{
    public function index(): View
    {
        $items = Legend::query()
            ->with('coverMedia')
            ->whereNull('deleted_at')
            ->where('is_published', true)
            ->orderBy('name')
            ->paginate(12);

        return view('pages.miras.legends.index', [
            'pageTitle' => 'Efsaneler',
            'pageDescription' => 'Galatasaray tarihindeki öne çıkan efsane isimler.',
            'items' => $items,
        ]);
    }

    public function show(string $slug): View
    {
        $legend = Legend::query()
            ->with('coverMedia')
            ->where('slug', $slug)
            ->whereNull('deleted_at')
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.miras.legends.show', [
            'legend' => $legend,
            'pageTitle' => $legend->name,
            'pageDescription' => $legend->summary,
        ]);
    }
}

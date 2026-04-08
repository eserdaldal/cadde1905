<?php

namespace App\Http\Controllers;

use App\Models\Trophy;
use Illuminate\View\View;

class TrophyController extends Controller
{
    public function index(): View
    {
        $items = Trophy::query()
            ->with('coverMedia')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        return view('pages.miras.trophies.index', [
            'pageTitle' => 'Kupalar',
            'pageDescription' => 'Galatasaray tarihindeki kupa referansları.',
            'items' => $items,
        ]);
    }

    public function show(string $slug): View
    {
        $trophy = Trophy::query()
            ->with('coverMedia')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.miras.trophies.show', [
            'trophy' => $trophy,
            'pageTitle' => $trophy->name,
            'pageDescription' => $trophy->description,
        ]);
    }
}
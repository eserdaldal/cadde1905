<?php

namespace App\Http\Controllers;

use App\Models\SeasonArchive;
use Illuminate\View\View;

class SeasonArchiveController extends Controller
{
    public function index(): View
    {
        $items = SeasonArchive::query()
            ->where('is_published', true)
            ->orderByDesc('start_year')
            ->orderByDesc('id')
            ->paginate(12);

        return view('pages.miras.season-archives.index', [
            'pageTitle' => 'Sezonlar',
            'pageDescription' => 'Galatasaray tarihindeki seçilmiş sezon dosyaları.',
            'items' => $items,
        ]);
    }

    public function show(string $slug): View
    {
        $seasonArchive = SeasonArchive::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.miras.season-archives.show', [
            'seasonArchive' => $seasonArchive,
            'pageTitle' => $seasonArchive->title,
            'pageDescription' => $seasonArchive->summary,
        ]);
    }
}
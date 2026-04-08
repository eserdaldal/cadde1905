<?php

namespace App\Http\Controllers;

use App\Models\SeasonArchive;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeasonArchivePreviewController extends Controller
{
    public function show(Request $request, SeasonArchive $seasonArchive): View
    {
        abort_unless($request->hasValidSignature(), 403);

        return view('pages.miras.season-archives.show', [
            'season' => $seasonArchive,
            'seasonArchive' => $seasonArchive,
            'item' => $seasonArchive,
            'pageTitle' => $seasonArchive->title,
            'pageDescription' => $seasonArchive->summary,
        ]);
    }
}
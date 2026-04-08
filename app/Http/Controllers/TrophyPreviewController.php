<?php

namespace App\Http\Controllers;

use App\Models\Trophy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrophyPreviewController extends Controller
{
    public function show(Request $request, Trophy $trophy): View
    {
        abort_unless($request->hasValidSignature(), 403);

        return view('pages.miras.trophies.show', [
            'trophy' => $trophy,
            'pageTitle' => $trophy->name,
            'pageDescription' => $trophy->description,
        ]);
    }
}
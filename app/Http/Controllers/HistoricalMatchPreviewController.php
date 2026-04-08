<?php

namespace App\Http\Controllers;

use App\Models\HistoricalMatch;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoricalMatchPreviewController extends Controller
{
    public function show(Request $request, HistoricalMatch $historicalMatch): View
    {
        abort_unless($request->hasValidSignature(), 403);

        return view('pages.miras.historical-matches.show', [
            'match' => $historicalMatch,
            'historicalMatch' => $historicalMatch,
            'item' => $historicalMatch,
            'pageTitle' => $historicalMatch->title,
            'pageDescription' => $historicalMatch->summary,
        ]);
    }
}
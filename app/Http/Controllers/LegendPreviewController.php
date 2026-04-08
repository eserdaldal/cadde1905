<?php

namespace App\Http\Controllers;

use App\Models\Legend;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LegendPreviewController extends Controller
{
    public function show(Request $request, Legend $legend): View
    {
        abort_unless($request->hasValidSignature(), 403);

        return view('pages.miras.legends.show', [
            'legend' => $legend,
            'pageTitle' => $legend->name,
            'pageDescription' => $legend->summary,
        ]);
    }
}
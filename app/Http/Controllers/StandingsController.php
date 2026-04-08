<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Pages\StandingsPageService;
use Illuminate\Contracts\View\View;

class StandingsController extends Controller
{
    public function index(StandingsPageService $standingsPageService): View
    {
        return view('pages.standings', $standingsPageService->build());
    }
}
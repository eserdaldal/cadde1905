<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Pages\MatchPageService;
use Illuminate\Contracts\View\View;

class MatchController extends Controller
{
    public function show(MatchPageService $matchPageService): View
    {
        return view('pages.match', $matchPageService->build());
    }
}
<?php

declare(strict_types=1);

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use App\Services\Pages\MatchDetailService;
use Illuminate\Contracts\View\View;

class MatchDetailController extends Controller
{
    public function show(int $fixture_id, MatchDetailService $service): View
    {
        return view('pages.match-detail', $service->build($fixture_id));
    }
}

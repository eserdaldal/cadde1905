<?php

namespace App\Http\Controllers\WorldCup;

use App\Http\Controllers\Controller;
use App\Services\WorldCup\WorldCupStatService;
use Illuminate\View\View;

class WorldCupStatController extends Controller
{
    public function __construct(private readonly WorldCupStatService $statService)
    {
    }

    public function index(): View
    {
        $data = $this->statService->getIndexData();

        return view('worldcup.stats.index', $data);
    }
}

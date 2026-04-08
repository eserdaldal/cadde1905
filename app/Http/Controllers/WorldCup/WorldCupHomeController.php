<?php

namespace App\Http\Controllers\WorldCup;

use App\Http\Controllers\Controller;
use App\Services\WorldCup\WorldCupHomeService;
use Illuminate\View\View;

class WorldCupHomeController extends Controller
{
    public function __construct(private readonly WorldCupHomeService $homeService)
    {
    }

    public function index(): View
    {
        $data = $this->homeService->getHomeData();

        return view('worldcup.index', $data);
    }
}

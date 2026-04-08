<?php

namespace App\Http\Controllers\WorldCup;

use App\Http\Controllers\Controller;
use App\Services\WorldCup\WorldCupPlayerService;
use Illuminate\View\View;

class WorldCupPlayerController extends Controller
{
    public function __construct(private readonly WorldCupPlayerService $playerService)
    {
    }

    public function index(): View
    {
        $data = $this->playerService->getIndexData();

        return view('worldcup.aslanlar.index', $data);
    }

    public function show(string $player): View
    {
        $data = $this->playerService->getShowData($player);

        return view('worldcup.aslanlar.show', $data);
    }
}

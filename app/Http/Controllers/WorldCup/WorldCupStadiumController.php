<?php

namespace App\Http\Controllers\WorldCup;

use App\Http\Controllers\Controller;
use App\Services\WorldCup\WorldCupStadiumService;
use Illuminate\View\View;

class WorldCupStadiumController extends Controller
{
    public function __construct(private readonly WorldCupStadiumService $stadiumService)
    {
    }

    public function index(): View
    {
        $data = $this->stadiumService->getIndexData();

        return view('worldcup.stadiums.index', $data);
    }

    public function show(string $stadium): View
    {
        $data = $this->stadiumService->getShowData($stadium);

        return view('worldcup.stadiums.show', $data);
    }
}

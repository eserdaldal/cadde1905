<?php

namespace App\Http\Controllers\WorldCup;

use App\Http\Controllers\Controller;
use App\Services\WorldCup\WorldCupTeamService;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WorldCupTeamController extends Controller
{
    public function __construct(private readonly WorldCupTeamService $teamService)
    {
    }

    public function index(): View
    {
        $data = $this->teamService->getIndexData();

        return view('worldcup.teams.index', $data);
    }

    public function show(string $team): View
    {
        $data = $this->teamService->getShowData($team);

        if (! $data['team']) {
            throw new NotFoundHttpException();
        }

        return view('worldcup.teams.show', $data);
    }
}

<?php

namespace App\Http\Controllers\WorldCup;

use App\Http\Controllers\Controller;
use App\Services\WorldCup\WorldCupGroupService;
use Illuminate\View\View;

class WorldCupGroupController extends Controller
{
    public function __construct(private readonly WorldCupGroupService $groupService)
    {
    }

    public function index(): View
    {
        $data = $this->groupService->getIndexData();

        return view('worldcup.groups.index', $data);
    }
}

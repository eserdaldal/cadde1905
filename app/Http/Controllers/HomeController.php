<?php

namespace App\Http\Controllers;

use App\Services\Homepage\HomepageCompositionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class HomeController extends Controller
{
    public function index(Request $request, HomepageCompositionService $homepageCompositionService): View
    {
        $page = $homepageCompositionService->compose();

        return view('pages.home', [
            'page' => $page,
        ]);
    }
}

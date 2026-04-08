<?php

namespace App\Http\Controllers;

use App\Services\Timeline\TimelinePageService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TimelineController extends Controller
{
    public function __invoke(Request $request, TimelinePageService $timelinePageService): View
    {
        $selectedType = $request->string('type')->toString();

        $entries = $timelinePageService->getEntries(
            $selectedType ?: null,
            20
        );

        return view('pages.timeline.index', [
            'pageTitle' => 'Galatasaray Tarihi',
            'pageDescription' => 'Galatasaray tarihindeki önemli anlar, dönemler, başarılar ve seçilmiş içerikler kronolojik akışta.',
            'selectedType' => $selectedType,
            'filterOptions' => $timelinePageService->getFilterOptions(),
            'entries' => $entries,
        ]);
    }
}
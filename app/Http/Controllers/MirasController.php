<?php

namespace App\Http\Controllers;

use App\Models\HistoryEvent;
use App\Models\HistoricalMatch;
use App\Models\Legend;
use App\Models\TimelineEntry;
use App\Models\Trophy;
use Illuminate\View\View;

class MirasController extends Controller
{
    public function index(): View
    {
        $featuredAchievement = HistoryEvent::query()
            ->where('is_published', true)
            ->where('type', 'achievement')
            ->orderByDesc('is_featured')
            ->orderByDesc('importance_score')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->first();

        $featuredLegends = Legend::query()
            ->with('coverMedia')
            ->whereNull('deleted_at')
            ->where('is_published', true)
            ->orderBy('era_start_year')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $featuredMatch = HistoricalMatch::query()
            ->where('is_published', true)
            ->orderByDesc('is_featured')
            ->orderByDesc('importance_score')
            ->orderByDesc('match_date')
            ->orderByDesc('id')
            ->first();

        $featuredMoments = HistoryEvent::query()
            ->where('is_published', true)
            ->where('type', 'moment')
            ->orderByDesc('is_featured')
            ->orderByDesc('importance_score')
            ->orderByDesc('event_date')
            ->orderByDesc('year')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $featuredTrophies = Trophy::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(3)
            ->get();

        $timelineEntries = TimelineEntry::query()
            ->with('source')
            ->visible()
            ->whereNotNull('timeline_date')
            ->orderByDesc('timeline_date')
            ->orderByDesc('position')
            ->orderByDesc('id')
            ->limit(8)
            ->get()
            ->sortBy('timeline_date')
            ->values();

        return view('pages.miras.index', [
            'pageTitle' => 'Miras',
            'pageDescription' => 'Galatasaray tarihindeki unutulmaz anlar, efsaneler ve kupalar; küratöryel seçkiler ve kronolojiyle bir arada.',
            'stats' => [
                'moments' => HistoryEvent::query()->where('is_published', true)->where('type', 'moment')->count(),
                'achievements' => HistoryEvent::query()->where('is_published', true)->where('type', 'achievement')->count(),
                'matches' => HistoricalMatch::query()->where('is_published', true)->count(),
                'legends' => Legend::query()->whereNull('deleted_at')->where('is_published', true)->count(),
                'trophies' => Trophy::query()->where('is_active', true)->count(),
            ],
            'featuredAchievement' => $featuredAchievement,
            'featuredLegends' => $featuredLegends,
            'featuredMatch' => $featuredMatch,
            'featuredMoments' => $featuredMoments,
            'featuredTrophies' => $featuredTrophies,
            'timelineEntries' => $timelineEntries,
        ]);
    }
}

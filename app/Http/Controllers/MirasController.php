<?php

namespace App\Http\Controllers;

use App\Models\HistoryEvent;
use App\Models\HistoricalMatch;
use App\Models\Legend;
use App\Models\SeasonArchive;
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

        $featuredLegend = Legend::query()
            ->with('coverMedia')
            ->whereNull('deleted_at')
            ->orderBy('era_start_year')
            ->orderByDesc('id')
            ->first();

        $featuredSeason = SeasonArchive::query()
            ->where('is_published', true)
            ->orderByDesc('is_featured')
            ->orderByDesc('importance_score')
            ->orderByDesc('start_year')
            ->orderByDesc('id')
            ->first();

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

        return view('pages.miras.index', [
            'pageTitle' => 'Miras',
            'pageDescription' => 'Galatasaray tarihinin anları, dönemleri, kadroları, başarıları, tarihi maçları, sezonları, efsaneleri ve kupaları.',
            'stats' => [
                'moments' => HistoryEvent::query()->where('is_published', true)->where('type', 'moment')->count(),
                'eras' => HistoryEvent::query()->where('is_published', true)->where('type', 'era')->count(),
                'squads' => HistoryEvent::query()->where('is_published', true)->where('type', 'squad')->count(),
                'achievements' => HistoryEvent::query()->where('is_published', true)->where('type', 'achievement')->count(),
                'milestones' => HistoryEvent::query()->where('is_published', true)->where('type', 'milestone')->count(),
                'matches' => HistoricalMatch::query()->where('is_published', true)->count(),
                'seasons' => SeasonArchive::query()->where('is_published', true)->count(),
                'legends' => Legend::query()->whereNull('deleted_at')->count(),
                'trophies' => Trophy::query()->where('is_active', true)->count(),
            ],
            'featuredAchievement' => $featuredAchievement,
            'featuredLegend' => $featuredLegend,
            'featuredSeason' => $featuredSeason,
            'featuredMatch' => $featuredMatch,
            'featuredMoments' => $featuredMoments,
            'featuredTrophies' => $featuredTrophies,
        ]);
    }
}
<?php

declare(strict_types=1);

namespace App\Listeners\Sports;

use App\Events\Sports\SportsSnapshotUpdated;
use App\Support\Widgets\WidgetCache;
use Illuminate\Support\Facades\Cache;

final class ClearSportsCache
{
    /**
     * Handle the event.
     */
    public function handle(SportsSnapshotUpdated $event): void
    {
        if ($event->scopeType === 'team') {
            $this->clearTeamCaches($event);
        } elseif ($event->scopeType === 'league') {
            $this->clearLeagueCaches($event);
        }
    }

    private function clearTeamCaches(SportsSnapshotUpdated $event): void
    {
        // 1. Page Cache (Match Center)
        $matchPageKey = sprintf(
            'page.match_center.team_%d.season_%d',
            $event->scopeId,
            $event->season
        );
        Cache::forget($matchPageKey);

        // 2. Widget Cache (Next Match)
        // WidgetCache key üretirken props hash kullanıyor. Props: ['team_id', 'season']
        WidgetCache::forget('next_match', 'team', [
            'team_id' => $event->scopeId,
            'season' => $event->season,
        ]);
    }

    private function clearLeagueCaches(SportsSnapshotUpdated $event): void
    {
        // 1. Page Cache (Standings)
        // StandingsPageService limit=20 kullanıyor
        $standingsPageKey = sprintf(
            'page.standings.league_%d.season_%d.limit_20',
            $event->scopeId,
            $event->season
        );
        Cache::forget($standingsPageKey);

        // 2. Widget Cache (League Table)
        // LeagueTableWidgetService limit=10 kullanıyor
        WidgetCache::forget('league_table', 'league', [
            'league_id' => $event->scopeId,
            'season' => $event->season,
            'limit' => 10,
        ]);
    }
}

<?php

namespace App\Services\Timeline;

use App\Models\HistoryEvent;
use App\Models\HistoricalMatch;
use App\Models\Legend;
use App\Models\SeasonArchive;
use App\Models\Trophy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class TimelineUrlResolver
{
    public function resolve(?Model $source): ?string
    {
        if (! $source) {
            return null;
        }

        return match (true) {
            $source instanceof HistoryEvent => $this->resolveHistoryEvent($source),
            $source instanceof HistoricalMatch => $this->resolveHistoricalMatch($source),
            $source instanceof SeasonArchive => $this->resolveSeasonArchive($source),
            $source instanceof Legend => $this->resolveLegend($source),
            $source instanceof Trophy => $this->resolveTrophy($source),
            default => null,
        };
    }

    protected function resolveHistoryEvent(HistoryEvent $event): ?string
    {
        if (empty($event->slug)) {
            return null;
        }

        $routeName = match ($event->type) {
            'moment' => 'miras.moments.show',
            'era' => 'miras.eras.show',
            'squad' => 'miras.squads.show',
            'achievement' => 'miras.achievements.show',
            'milestone' => 'miras.milestones.show',
            default => null,
        };

        if (! $routeName || ! Route::has($routeName)) {
            return null;
        }

        return route($routeName, ['slug' => $event->slug]);
    }

    protected function resolveHistoricalMatch(HistoricalMatch $match): ?string
    {
        if (empty($match->slug)) {
            return null;
        }

        $routeName = 'miras.matches.show';

        if (! Route::has($routeName)) {
            return null;
        }

        return route($routeName, ['slug' => $match->slug]);
    }

    protected function resolveSeasonArchive(SeasonArchive $seasonArchive): ?string
    {
        if (empty($seasonArchive->slug)) {
            return null;
        }

        $routeName = 'miras.seasons.show';

        if (! Route::has($routeName)) {
            return null;
        }

        return route($routeName, ['slug' => $seasonArchive->slug]);
    }

    protected function resolveLegend(Legend $legend): ?string
    {
        if (empty($legend->slug)) {
            return null;
        }

        $routeName = 'miras.legends.show';

        if (! Route::has($routeName)) {
            return null;
        }

        return route($routeName, ['slug' => $legend->slug]);
    }

    protected function resolveTrophy(Trophy $trophy): ?string
    {
        if (empty($trophy->slug)) {
            return null;
        }

        $routeName = 'miras.trophies.show';

        if (! Route::has($routeName)) {
            return null;
        }

        return route($routeName, ['slug' => $trophy->slug]);
    }
}
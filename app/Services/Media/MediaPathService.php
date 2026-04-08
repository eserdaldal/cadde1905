<?php

namespace App\Services\Media;

use App\Models\HistoryEvent;
use App\Models\HistoricalMatch;
use App\Models\Legend;
use App\Models\News;
use App\Models\SeasonArchive;
use App\Models\Trophy;
use InvalidArgumentException;

class MediaPathService
{
    public function buildForModel(string $modelClass, string $uuid, string $extension, ?\DateTimeInterface $date = null): string
    {
        $date ??= now();

        $folder = $this->resolveFolder($modelClass);

        $year = $date->format('Y');
        $month = $date->format('m');

        $extension = ltrim(mb_strtolower($extension), '.');

        return "media/{$folder}/{$year}/{$month}/{$uuid}.{$extension}";
    }

    public function resolveFolder(string $modelClass): string
    {
        return match ($modelClass) {
            News::class => 'news',
            HistoryEvent::class => 'history-events',
            HistoricalMatch::class => 'historical-matches',
            SeasonArchive::class => 'season-archives',
            Legend::class => 'legends',
            Trophy::class => 'trophies',
            default => throw new InvalidArgumentException("Unsupported media owner model: {$modelClass}"),
        };
    }
}
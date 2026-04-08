<?php

namespace App\Services\Timeline;

use App\Models\HistoryEvent;
use App\Models\HistoricalMatch;
use App\Models\Legend;
use App\Models\SeasonArchive;
use App\Models\Trophy;

class TimelineRuleSet
{
    public static function strictSourceTypes(): array
    {
        return [
            Trophy::class,
            Legend::class,
            HistoricalMatch::class,
            SeasonArchive::class,
        ];
    }

    public static function flexibleSourceTypes(): array
    {
        return [
            HistoryEvent::class,
        ];
    }

    public static function isStrict(string $sourceType): bool
    {
        return in_array($sourceType, self::strictSourceTypes(), true);
    }

    public static function isFlexible(string $sourceType): bool
    {
        return in_array($sourceType, self::flexibleSourceTypes(), true);
    }

    public static function isReferenced(?string $sourceType, ?int $sourceId): bool
    {
        return !empty($sourceType) && !empty($sourceId);
    }

    public static function isStandalone(?string $sourceType, ?int $sourceId): bool
    {
        return empty($sourceType) && empty($sourceId);
    }

    public static function hasValidSourcePair(?string $sourceType, ?int $sourceId): bool
    {
        // ya ikisi dolu ya ikisi boş
        return self::isReferenced($sourceType, $sourceId)
            || self::isStandalone($sourceType, $sourceId);
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * SiteModeService — Ghost / Live mod okuma servisi
 *
 * Ghost mode → tüm içerikler görünür (is_demo dahil)
 * Live mode  → sadece is_demo = 0 içerikler görünür
 */
class SiteModeService
{
    public const MODE_GHOST = 'ghost';
    public const MODE_LIVE  = 'live';

    /**
     * Aktif site modunu döndürür. DB'de yoksa default: ghost
     */
    public static function getMode(): string
    {
        try {
            $value = DB::table('settings')
                ->where('key', 'site_mode')
                ->value('value');

            return in_array($value, [self::MODE_GHOST, self::MODE_LIVE], true)
                ? $value
                : self::MODE_GHOST;
        } catch (\Throwable) {
            return self::MODE_GHOST;
        }
    }

    /**
     * Ghost mode mu?
     */
    public static function isGhost(): bool
    {
        return self::getMode() === self::MODE_GHOST;
    }

    /**
     * Live mode mu?
     */
    public static function isLive(): bool
    {
        return self::getMode() === self::MODE_LIVE;
    }
}

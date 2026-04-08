<?php

declare(strict_types=1);

namespace App\Support\Widgets;

use Illuminate\Support\Facades\Cache;

final class WidgetCache
{
    /**
     * Cache key standardı (SSOT):
     * widgets:{widget_slug}:{scope}:{props_hash}
     *
     * Örnek:
     * - widgets:categories:global:0
     * - widgets:on_this_day:global:0
     */
    public static function key(string $widgetSlug, string $scope = 'global', array $props = []): string
    {
        $slug = self::normalizeSlug($widgetSlug);
        $scope = $scope !== '' ? $scope : 'global';

        $hash = self::propsHash($props);

        return "widgets:{$slug}:{$scope}:{$hash}";
    }

    /**
     * Widget cache standardı: tek giriş noktası.
     *
     * @template T
     * @param callable():T $callback
     * @return T
     */
    public static function remember(
        string $widgetSlug,
        int $ttlSeconds,
        callable $callback,
        string $scope = 'global',
        array $props = []
    ) {
        $ttlSeconds = max(1, $ttlSeconds); // 0 olmasın
        $key = self::key($widgetSlug, $scope, $props);

        return Cache::remember($key, $ttlSeconds, $callback);
    }

    /**
     * Bu helper ile flush etmek istersek (ileride admin action/cron için).
     */
    public static function forget(string $widgetSlug, string $scope = 'global', array $props = []): bool
    {
        return Cache::forget(self::key($widgetSlug, $scope, $props));
    }

    /**
     * Props hash: stable + kısa.
     * props boş ise '0'
     */
    private static function propsHash(array $props): string
    {
        if ($props === []) {
            return '0';
        }

        // Stabil sıralama için anahtarları sort et
        $normalized = self::ksortRecursive($props);

        $json = json_encode($normalized, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            // Çok nadir: json encode başarısız olursa
            return '0';
        }

        return substr(sha1($json), 0, 12);
    }

    private static function normalizeSlug(string $slug): string
    {
        $slug = trim($slug);
        $slug = strtolower($slug);
        $slug = preg_replace('/[^a-z0-9_]+/', '_', $slug) ?? $slug;
        $slug = trim($slug, '_');

        return $slug !== '' ? $slug : 'widget';
    }

    private static function ksortRecursive(array $array): array
    {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $array[$k] = self::ksortRecursive($v);
            }
        }

        ksort($array);

        return $array;
    }
}
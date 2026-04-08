<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Models\Category;
use App\Support\Widgets\WidgetCache;

final class CategoriesWidgetService
{
    /**
     * DB-first widget.
     * Faz 1 TTL standardı: 1–6 saat bandı (biz burada 6 saat seçiyoruz).
     *
     * @return array{
     *   items: array<int, array{name:string, slug:string}>,
     *   meta: array{source:string, cache_key:string, ttl:int}
     * }
     */
    public function getData(array $props = []): array
    {
        $ttl = 6 * 60 * 60; // 6 saat

        $cacheKey = WidgetCache::key('categories', 'global', $props);

        $items = WidgetCache::remember(
            widgetSlug: 'categories',
            ttlSeconds: $ttl,
            callback: function (): array {
                $rows = Category::query()
                    ->select(['name', 'slug'])
                    ->orderBy('name')
                    ->get();

                return $rows->map(static fn ($c) => [
                    'name' => (string) $c->name,
                    'slug' => (string) $c->slug,
                ])->all();
            },
            scope: 'global',
            props: $props
        );

        return [
            'items' => $items,
            'meta' => [
                'source' => 'db',
                'cache_key' => $cacheKey,
                'ttl' => $ttl,
            ],
        ];
    }
}
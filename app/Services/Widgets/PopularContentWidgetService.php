<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Models\News;
use App\Support\Widgets\WidgetCache;
use Carbon\CarbonImmutable;
use Throwable;

final class PopularContentWidgetService
{
    /**
     * @return array{
     *     title:string,
     *     status:string,
     *     props:array<string,mixed>,
     *     data:array<string,mixed>,
     *     meta:array<string,mixed>
     * }
     */
    public function build(): array
    {
        $limit = 3;
        $ttlSeconds = 900;

        try {
            $items = WidgetCache::remember(
                widgetSlug: 'popular_content',
                ttlSeconds: $ttlSeconds,
                callback: function () use ($limit): array {
                    return News::query()
                        ->select(['id', 'title', 'slug', 'published_at', 'hero_eligible'])
                        ->where('status', 'published')
                        ->whereNotNull('published_at')
                        ->where('published_at', '<=', CarbonImmutable::now())
                        ->whereNull('deleted_at')
                        ->orderByDesc('hero_eligible')
                        ->orderByDesc('published_at')
                        ->limit($limit)
                        ->get()
                        ->map(static function (News $news): array {
                            $imagePath = null;

                            if (method_exists($news, 'coverImageUrl')) {
                                $resolved = $news->coverImageUrl();
                                if (! empty($resolved)) {
                                    $imagePath = $resolved;
                                }
                            }

                            if ($imagePath === null && method_exists($news, 'coverMedia')) {
                                $media = $news->coverMedia()
                                    ->orderByDesc('mediaables.is_primary')
                                    ->orderBy('mediaables.sort_order')
                                    ->orderByDesc('mediaables.id')
                                    ->first();

                                if ($media && ! empty($media->url)) {
                                    $imagePath = $media->url;
                                } elseif ($media && ! empty($media->path)) {
                                    $imagePath = $media->path;
                                }
                            }

                            return [
                                'id' => (int) $news->id,
                                'title' => (string) $news->title,
                                'slug' => (string) $news->slug,
                                'image_path' => $imagePath,
                                'published_at' => $news->published_at?->toDateTimeString(),
                            ];
                        })
                        ->all();
                },
                scope: 'global',
                props: ['limit' => $limit]
            );

            return [
                'title' => 'Popüler İçerikler',
                'status' => 'ok',
                'props' => [],
                'data' => [
                    'items' => $items,
                ],
                'meta' => [
                    'source' => 'db_news',
                    'cache_ttl' => $ttlSeconds,
                    'limit' => $limit,
                    'sorting' => 'hero_eligible_desc,published_at_desc',
                ],
            ];
        } catch (Throwable $e) {
            report($e);

            return [
                'title' => 'Popüler İçerikler',
                'status' => 'error',
                'props' => [],
                'data' => [
                    'items' => [],
                ],
                'meta' => [
                    'source' => 'db_news',
                    'cache_ttl' => $ttlSeconds,
                    'limit' => $limit,
                    'sorting' => 'hero_eligible_desc,published_at_desc',
                ],
            ];
        }
    }
}

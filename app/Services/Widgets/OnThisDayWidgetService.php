<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Models\HistoryEvent;
use App\Services\Timeline\TimelineUrlResolver;
use App\Support\Widgets\WidgetCache;
use Carbon\CarbonImmutable;

final class OnThisDayWidgetService
{
    public function __construct(
        private readonly TimelineUrlResolver $timelineUrlResolver,
    ) {
    }

    /**
     * @return array{
     *   title:string,
     *   item:?array{title:string,slug:string,url:string,year:?int,excerpt:?string},
     *   items: array<int, array{title:string,slug:string,url:string,year:?int,excerpt:?string}>,
     *   meta: array{source:string, date:string, cache_key:string, ttl:int, strategy:string}
     * }
     */
    public function getData(array $props = []): array
    {
        $ttl = 60 * 60; // 1 saat
        $today = CarbonImmutable::today();

        // Bugün değişkeni cache key'e girsin diye props'a date ekliyoruz (render-only safe).
        $propsWithDate = array_merge($props, [
            'date' => $today->format('Y-m-d'),
            'schema' => 'v2',
        ]);

        $cacheKey = WidgetCache::key('on_this_day', 'global', $propsWithDate);

        $resolved = WidgetCache::remember(
            widgetSlug: 'on_this_day',
            ttlSeconds: $ttl,
            callback: fn (): array => $this->resolveForDate($today),
            scope: 'global',
            props: $propsWithDate
        );

        $item = $resolved['item'] ?? null;
        $title = $resolved['title'] ?? 'Tarihten Bir An';
        $strategy = $resolved['strategy'] ?? 'none';

        return [
            'title' => $title,
            'item' => $item,
            'items' => $item ? [$item] : [],
            'meta' => [
                'source' => 'db_history_events',
                'date' => $today->format('Y-m-d'),
                'cache_key' => $cacheKey,
                'ttl' => $ttl,
                'strategy' => $strategy,
            ],
        ];
    }

    /**
     * @return array{
     *   title:string,
     *   strategy:string,
     *   item:?array{title:string,slug:string,url:string,year:?int,excerpt:?string}
     * }
     */
    private function resolveForDate(CarbonImmutable $today): array
    {
        $exactMatch = HistoryEvent::query()
            ->where('is_published', true)
            ->where('is_on_this_day', true)
            ->where('on_this_day_month', (int) $today->month)
            ->where('on_this_day_day', (int) $today->day)
            ->orderByDesc('importance_score')
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->first();

        if ($exactMatch) {
            $mapped = $this->mapEvent($exactMatch);
            if ($mapped !== null) {
                return [
                    'title' => 'Tarihte Bugün',
                    'strategy' => 'exact_today',
                    'item' => $mapped,
                ];
            }
        }

        $pool = HistoryEvent::query()
            ->select([
                'id',
                'type',
                'title',
                'slug',
                'excerpt',
                'year',
                'month',
                'day',
                'event_date',
                'on_this_day_month',
                'on_this_day_day',
                'importance_score',
                'is_published',
            ])
            ->where('is_published', true)
            ->orderByDesc('importance_score')
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->get();

        $nearestPast = null;
        $nearestFuture = null;

        /** @var HistoryEvent $event */
        foreach ($pool as $event) {
            [$month, $day] = $this->resolveMonthDay($event);

            if ($month === null || $day === null) {
                continue;
            }

            try {
                $anniversaryDate = CarbonImmutable::create(
                    year: (int) $today->year,
                    month: $month,
                    day: $day,
                    hour: 0,
                    minute: 0,
                    second: 0,
                    timezone: $today->timezone
                );
            } catch (\Throwable) {
                continue;
            }

            $mapped = $this->mapEvent($event);
            if ($mapped === null) {
                continue;
            }

            if ($anniversaryDate->lt($today)) {
                if ($nearestPast === null || $anniversaryDate->gt($nearestPast['date'])) {
                    $nearestPast = [
                        'date' => $anniversaryDate,
                        'item' => $mapped,
                    ];
                }
                continue;
            }

            if ($anniversaryDate->gt($today)) {
                if ($nearestFuture === null || $anniversaryDate->lt($nearestFuture['date'])) {
                    $nearestFuture = [
                        'date' => $anniversaryDate,
                        'item' => $mapped,
                    ];
                }
            }
        }

        if ($nearestPast !== null) {
            return [
                'title' => 'Tarihten Bir An',
                'strategy' => 'fallback_past',
                'item' => $nearestPast['item'],
            ];
        }

        if ($nearestFuture !== null) {
            return [
                'title' => 'Tarihten Bir An',
                'strategy' => 'fallback_future',
                'item' => $nearestFuture['item'],
            ];
        }

        return [
            'title' => 'Tarihten Bir An',
            'strategy' => 'none',
            'item' => null,
        ];
    }

    /**
     * @return array{0:?int,1:?int}
     */
    private function resolveMonthDay(HistoryEvent $event): array
    {
        $month = $event->on_this_day_month ?: null;
        $day = $event->on_this_day_day ?: null;

        if (($month === null || $day === null) && $event->event_date !== null) {
            $month = (int) $event->event_date->month;
            $day = (int) $event->event_date->day;
        }

        if ($month === null || $day === null) {
            $month = $month ?? ($event->month ?: null);
            $day = $day ?? ($event->day ?: null);
        }

        if (!is_int($month) || !is_int($day) || $month < 1 || $month > 12 || $day < 1 || $day > 31) {
            return [null, null];
        }

        return [$month, $day];
    }

    /**
     * @return ?array{title:string,slug:string,url:string,year:?int,excerpt:?string}
     */
    private function mapEvent(HistoryEvent $event): ?array
    {
        if (empty($event->slug) || empty($event->title)) {
            return null;
        }

        $url = $this->timelineUrlResolver->resolve($event);
        if (!is_string($url) || $url === '') {
            return null;
        }

        $year = null;
        if (is_numeric($event->year)) {
            $year = (int) $event->year;
        } elseif ($event->event_date !== null) {
            $year = (int) $event->event_date->year;
        }

        $excerpt = null;
        if (is_string($event->excerpt) && trim($event->excerpt) !== '') {
            $excerpt = trim($event->excerpt);
        }

        return [
            'title' => (string) $event->title,
            'slug' => (string) $event->slug,
            'url' => $url,
            'year' => $year,
            'excerpt' => $excerpt,
        ];
    }
}

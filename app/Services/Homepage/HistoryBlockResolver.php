<?php

namespace App\Services\Homepage;

use App\Models\HistoryEvent;
use App\Support\ContentKey;
use App\Services\Homepage\ExclusionBag;

final class HistoryBlockResolver
{
    /**
     * @return NormalizedContentItem[]
     */
    public function resolve(ExclusionBag $bag, int $limit = 4): array
    {
        $baseQuery = HistoryEvent::query()
            ->where('is_published', true)
            ->orderByDesc('importance_score')
            ->orderByDesc('published_at');

        // Tier 1: With Primary Cover
        $tier1 = (clone $baseQuery)
            ->has('primaryCover')
            ->get();

        // Tier 2: Without Primary Cover
        $tier2 = (clone $baseQuery)
            ->doesntHave('primaryCover')
            ->get();

        $items = [];

        // 1. Process Tier 1
        foreach ($tier1 as $event) {
            /** @var HistoryEvent $event */
            if (count($items) >= $limit) break;

            $contentKey = ContentKey::make('history_event', (int) $event->id);
            if ($bag->has($contentKey)) continue;

            $items[] = $this->normalize($event, $contentKey);
        }

        // 2. Process Tier 2 (Fallback)
        foreach ($tier2 as $event) {
            /** @var HistoryEvent $event */
            if (count($items) >= $limit) break;

            $contentKey = ContentKey::make('history_event', (int) $event->id);
            if ($bag->has($contentKey)) continue;

            $items[] = $this->normalize($event, $contentKey);
        }

        return $items;
    }

    private function normalize(HistoryEvent $event, string $contentKey): NormalizedContentItem
    {
        return new NormalizedContentItem(
            contentKey: $contentKey,
            contentType: 'history_event',
            contentId: (int) $event->id,
            title: (string) $event->title,
            url: $this->generateUrl($event),
            imageUrl: $event->primaryCover()->first()?->path,
            publishedAt: $event->published_at ?? $event->event_date,
            excerpt: (string) $event->excerpt,
            badge: 'Tarih',
            sourceLabel: 'Geçmişten Hikâyeler',
            isHeroEligible: (bool) $event->is_featured,
        );
    }

    private function generateUrl(HistoryEvent $event): string
    {
        $routeName = match ($event->type) {
            'moment' => 'miras.moments.show',
            'era' => 'miras.eras.show',
            'squad' => 'miras.squads.show',
            'achievement' => 'miras.achievements.show',
            'milestone' => 'miras.milestones.show',
            default => null,
        };

        if ($routeName) {
            return route($routeName, ['slug' => $event->slug]);
        }

        return url('/miras/anlar/' . $event->slug);
    }
}

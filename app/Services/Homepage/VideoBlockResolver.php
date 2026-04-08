<?php

namespace App\Services\Homepage;

use App\Models\News;
use App\Services\Homepage\Normalizers\NewsHomepageNormalizer;
use App\Support\ContentKey;
use Carbon\CarbonImmutable;

final class VideoBlockResolver
{
    public function __construct(
        private readonly NewsHomepageNormalizer $newsNormalizer,
    ) {
    }

    /**
     * @return array<int, NormalizedContentItem>
     */
    public function resolve(ExclusionBag $bag, int $limit = 3): array
    {
        $records = News::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', CarbonImmutable::now())
            ->whereNull('deleted_at')
            ->whereNotNull('source_url')
            ->where('source_url', '!=', '')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        $items = [];

        foreach ($records as $record) {
            $contentKey = ContentKey::make('news', (int) $record->id);

            if ($bag->has($contentKey)) {
                continue;
            }

            $normalized = $this->newsNormalizer->normalize($record);

            $items[] = new NormalizedContentItem(
                contentKey: $normalized->contentKey,
                contentType: $normalized->contentType,
                contentId: $normalized->contentId,
                title: $normalized->title,
                url: $normalized->url,
                imageUrl: $normalized->imageUrl,
                publishedAt: $normalized->publishedAt,
                excerpt: $normalized->excerpt,
                badge: 'Video',
                sourceLabel: 'News',
                isHeroEligible: $normalized->isHeroEligible,
            );

            if (count($items) >= $limit) {
                break;
            }
        }

        return $items;
    }
}

<?php

namespace App\Services\Homepage\Resolvers;

use App\Models\News;
use App\Services\Homepage\ExclusionBag;
use App\Services\Homepage\NormalizedContentItem;
use App\Services\Homepage\Normalizers\NewsHomepageNormalizer;
use App\Services\SiteModeService;
use App\Support\ContentKey;
use Carbon\CarbonImmutable;

final class LatestNewsBlockResolver
{
    public function __construct(
        private readonly NewsHomepageNormalizer $newsNormalizer,
    ) {
    }

    /**
     * @return array<int, NormalizedContentItem>
     */
    public function resolve(ExclusionBag $bag, int $limit = 6): array
    {
        $query = News::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', CarbonImmutable::now())
            ->whereNull('deleted_at')
            ->orderByDesc('published_at')
            ->orderByDesc('id');

        if (SiteModeService::isLive()) {
            $query->where('is_demo', false);
        }

        $records = $query->get();

        $items = [];

        foreach ($records as $record) {
            $contentKey = ContentKey::make('news', (int) $record->id);

            if ($bag->has($contentKey)) {
                continue;
            }

            $item = $this->newsNormalizer->normalize($record);
            $items[] = $item;

            if (count($items) >= $limit) {
                break;
            }
        }

        return $items;
    }
}

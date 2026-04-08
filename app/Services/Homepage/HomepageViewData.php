<?php

namespace App\Services\Homepage;

final class HomepageViewData
{
    public function __construct(
        public readonly ?NormalizedContentItem $hero,
        public readonly array $latestNews,
        public readonly array $exclusionKeys,
        public readonly array $archive = [],
        public readonly array $video = [],
        public readonly array $gallery = [],
        public readonly array $history = [],
    ) {
    }

    public function toArray(): array
    {
        return [
            'hero' => $this->hero?->toArray(),
            'latest_news' => array_map(
                static fn (NormalizedContentItem $item): array => $item->toArray(),
                $this->latestNews
            ),
            'exclusion_keys' => $this->exclusionKeys,
            'archive' => array_map(
                static fn (NormalizedContentItem $item): array => $item->toArray(),
                $this->archive
            ),
            'video' => array_map(
                static fn (NormalizedContentItem $item): array => $item->toArray(),
                $this->video
            ),
            'gallery' => array_map(
                static fn (NormalizedContentItem $item): array => $item->toArray(),
                $this->gallery
            ),
            'history' => array_map(
                static fn (NormalizedContentItem $item): array => $item->toArray(),
                $this->history
            ),
        ];
    }
}

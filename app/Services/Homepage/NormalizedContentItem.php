<?php

namespace App\Services\Homepage;

use Carbon\CarbonInterface;

final class NormalizedContentItem
{
    public function __construct(
        public readonly string $contentKey,
        public readonly string $contentType,
        public readonly int|string $contentId,
        public readonly string $title,
        public readonly string $url,
        public readonly ?string $imageUrl = null,
        public readonly ?CarbonInterface $publishedAt = null,
        public readonly ?string $excerpt = null,
        public readonly ?string $badge = null,
        public readonly ?string $sourceLabel = null,
        public readonly ?bool $isHeroEligible = null,
    ) {
    }

    /**
     * @return array{
     *   content_key: string,
     *   content_type: string,
     *   content_id: int|string,
     *   title: string,
     *   url: string,
     *   image_url: ?string,
     *   published_at: ?string,
     *   excerpt: ?string,
     *   badge: ?string,
     *   source_label: ?string,
     *   is_hero_eligible: ?bool
     * }
     */
    public function toArray(): array
    {
        return [
            'content_key' => $this->contentKey,
            'content_type' => $this->contentType,
            'content_id' => $this->contentId,
            'title' => $this->title,
            'url' => $this->url,
            'image_url' => $this->imageUrl,
            'published_at' => $this->publishedAt?->toDateTimeString(),
            'excerpt' => $this->excerpt,
            'badge' => $this->badge,
            'source_label' => $this->sourceLabel,
            'is_hero_eligible' => $this->isHeroEligible,
        ];
    }
}

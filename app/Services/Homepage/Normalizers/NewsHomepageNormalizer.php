<?php

namespace App\Services\Homepage\Normalizers;

use App\Models\News;
use App\Services\Homepage\NormalizedContentItem;
use App\Support\ContentKey;
use Illuminate\Support\Str;
use InvalidArgumentException;

final class NewsHomepageNormalizer implements HomepageContentNormalizer
{
    public function supports(mixed $record): bool
    {
        return $record instanceof News;
    }

    public function normalize(mixed $record): NormalizedContentItem
    {
        if (! $record instanceof News) {
            throw new InvalidArgumentException('NewsHomepageNormalizer only supports App\Models\News records.');
        }

        $title = trim((string) $record->title);
        $slug = trim((string) $record->slug);

        if ($title === '') {
            throw new InvalidArgumentException(sprintf('News record #%s has empty title.', $record->id));
        }

        if ($slug === '') {
            throw new InvalidArgumentException(sprintf('News record #%s has empty slug.', $record->id));
        }

        $summary = $record->summary !== null
            ? trim((string) $record->summary)
            : null;

        if ($summary === '') {
            $summary = null;
        }

        if ($summary === null) {
            $content = trim(strip_tags((string) $record->content));
            $summary = $content !== '' ? Str::limit($content, 220) : null;
        }

        $imageUrl = null;

        if (method_exists($record, 'coverImageUrl')) {
            $resolved = $record->coverImageUrl();
            if (! empty($resolved)) {
                $imageUrl = $resolved;
            }
        }

        if ($imageUrl === null && method_exists($record, 'coverMedia')) {
            $media = $record->coverMedia()
                ->orderByDesc('mediaables.is_primary')
                ->orderBy('mediaables.sort_order')
                ->orderByDesc('mediaables.id')
                ->first();

            if ($media && ! empty($media->url)) {
                $imageUrl = $media->url;
            } elseif ($media && ! empty($media->path)) {
                $imageUrl = $media->path;
            }
        }

        return new NormalizedContentItem(
            contentKey: ContentKey::make('news', (int) $record->id),
            contentType: 'news',
            contentId: (int) $record->id,
            title: $title,
            url: route('news.show', ['slug' => $slug]),
            imageUrl: $imageUrl,
            publishedAt: $record->published_at,
            excerpt: $summary,
            badge: 'Haber',
            sourceLabel: 'News',
            isHeroEligible: (bool) $record->hero_eligible,
        );
    }
}

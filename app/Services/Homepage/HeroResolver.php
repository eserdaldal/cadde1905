<?php

namespace App\Services\Homepage;

use App\Models\News;
use App\Services\Homepage\Normalizers\NewsHomepageNormalizer;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use RuntimeException;

final class HeroResolver
{
    public function __construct(
        private readonly NewsHomepageNormalizer $newsNormalizer,
    ) {
    }

    public function resolve(): ?NormalizedContentItem
    {
        $override = $this->resolveActiveOverride();

        if ($override !== null) {
            return $override;
        }

        $autoHero = $this->resolveAutoHero();

        if ($autoHero !== null) {
            return $autoHero;
        }

        return $this->resolveFallbackHero();
    }

    private function resolveActiveOverride(): ?NormalizedContentItem
    {
        $now = CarbonImmutable::now();

        $activeOverrides = DB::table('homepage_hero_overrides')
            ->where('is_active', true)
            ->where(function ($query) use ($now): void {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', $now);
            })
            ->where('ends_at', '>', $now)
            ->orderByDesc('id')
            ->get();

        if ($activeOverrides->count() > 1) {
            throw new RuntimeException('Multiple active homepage hero overrides detected.');
        }

        $override = $activeOverrides->first();

        if ($override === null) {
            return null;
        }

        if ($override->item_type !== 'news') {
            return null;
        }

        $news = News::query()
            ->whereKey((int) $override->item_id)
            ->whereNull('deleted_at')
            ->first();

        if ($news === null) {
            return null;
        }

        return $this->newsNormalizer->normalize($news);
    }

    private function resolveAutoHero(): ?NormalizedContentItem
    {
        $query = News::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', CarbonImmutable::now())
            ->where('hero_eligible', true)
            ->whereNull('deleted_at');

        $news = $query->orderByDesc('published_at')->orderByDesc('id')->first();

        if ($news === null) {
            return null;
        }

        return $this->newsNormalizer->normalize($news);
    }

    private function resolveFallbackHero(): ?NormalizedContentItem
    {
        $query = News::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', CarbonImmutable::now())
            ->whereNull('deleted_at');

        $news = $query->orderByDesc('published_at')->orderByDesc('id')->first();

        if ($news === null) {
            return null;
        }

        return $this->newsNormalizer->normalize($news);
    }
}

@extends('layouts.app')

@section('content')

@php
    $newsPlaceholder = asset('images/placeholders/news-placeholder.webp');

    $imageUrl = function ($item) use ($newsPlaceholder) {
        if (! $item) {
            return $newsPlaceholder;
        }

        // CANONICAL-FIRST
        if (method_exists($item, 'coverImageUrl')) {
            $url = $item->coverImageUrl();
            if (! empty($url)) {
                return $url;
            }
        }

        if (method_exists($item, 'coverMedia')) {
            $media = $item->coverMedia()
                ->orderByDesc('mediaables.is_primary')
                ->orderBy('mediaables.sort_order')
                ->orderByDesc('mediaables.id')
                ->first();

            if ($media && ! empty($media->url)) {
                return $media->url;
            }

            if ($media && $media->path) {
                return asset('storage/' . ltrim($media->path, '/'));
            }
        }

        return $newsPlaceholder;
    };

    $getCategoryColor = function ($categoryName) {
        $name = strtolower($categoryName ?? '');
        return match(true) {
            str_contains($name, 'futbol') => ['bg' => '#FCB816', 'text' => '#1a1a1a'],
            str_contains($name, 'basketbol') => ['bg' => '#ff8c00', 'text' => '#ffffff'],
            str_contains($name, 'voleybol') => ['bg' => '#2563eb', 'text' => '#ffffff'],
            str_contains($name, 'genel') || str_contains($name, 'güncel') => ['bg' => '#52525b', 'text' => '#ffffff'],
            default => ['bg' => '#A91D35', 'text' => '#ffffff']
        };
    };
@endphp

<style>
    /* V4 CRITICAL STABILITY & REFINEMENT */
    .hero-img img, .nc-img img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
    }
    .hero-news {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        overflow: hidden !important;
        min-height: 310px !important;
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,0.08) !important;
    }
    .news-grid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 12px !important;
    }
    .news-card {
        padding: 0 !important; /* Resetting padding for standard grid cards */
        border: 1px solid var(--border) !important;
        background: var(--card) !important;
    }
    .nc-body {
        padding: 10px 12px 12px !important; /* Compact padding */
    }
    .nc-title {
        font-size: 13.5px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 6px !important;
    }
    .nc-meta {
        opacity: 0.6 !important;
        font-size: 10.5px !important;
    }
    .cat-badge-v4 {
        position: absolute !important;
        top: 8px !important;
        left: 8px !important;
        font-size: 10.5px !important;
        font-weight: 600 !important;
        padding: 2px 7px !important;
        border-radius: 4px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        z-index: 10 !important;
    }
    @media (max-width: 1024px) {
        .news-grid { grid-template-columns: repeat(2, 1fr) !important; }
    }
    @media (max-width: 640px) {
        .news-grid { grid-template-columns: 1fr !important; }
        .hero-news { grid-template-columns: 1fr !important; }
    }
</style>

            @if($featured)
                <section class="mb-10 lg:mb-12">
                    <div class="hero-news ui-hero" onclick="window.location.href='{{ route('news.show', $featured->slug) }}'">
                        <div class="hero-img">
                            <img
                                src="{{ $imageUrl($featured) }}"
                                alt="{{ $featured->title }}"
                                loading="eager"
                                onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                            >
                            <div class="hero-img-overlay"></div>
                            @php $c = $getCategoryColor($featured->category->name ?? 'GÜNCEL'); @endphp
                            {{-- INLINE_OK: dynamic category colors --}}
                            <span class="cat-badge-v4" style="top: 10px; left: 10px; background: {{ $c['bg'] }} !important; color: {{ $c['text'] }} !important;">
                                {{ $featured->category->name ?? 'GÜNCEL' }}
                            </span>
                        </div>

                        <div class="hero-content">
                            <div class="news-meta ui-hero-meta">
                                <span class="cat">{{ $featured->category->name ?? 'Genel' }}</span>
                                <span class="date">{{ $featured->published_at->translatedFormat('d F Y') }}</span>
                            </div>

                            <h2 class="hero-title ui-hero-title">{{ $featured->title }}</h2>

                            @if($featured->list_excerpt)
                                <p class="hero-excerpt">{{ $featured->list_excerpt }}</p>
                            @endif

                            <div class="read-more">
                                Devamını Oku
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @if($items->count())
                <div class="sec-hd">
                    <h2 class="sec-title ui-section-title">SON HABERLER</h2>
                </div>

                <div class="news-grid">
                    @foreach($items as $item)
                        <article>
                            <a href="{{ route('news.show', $item->slug) }}" class="news-card ui-card block group transition-all duration-300 hover:-translate-y-1">
                                <div class="nc-img rounded-t-lg">
                                    <img
                                        src="{{ $imageUrl($item) }}"
                                        alt="{{ $item->title }}"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                                    >
                                    @php $c = $getCategoryColor($item->category->name ?? 'FUTBOL'); @endphp
                                    {{-- INLINE_OK: dynamic category colors --}}
                                    <span class="cat-badge-v4" style="background: {{ $c['bg'] }} !important; color: {{ $c['text'] }} !important;">
                                        {{ $item->category->name ?? 'FUTBOL' }}
                                    </span>
                                </div>

                                <div class="nc-body">
                                    <h3 class="nc-title ui-card-title group-hover:text-yellow-500 transition-colors">{{ $item->title }}</h3>

                                    <div class="nc-meta ui-card-meta flex justify-between items-center">
                                        <span>{{ $item->published_at->translatedFormat('d M Y') }}</span>
                                        <span class="font-bold text-red-500">DETAY →</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif

            @if($items->hasPages())
                <div class="mt-12">
                    {{ $items->links('partials.pagination') }}
                </div>
            @endif



@endsection

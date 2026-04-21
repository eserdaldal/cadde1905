@extends('layouts.app')

@section('content')

@php
    $newsPlaceholder = asset('images/placeholders/news-placeholder.webp');

    $catBadge = function($category) {
        $name = $category->name ?? 'HABER';
        $slug = strtolower($name);
        
        $color = match(true) {
            str_contains($slug, 'futbol') => '#FCB816',
            str_contains($slug, 'basket') => '#FF8C00',
            str_contains($slug, 'voley') => '#2563EB',
            str_contains($slug, 'genel') || str_contains($slug, 'güncel') => '#52525B',
            default => '#A91D35'
        };

        // For bright colors like yellow, we might want dark text, handled via CSS logic later
        return (object) [
            'label' => mb_strtoupper($name, 'UTF-8'), 
            'color' => $color
        ];
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
        top: 10px !important;
        left: 10px !important;
        display: inline-flex !important;
        align-items: center !important;
        background: rgba(var(--white-rgb), 0.08) !important; /* Extremely soft light tint */
        backdrop-filter: blur(14px) !important;
        -webkit-backdrop-filter: blur(14px) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        color: #fff !important;
        font-size: 11px !important;
        font-weight: 700 !important; /* Slightly lighter weight */
        padding: 3px 10px !important;
        border-radius: 8px !important; /* Friendlier corners */
        text-transform: uppercase !important;
        letter-spacing: 0.08em !important;
        z-index: 10 !important;
        box-shadow: 
            0 4px 15px rgba(0, 0, 0, 0.15),
            inset 0 0 0 1px var(--badge-color) !important; /* Thinner, softer luminous edge */
        transition: all 0.3s ease !important;
    }
    .news-card:hover .cat-badge-v4 {
        transform: translateY(-1px) scale(1.02) !important;
        background: rgba(var(--white-rgb), 0.15) !important;
        box-shadow: 
            0 6px 20px rgba(0, 0, 0, 0.2),
            inset 0 0 0 1.5px var(--badge-color) !important;
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
                                src="{{ $featured->coverImageUrl() }}"
                                alt="{{ $featured->title }}"
                                loading="eager"
                                onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                            >
                            <div class="hero-img-overlay"></div>
                            @php $b = $catBadge($featured->category ?? null); @endphp
                            <span class="cat-badge-v4" style="--badge-color: {{ $b->color }}; top: 10px; left: 10px;">
                                {{ $b->label }}
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
                                        src="{{ $item->coverThumbUrl() }}"
                                        srcset="{{ $item->coverSrcset() }}"
                                        sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
                                        alt="{{ $item->title }}"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                                    >
                                    @php $b = $catBadge($item->category ?? null); @endphp
                                    <span class="cat-badge-v4" style="--badge-color: {{ $b->color }};">
                                        {{ $b->label }}
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

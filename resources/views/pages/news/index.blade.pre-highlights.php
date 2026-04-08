@extends('layouts.app')

@section('content')

@php
    $newsPlaceholder = asset('images/placeholders/news-placeholder.webp');

    $imageUrl = function ($item) use ($newsPlaceholder) {
        if (! $item) {
            return $newsPlaceholder;
        }

        // MEDIA CORE
        if (method_exists($item, 'primaryCover')) {
            $media = $item->primaryCover()->first();

            if ($media && $media->path) {
                return asset('storage/' . ltrim($media->path, '/'));
            }
        }

        // LEGACY
        if (! empty($item->cover_image_path)) {
            if (str_starts_with($item->cover_image_path, 'http')) {
                return $item->cover_image_path;
            }

            return asset('storage/' . ltrim($item->cover_image_path, '/'));
        }

        // PLACEHOLDER
        return $newsPlaceholder;
    };
@endphp

<div class="page">
    <div class="main-grid">
        <div class="detail-grid-item">

            @if($featured)
                <section class="mb-10 lg:mb-12">
                    <div class="hero-news" onclick="window.location.href='{{ route('news.show', $featured->slug) }}'">
                        <div class="hero-img">
                            <img
                                src="{{ $imageUrl($featured) }}"
                                alt="{{ $featured->title }}"
                                loading="eager"
                                onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                            >
                            <div class="hero-img-overlay"></div>
                            <span class="hero-img-label">GÜNCEL</span>
                        </div>

                        <div class="hero-content">
                            <div class="news-meta">
                                <span class="cat">{{ $featured->category->name ?? 'Genel' }}</span>
                                <span class="date">{{ $featured->published_at->translatedFormat('d F Y') }}</span>
                            </div>

                            <h2 class="hero-title">{{ $featured->title }}</h2>

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
                    <h2 class="sec-title">SON HABERLER</h2>
                </div>

                <div class="news-grid">
                    @foreach($items as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="news-card">
                            <div class="nc-img">
                                <img
                                    src="{{ $imageUrl($item) }}"
                                    alt="{{ $item->title }}"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                                >
                                <span class="nc-cat ct-futbol">{{ $item->category->name ?? 'FUTBOL' }}</span>
                            </div>

                            <div class="nc-body">
                                <h3 class="nc-title">{{ $item->title }}</h3>

                                <div class="nc-meta">
                                    <span>{{ $item->published_at->translatedFormat('d M Y') }}</span>
                                    <span>DETAY →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            @if($items->hasPages())
                <div class="mt-12">
                    {{ $items->links() }}
                </div>
            @endif

        </div>

        <x-sidebar />
    </div>
</div>

@endsection
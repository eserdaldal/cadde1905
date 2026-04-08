@extends('layouts.app')

@section('title', $item->title . ' - Haberler')
@section('description', $item->summary ? Str::limit(strip_tags($item->summary), 150) : Str::limit(strip_tags($item->content), 150))

@php
    $newsPlaceholder = asset('images/placeholders/news-placeholder.webp');

    $imageUrl = function ($newsItem) use ($newsPlaceholder) {
        if (!$newsItem) {
            return $newsPlaceholder;
        }

        // MEDIA CORE
        if (method_exists($newsItem, 'primaryCover')) {
            $media = $newsItem->primaryCover()->first();
            if ($media && $media->path) {
                return asset('storage/' . ltrim($media->path, '/'));
            }
        }

        // LEGACY
        if (!empty($newsItem->cover_image_path)) {
            if (str_starts_with($newsItem->cover_image_path, 'http')) {
                return $newsItem->cover_image_path;
            }
            return asset('storage/' . ltrim($newsItem->cover_image_path, '/'));
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

    $mainImage = $imageUrl($item);
    $categoryName = $item->category->name ?? 'Genel';
@endphp

<style>
    /* CRITICAL LAYOUT FORCING (BYPASS VITE/BUILD ISSUES) */
    .detail-hero-img-wrapper img {
        width: 100% !important;
        height: auto !important;
        display: block !important;
        border-radius: 16px !important;
    }
    .grid img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        aspect-ratio: 16/9 !important;
        border-radius: 8px !important;
    }
    .cat-badge-v4 {
        display: inline-block !important;
        font-size: 10.5px !important;
        font-weight: 600 !important;
        padding: 2px 7px !important;
        border-radius: 4px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin-bottom: 12px !important;
    }
</style>

@section('content')

<div class="page">
    <div class="main-grid">
        <div class="detail-grid-item">

            <nav class="news-breadcrumb">
                <a href="{{ route('home') }}">Anasayfa</a>
                <span>/</span>
                <a href="{{ route('news.index') }}">Haberler</a>
                <span>/</span>
                <span>{{ $categoryName }}</span>
            </nav>

            <header class="flex flex-col gap-6">
                @php $c = $getCategoryColor($categoryName); @endphp
                <div class="cat-badge-v4" style="background: {{ $c['bg'] }} !important; color: {{ $c['text'] }} !important;">{{ $categoryName }}</div>
                <h1 class="text-3xl font-black leading-tight tracking-tight text-zinc-200 md:text-4xl lg:text-5xl">
                    {{ $item->title }}
                </h1>

                <div class="detail-hero-img-wrapper">
                    <img
                        src="{{ $mainImage }}"
                        alt="{{ $item->title }}"
                        loading="eager"
                        onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                    />
                </div>
            </header>

            <article class="news-content">
                {!! $item->content !!}
            </article>

            @if(isset($relatedNews) && $relatedNews->count())
                <section class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="col-span-full">
                        <h3 class="text-lg font-black tracking-tight text-white border-l-4 border-red-600 pl-3">
                            İlginizi Çekebilir
                        </h3>
                    </div>

                    @foreach($relatedNews as $related)
                        <a href="{{ route('news.show', $related->slug) }}" class="group">
                            <div class="relative overflow-hidden rounded-lg mb-3">
                                <img
                                    src="{{ $imageUrl($related) }}"
                                    alt="{{ $related->title }}"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                                />
                                @php $c = $getCategoryColor($related->category->name ?? ''); @endphp
                                <div class="absolute top-2 left-2 px-2 py-0.5 text-[9.5px] font-bold rounded" style="background: {{ $c['bg'] }} !important; color: {{ $c['text'] }} !important;">
                                    {{ $related->category->name ?? 'FUTBOL' }}
                                </div>
                            </div>
                            <h4 class="text-sm font-bold text-zinc-300 group-hover:text-white transition-colors line-clamp-2 leading-tight">{{ $related->title }}</h4>
                        </a>
                    @endforeach
                </section>
            @endif

            <a href="{{ route('news.index') }}" class="back-to-news-btn">
                Haber Listesine Dön
            </a>

        </div>

        <x-sidebar />
    </div>
</div>

@endsection
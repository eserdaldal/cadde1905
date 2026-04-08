@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp


@section('content')

    {{-- ═══ HERO ═══ --}}
    @if ($page->hero)
        <div class="hero-section ui-hero">
            @if ($page->hero->imageUrl)
                <img
                    src="{{ Str::startsWith($page->hero->imageUrl, ['http://', 'https://']) ? $page->hero->imageUrl : asset('storage/' . $page->hero->imageUrl) }}"
                    alt="{{ $page->hero->title }}"
                    loading="eager"
                >
            @endif

            <div class="hero-gradient"></div>

            <div class="hero-overlay">
                @if ($page->hero->badge)
                    <span class="hero-badge">{{ $page->hero->badge }}</span>
                @endif

                <h1 class="hero-title ui-hero-title">{{ $page->hero->title }}</h1>

                @if ($page->hero->excerpt)
                    <p class="hero-excerpt">{{ $page->hero->excerpt }}</p>
                @endif

                @if ($page->hero->publishedAt)
                    <div class="hero-meta ui-hero-meta">
                        @if ($page->hero->publishedAt instanceof \Carbon\CarbonInterface)
                            {{ $page->hero->publishedAt->format('d.m.Y') }}
                        @else
                            {{ $page->hero->publishedAt }}
                        @endif
                    </div>
                @endif
            </div>

            <a href="{{ $page->hero->url }}" class="hero-link" aria-label="{{ $page->hero->title }}"></a>
        </div>
    @endif

    {{-- ═══ GÜNDEM (Variant 2) ═══ --}}
    @if (!empty($page->latestNews))
        <div class="home-block--normal">
            <div class="title-section ui-section-title">Gündem</div>

            <div class="grid-4">
                @foreach (array_slice($page->latestNews, 0, 4) as $item)
                    @if (!empty($item->imageUrl))
                        <div class="gundem-card ui-card">
                            <div class="img-wrap">
                                <img
                                    src="{{ Str::startsWith($item->imageUrl, ['http://', 'https://']) ? $item->imageUrl : asset('storage/' . $item->imageUrl) }}"
                                    alt="{{ $item->title }}"
                                >
                            </div>

                            <div class="card-body">
                                <div class="card-meta ui-card-meta">
                                    @if ($item->publishedAt instanceof \Carbon\CarbonInterface)
                                        {{ $item->publishedAt->format('d.m.Y') }}
                                    @else
                                        {{ $item->publishedAt }}
                                    @endif
                                </div>

                                <div class="card-title ui-card-title">{{ $item->title }}</div>
                            </div>

                            <a href="{{ $item->url }}" class="card-link" aria-label="{{ $item->title }}"></a>
                        </div>
                    @else
                        <div class="gundem-card--text ui-card">
                            <div class="card-meta ui-card-meta">
                                @if ($item->publishedAt instanceof \Carbon\CarbonInterface)
                                    {{ $item->publishedAt->format('d.m.Y') }}
                                @else
                                    {{ $item->publishedAt }}
                                @endif
                            </div>
                            <div class="card-title ui-card-title">{{ $item->title }}</div>
                            <a href="{{ $item->url }}" class="card-link" aria-label="{{ $item->title }}"></a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    {{-- ═══ GEÇMİŞTEN HİKÂYELER ═══ --}}
    @if (!empty($page->history))
        <div class="home-block--breathe">
            <div class="title-section ui-section-title">Geçmişten Hikâyeler</div>

            <div class="grid-2">
                @foreach ($page->history as $item)
                    <div class="block-card ui-card {{ empty($item->imageUrl) ? 'block-card--text' : '' }}">
                        @if ($item->imageUrl)
                            <img
                                src="{{ Str::startsWith($item->imageUrl, ['http://', 'https://']) ? $item->imageUrl : asset('storage/' . $item->imageUrl) }}"
                                alt="{{ $item->title }}"
                            >
                        @endif

                        <div class="card-body">
                            <div class="card-meta ui-card-meta">
                                @if ($item->publishedAt instanceof \Carbon\CarbonInterface)
                                    {{ $item->publishedAt->format('d.m.Y') }}
                                @else
                                    {{ $item->publishedAt }}
                                @endif
                            </div>

                            <div class="card-title ui-card-title">{{ $item->title }}</div>
                        </div>

                        <a href="{{ $item->url }}" class="card-link" aria-label="{{ $item->title }}"></a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection

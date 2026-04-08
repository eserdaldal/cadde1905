@php
    $theme = 'event-light';
    $activeTournament = $activeTournament ?? null;
@endphp
@extends('layouts.worldcup')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    
    // Clean redundant year from title
    $cleanPageTitle = $pageTitle;
    if ($pageYear && str_contains($pageTitle, (string)$pageYear)) {
        $cleanPageTitle = trim(str_replace((string)$pageYear, '', $pageTitle));
    }
    
    $pageTitleWithYear = $pageYear ? ($cleanPageTitle . ' ' . $pageYear) : $cleanPageTitle;

    $stadiums = $stadiums ?? [];
    $featuredStadiums = $featuredStadiums ?? [];
    $stadiumsForGrid = count($stadiums) > 0 ? $stadiums : $featuredStadiums;
@endphp

@section('title', 'Stadyumlar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')
    <div class="wc-container mb-24">
        <section class="wc-section wc-section--compact wc-section--compact-top">
            
            <header class="wc-page-header">
                <div class="inline-flex items-center gap-2 mb-2 px-3 py-1 rounded-full bg-[var(--surface-widget)] border border-[var(--border-soft)] mx-auto">
                    <span class="text-[10px] font-black text-[var(--accent-premium)] uppercase tracking-widest">Turnuva Arenaları</span>
                </div>
                <h1 class="wc-page-title">Stadyumlar</h1>
                <p class="wc-page-subtitle">{{ $pageTitleWithYear }} ev sahipliği yapacak olan, modern mimari ve teknolojiyle donatılmış arenalar.</p>
                <div class="wc-page-divider"></div>
            </header>

            @if (empty($stadiumsForGrid) || count($stadiumsForGrid) === 0)
                <div class="max-w-4xl mx-auto py-12">
                    @include('worldcup.partials.wc-empty-state', [
                        'icon' => '🏟️',
                        'title' => 'Stadyum Bilgileri Bekleniyor',
                        'description' => 'Turnuva arenaları ve şehir detayları kesinleştiğinde burada kapsamlı olarak listelenecektir.'
                    ])
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 wc-stadium-grid">
                    @foreach ($stadiumsForGrid as $stadium)
                        @include('worldcup.partials.stadium-card', ['stadium' => $stadium])
                    @endforeach
                </div>
            @endif

        </section>
    </div>
@endsection

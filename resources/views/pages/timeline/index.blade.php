@extends('layouts.app')

@php 
    \Carbon\Carbon::setLocale('tr');
@endphp

@section('title', $pageTitle ?? 'Galatasaray Tarihi - Kronoloji')


@section('content')
<div class="kronoloji-wrap py-10 px-4 max-w-5xl mx-auto">
    
    {{-- HEADER --}}
    <div class="mb-12 border-b border-zinc-800 pb-10">
        <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight" style="color: var(--text);">
            {{ $pageTitle ?? 'Galatasaray Tarihi' }}
        </h1>
        <p class="text-lg opacity-70 leading-relaxed max-w-3xl" style="color: var(--text);">
            Sarı ve kırmızıya adanmış yüzyıllık bir hafıza. Her anı taze, her hatıra gurur dolu.
        </p>
    </div>

    {{-- FILTER NAVIGATION --}}
    <nav class="timeline-filters">
        <a href="{{ route('timeline.index') }}" 
           class="filter-btn {{ empty($selectedType) ? 'active' : '' }}">
            Tüm Tarih
        </a>
        @foreach ($filterOptions as $filterKey => $filterLabel)
            <a href="{{ route('timeline.index', ['type' => $filterKey]) }}"
               class="filter-btn {{ $selectedType === $filterKey ? 'active' : '' }}">
                {{ $filterLabel }}
            </a>
        @endforeach
    </nav>

    @if ($entries->count() === 0)
        <div class="text-center py-20 bg-zinc-900/40 rounded-3xl border border-zinc-800">
            <h2 class="text-2xl font-bold mb-2">Henüz Kayıt Yok</h2>
            <p class="opacity-50">Seçilen kategoriye ait bir kronolojik veri bulunamadı.</p>
        </div>
    @else
        <div class="timeline-container">
            <div class="timeline-line"></div>

            @php $lastYear = null; @endphp

            @foreach ($entries as $entry)
                @php 
                    $entryDate = optional($entry->timeline_date);
                    $currentYear = $entryDate ? $entryDate->format('Y') : 'Bilinmeyen';
                @endphp

                {{-- YEAR MARKER --}}
                @if ($currentYear !== $lastYear)
                    <div class="year-marker">
                        <div class="year-circle"></div>
                        <div class="year-label">{{ $currentYear }}</div>
                    </div>
                    @php $lastYear = $currentYear; @endphp
                @endif

                {{-- TIMELINE ITEM --}}
                <article class="timeline-item">
                    <div class="timeline-dot"></div>
                    
                    <div class="timeline-card">
                        <div class="date-tag">
                            {{ $entryDate ? $entryDate->translatedFormat('d F') : 'Tarih Belirsiz' }}
                        </div>
                        
                        <h2 class="entry-title">{{ $entry->title }}</h2>
                        
                        @if ($entry->excerpt)
                            <div class="entry-content">
                                {{ $entry->excerpt }}
                            </div>
                        @endif

                        <div class="flex items-center gap-3">
                            <span class="type-badge">{{ $entry->type_label }}</span>
                            @if ($entry->source_label)
                                <span class="type-badge" style="background:transparent; border-color: rgba(var(--text-rgb), 0.1); color: var(--muted);">
                                    {{ $entry->source_label }}
                                </span>
                            @endif
                        </div>

                        @if ($entry->hasDetailUrl())
                            <div class="mt-5 pt-4 border-t border-zinc-800/50">
                                <a href="{{ $entry->detailUrl() }}" 
                                   class="text-sm font-bold flex items-center gap-2 transition hover:gap-3" 
                                   style="color: var(--red);">
                                    Detaylı İncele <span class="text-lg">→</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-12">
            {{ $entries->links() }}
        </div>
    @endif
</div>
@endsection
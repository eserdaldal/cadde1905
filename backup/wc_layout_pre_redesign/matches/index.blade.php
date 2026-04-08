{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — MAÇLAR
    Route: /dunya-kupasi/maclar
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', 'Maçlar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $filters = $filters ?? [];

        $rounds = $filters['rounds'] ?? ['Tümü', 'Grup Aşaması', 'Son 32', 'Son 16', 'Çeyrek Final', 'Yarı Final', 'Final'];
        $matches = $matches ?? [];
        $featuredMatches = $featuredMatches ?? [];
        $matchesForGrid = count($matches) > 0 ? $matches : $featuredMatches;

        $groupedMatches = collect($matchesForGrid)->groupBy(function ($match) {
            return $match->date_key ?? 'upcoming';
        });

        $dateNavigator = collect($matchesForGrid)
            ->filter(fn ($match) => !empty($match->date_key))
            ->unique('date_key')
            ->sortBy('date_key')
            ->values();
    @endphp

    {{-- Sayfa başlığı --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
        <h1 class="text-white font-black text-3xl">Maçlar</h1>
        <p class="text-gray-500 text-sm mt-2">
            {{ $pageTitleWithYear }} fikstürü
        </p>
    </div>

    {{-- ═══════ Filtreler ═══════ --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="flex flex-wrap items-center gap-3">
            {{-- Tur filtresi --}}
            @foreach ($rounds as $i => $round)
                <button class="px-3 py-1.5 rounded-full text-xs font-medium border transition-colors
                               {{ $i === 0
                                   ? 'bg-[#8D1B3D] border-[#8D1B3D] text-white'
                                   : 'bg-transparent border-white/10 text-gray-400 hover:text-white hover:border-white/30'
                               }}">
                    {{ $round }}
                </button>
            @endforeach
        </div>

        {{-- Tarih gezgini --}}
        <div class="mt-4 flex items-center gap-2 overflow-x-auto pb-2 scrollbar-hide">
            @if ($dateNavigator->isEmpty())
                <span class="text-gray-600 text-xs px-2">Tarih bilgisi bekleniyor</span>
            @else
                @foreach ($dateNavigator as $date)
                    <button class="flex-shrink-0 flex flex-col items-center px-3 py-2 rounded-lg
                                   border transition-colors border-white/5 text-gray-500 hover:border-white/20 hover:text-gray-300">
                        <span class="text-[10px] uppercase tracking-wider">{{ $date->month_label ?? '—' }}</span>
                        <span class="text-lg font-bold tabular-nums">{{ $date->day_label ?? '—' }}</span>
                    </button>
                @endforeach
            @endif
        </div>
    </div>

    {{-- ═══════ Maç Listesi ═══════ --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        @if ($groupedMatches->isEmpty())
            <div class="text-center text-white/60 py-10">
                No data available
            </div>
        @else
            @foreach ($groupedMatches as $dateKey => $items)
                <div class="mb-4">
                    <h3 class="text-gray-400 text-sm font-medium">
                        {{ $dateKey === 'upcoming' ? 'Yaklaşan Maçlar' : ($items->first()?->date_heading ?? 'Tarih') }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    @foreach ($items as $match)
                        <a href="#"
                           class="group block bg-white/5 hover:bg-white/10 border border-white/10
                                  rounded-xl p-4 transition-all duration-200">

                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs text-gray-500 uppercase tracking-wider">
                                    {{ $match->round ?? 'Grup' }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $match->time ?? '—' }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-2 flex-1 min-w-0">
                                    <div class="w-6 h-6 bg-white/10 rounded-full overflow-hidden flex-shrink-0">
                                        @if ($match->home_flag_url)
                                            <img src="{{ $match->home_flag_url }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-[10px] flex items-center justify-center h-full">🏳️</span>
                                        @endif
                                    </div>
                                    <span class="text-white font-medium text-sm truncate">
                                        {{ $match->home ?? 'Takım' }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 flex-shrink-0 px-3 py-1 rounded-lg bg-white/5">
                                    <span class="text-white font-bold text-lg tabular-nums">
                                        {{ $match->home_score ?? '–' }}
                                    </span>
                                    <span class="text-gray-600 text-xs">:</span>
                                    <span class="text-white font-bold text-lg tabular-nums">
                                        {{ $match->away_score ?? '–' }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 flex-1 min-w-0 justify-end">
                                    <span class="text-white font-medium text-sm truncate text-right">
                                        {{ $match->away ?? 'Takım' }}
                                    </span>
                                    <div class="w-6 h-6 bg-white/10 rounded-full overflow-hidden flex-shrink-0">
                                        @if ($match->away_flag_url)
                                            <img src="{{ $match->away_flag_url }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-[10px] flex items-center justify-center h-full">🏳️</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 text-xs text-gray-500 text-center">
                                {{ $match->stadium ?? 'Stadyum henüz açıklanmadı' }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

@endsection

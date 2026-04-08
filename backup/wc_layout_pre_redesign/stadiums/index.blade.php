{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — STADYUMLAR
    Route: /dunya-kupasi/stadyumlar
    Route name: worldcup.stadiums.index
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', 'Stadyumlar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $filters = $filters ?? [];

        $countryFilters = $filters['countries'] ?? ['Tümü'];
        $stadiums = $stadiums ?? [];
        $featuredStadiums = $featuredStadiums ?? [];
        $stadiumsForGrid = count($stadiums) > 0 ? $stadiums : $featuredStadiums;

        $countryFlagMap = [
            'ABD' => '🇺🇸',
            'Meksika' => '🇲🇽',
            'Kanada' => '🇨🇦',
            'USA' => '🇺🇸',
            'United States' => '🇺🇸',
            'Mexico' => '🇲🇽',
            'Canada' => '🇨🇦',
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
        <h1 class="text-white font-black text-3xl">Stadyumlar</h1>
        <p class="text-gray-500 text-sm mt-2">
            {{ $pageTitleWithYear }} — stadyumlar ve mekanlar
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="flex flex-wrap items-center gap-2">
            @foreach ($countryFilters as $i => $country)
                @php
                    $flag = $countryFlagMap[$country] ?? '';
                @endphp
                <button class="px-3 py-1.5 rounded-full text-xs font-medium border transition-colors flex items-center gap-1.5
                               {{ $i === 0 ? 'bg-[#8D1B3D] border-[#8D1B3D] text-white' : 'bg-transparent border-white/10 text-gray-400 hover:text-white hover:border-white/30' }}">
                    @if ($flag)
                        <span>{{ $flag }}</span>
                    @endif
                    {{ $country }}
                </button>
            @endforeach
        </div>
    </div>

    @php
        $stadiumsForRender = count($stadiumsForGrid) > 0 ? $stadiumsForGrid : [];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        @if (empty($stadiumsForRender) || count($stadiumsForRender) === 0)
            <div class="text-center text-white/60 py-10">
                Veri bekleniyor
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($stadiumsForRender as $stadium)
                    @include('worldcup.partials.stadium-card', ['stadium' => $stadium])
                @endforeach
            </div>
        @endif
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="bg-white/5 border border-white/10 border-dashed rounded-xl p-12 text-center">
            <span class="text-4xl opacity-30 block mb-3">🗺️</span>
            <p class="text-gray-500 text-sm">
                İnteraktif stadyum haritası ileride eklenecektir.
            </p>
        </div>
    </div>

@endsection

{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — TAKIMLAR
    Route: /dunya-kupasi/takimlar
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', 'Takımlar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $filters = $filters ?? [];

        $confederations = $filters['confederations'] ?? ['Tümü', 'UEFA', 'CONMEBOL', 'CONCACAF', 'CAF', 'AFC', 'OFC'];
        $teams = $teams ?? [];
        $featuredTeams = $featuredTeams ?? [];
        $teamsForGrid = count($teams) > 0 ? $teams : $featuredTeams;
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
        <h1 class="text-white font-black text-3xl">Takımlar</h1>
        <p class="text-gray-500 text-sm mt-2">
            {{ $pageTitleWithYear }}'ya katılan ülkeler
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="flex flex-wrap items-center gap-2">
            @foreach ($confederations as $i => $conf)
                <button class="px-3 py-1.5 rounded-full text-xs font-medium border transition-colors
                               {{ $i === 0 ? 'bg-[#8D1B3D] border-[#8D1B3D] text-white' : 'bg-transparent border-white/10 text-gray-400 hover:text-white hover:border-white/30' }}">
                    {{ $conf }}
                </button>
            @endforeach

            <div class="ml-auto relative">
                <input type="text"
                       placeholder="Takım ara..."
                       class="bg-white/5 border border-white/10 rounded-lg px-3 py-1.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-white/30 w-48">
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        @if (empty($teamsForGrid) || count($teamsForGrid) === 0)
            <div class="text-center text-white/60 py-10">
                Veri bekleniyor
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($teamsForGrid as $team)
                    @include('worldcup.partials.team-card', ['team' => $team])
                @endforeach
            </div>
        @endif
    </div>

@endsection

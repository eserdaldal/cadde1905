{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — GRUPLAR & PUAN DURUMU
    Route: /dunya-kupasi/gruplar
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', 'Gruplar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $filters = $filters ?? [];
        $groups = $groups ?? [];

        $groupFilters = $filters['groups'] ?? [];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-8">
        <h1 class="text-white font-black text-3xl">Gruplar & Puan Durumu</h1>
        <p class="text-gray-500 text-sm mt-2">
            {{ $pageTitleWithYear }} — 12 grup, 48 takım
        </p>
    </div>

    @if (!empty($groupFilters))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6">
            <div class="flex flex-wrap items-center gap-2">
                @foreach ($groupFilters as $i => $filter)
                    <button class="px-3 py-1.5 rounded-full text-xs font-medium border transition-colors
                                   {{ $i === 0 ? 'bg-[#8D1B3D] border-[#8D1B3D] text-white' : 'bg-transparent border-white/10 text-gray-400 hover:text-white hover:border-white/30' }}">
                        Grup {{ $filter }}
                    </button>
                @endforeach
            </div>
        </div>
    @endif

    @php
        $groupsForGrid = !empty($groups) && count($groups) > 0 ? $groups : [];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        @if (empty($groupsForGrid) || count($groupsForGrid) === 0)
            <div class="text-center text-white/60 py-10">
                Veri bekleniyor
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($groupsForGrid as $group)
                    @include('worldcup.partials.group-table', ['group' => $group])
                @endforeach
            </div>
        @endif

        <div class="mt-8 flex items-center gap-6 text-xs text-gray-500">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-sm bg-[#1D6F42]"></span>
                Son 32 turuna katılır
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-sm bg-white/10"></span>
                Elenir
            </div>
        </div>
    </div>

@endsection

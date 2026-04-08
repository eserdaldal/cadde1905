{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — KUPADAKİ ASLANLAR
    Route: /dunya-kupasi/kupadaki-aslanlar
    CADDE1905'in en özel bölümü — Galatasaray kimliğini öne çıkarır.
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', 'Kupadaki Aslanlar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $filters = $filters ?? [];
        $players = $players ?? [];
        $featuredPlayers = $featuredPlayers ?? [];

        $relationFilters = $filters['relation_types'] ?? [];
        $playersForGrid = count($players) > 0 ? $players : $featuredPlayers;
    @endphp

    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#D4AF37]/15 via-[#1E1E1C] to-[#8D1B3D]/10"></div>
        <div class="absolute inset-0 opacity-5"
             style="background-image: radial-gradient(circle at 2px 2px, #D4AF37 1px, transparent 0); background-size: 32px 32px;">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="text-center">
                <span class="text-5xl mb-4 block">🦁</span>
                <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-3">
                    Kupadaki
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#F5D76E]">
                        Aslanlar
                    </span>
                </h1>
                <p class="text-gray-400 text-base sm:text-lg max-w-2xl mx-auto">
                    Galatasaray'ın yıldızları dünya sahnesinde.
                    Kupada forma giyen Cim Bom'un gurur kaynakları.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-2xl mx-auto">
                @php
                    $heroStats = [
                        ['value' => (string) max(0, count($playersForGrid)), 'label' => 'Oyuncu'],
                        ['value' => (string) collect($playersForGrid)->pluck('nationalTeam.name')->filter()->unique()->count(), 'label' => 'Farklı Ülke'],
                        ['value' => '—', 'label' => 'Toplam Gol'],
                        ['value' => '—', 'label' => 'Toplam Dakika'],
                    ];
                @endphp
                @foreach ($heroStats as $hs)
                    <div class="text-center">
                        <div class="text-[#D4AF37] font-black text-2xl">{{ $hs['value'] }}</div>
                        <div class="text-gray-500 text-xs mt-1">{{ $hs['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
        <div class="flex flex-wrap items-center gap-2">
            @if (!empty($relationFilters))
                @foreach ($relationFilters as $i => $filter)
                    <button class="px-3 py-1.5 rounded-full text-xs font-medium border transition-colors flex items-center gap-1.5
                                   {{ $i === 0 ? 'bg-[#D4AF37]/20 border-[#D4AF37]/50 text-[#D4AF37]' : 'bg-transparent border-white/10 text-gray-400 hover:text-white hover:border-white/30' }}">
                        {{ $filter }}
                    </button>
                @endforeach
            @else
                @php
                    $ntFilters = [
                        ['flag' => '', 'label' => 'Tümü'],
                    ];
                @endphp
                @foreach ($ntFilters as $i => $f)
                    <button class="px-3 py-1.5 rounded-full text-xs font-medium border transition-colors flex items-center gap-1.5
                                   {{ $i === 0 ? 'bg-[#D4AF37]/20 border-[#D4AF37]/50 text-[#D4AF37]' : 'bg-transparent border-white/10 text-gray-400 hover:text-white hover:border-white/30' }}">
                        @if ($f['flag'])
                            <span>{{ $f['flag'] }}</span>
                        @endif
                        {{ $f['label'] }}
                    </button>
                @endforeach
            @endif
        </div>
    </div>

    @php
        $playersForRender = count($playersForGrid) > 0 ? $playersForGrid : [];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        @if (empty($playersForRender) || count($playersForRender) === 0)
            <div class="text-center text-white/60 py-10">
                Veri bekleniyor
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($playersForRender as $player)
                    @include('worldcup.partials.player-card', ['player' => $player])
                @endforeach
            </div>
        @endif
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <h2 class="text-white font-bold text-lg mb-4">Kupa Performans Özeti</h2>

        @if (empty($playersForRender) || count($playersForRender) === 0)
            <div class="text-center text-white/60 py-10">
                Veri bekleniyor
            </div>
        @else
            <div class="bg-white/5 border border-white/10 rounded-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-sm min-w-[600px]">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/[0.03] text-gray-500 text-xs">
                            <th class="text-left py-3 px-4 font-medium">Oyuncu</th>
                            <th class="text-center py-3 px-2 font-medium">Milli Takım</th>
                            <th class="text-center py-3 px-2 font-medium">Maç</th>
                            <th class="text-center py-3 px-2 font-medium">Gol</th>
                            <th class="text-center py-3 px-2 font-medium">Asist</th>
                            <th class="text-center py-3 px-2 font-medium">Dakika</th>
                            <th class="text-center py-3 px-2 font-medium">Kart</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($playersForRender as $player)
                            <tr class="border-b border-white/5 last:border-0 hover:bg-white/[0.03] transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-[#D4AF37]/10 flex items-center justify-center text-[#D4AF37] text-[10px] font-bold flex-shrink-0">
                                            {{ $player->gs_squad_number ?? '—' }}
                                        </div>
                                        <span class="text-white font-medium">{{ $player->name }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="text-base">{{ $player->nationalTeam->flag_emoji ?? '🏳️' }}</span>
                                </td>
                                <td class="text-center text-gray-400">—</td>
                                <td class="text-center text-gray-400">—</td>
                                <td class="text-center text-gray-400">—</td>
                                <td class="text-center text-gray-400">—</td>
                                <td class="text-center text-gray-400">—</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <p class="text-gray-600 text-xs mt-4 text-center">
            Turnuva başladığında veriler güncellenecektir.
        </p>
    </section>

@endsection

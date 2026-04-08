{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — OYUNCU DETAY
    Route: /dunya-kupasi/kupadaki-aslanlar/{player:slug}
    Route name: worldcup.aslanlar.show
    Beklenen değişken: $player (ileride controller'dan)
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $player = $player ?? null;
    $activeTournament = $activeTournament ?? null;

    $playerName = $player?->name ?? 'Oyuncu Adı';
    $position = $player?->position ?? 'Pozisyon';
    $nationality = $player?->nationality ?? 'Milli Takım';
    $clubName = $player?->club ?? null;
    $shirtNumber = $player?->shirt_number ?? '—';
    $relationType = $player?->relation_type ?? '—';
    $relationNote = $player?->relation_note ?? null;

    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', $playerName . ' — Kupadaki Aslanlar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    {{-- ═══════ Oyuncu Profil Hero ═══════ --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#D4AF37]/15 via-[#1E1E1C] to-[#8D1B3D]/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">

                {{-- Oyuncu görseli placeholder --}}
                <div class="w-40 h-52 sm:w-48 sm:h-64 bg-white/5 border border-white/10
                            rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-6xl opacity-20">🦁</span>
                </div>

                {{-- Oyuncu bilgileri --}}
                <div class="text-center sm:text-left">
                    {{-- GS rozeti --}}
                    <div class="inline-flex items-center gap-2 bg-[#D4AF37]/20 border border-[#D4AF37]/30
                                rounded-full px-3 py-1 mb-3">
                        <span class="text-[#D4AF37] text-xs font-bold">GS #{{ $shirtNumber }}</span>
                    </div>

                    <h1 class="text-white font-black text-3xl sm:text-4xl">{{ $playerName }}</h1>
                    <p class="text-gray-400 text-lg mt-1">{{ $position }}</p>

                    <div class="flex items-center gap-3 mt-4 justify-center sm:justify-start">
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <span class="text-xl">🏳️</span>
                            <span>{{ $nationality }}</span>
                        </div>
                    </div>

                    {{-- Hızlı istatistikler --}}
                    <div class="mt-6 grid grid-cols-4 gap-4 max-w-sm">
                        @php
                            $quickStats = [
                                ['value' => '—', 'label' => 'Maç'],
                                ['value' => '—', 'label' => 'Gol'],
                                ['value' => '—', 'label' => 'Asist'],
                                ['value' => '—', 'label' => 'Dakika'],
                            ];
                        @endphp
                        @foreach ($quickStats as $qs)
                            <div class="text-center">
                                <div class="text-[#D4AF37] font-black text-xl">{{ $qs['value'] }}</div>
                                <div class="text-gray-500 text-xs mt-0.5">{{ $qs['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════ Galatasaray Bilgileri ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h2 class="text-white font-bold text-xl mb-6">
            <span class="text-[#D4AF37]">🦁</span> Galatasaray Bilgileri
        </h2>
        <div class="bg-white/5 border border-[#D4AF37]/20 rounded-xl p-5">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @php
                $gsInfo = [
                        ['label' => 'Forma No',     'value' => $shirtNumber],
                        ['label' => 'İlişki Tipi',   'value' => $relationType],
                        ['label' => 'Pozisyon',      'value' => $position],
                        ['label' => 'Kulüp',         'value' => $clubName ?: '—'],
                    ];
                @endphp
                @foreach ($gsInfo as $gi)
                    <div>
                        <div class="text-gray-500 text-xs uppercase tracking-wider mb-1">{{ $gi['label'] }}</div>
                        <div class="text-white font-semibold text-sm">{{ $gi['value'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════ Milli Takım Bilgileri ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <h2 class="text-white font-bold text-xl mb-6">Milli Takım</h2>
        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <div class="flex items-center gap-4">
                <span class="text-4xl">🏳️</span>
                <div>
                    <h3 class="text-white font-semibold">{{ $nationality }}</h3>
                    <p class="text-gray-500 text-sm">Milli takım bilgisi</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════ Kupa Maçları ve Performans ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <h2 class="text-white font-bold text-xl mb-6">Kupa Maçları</h2>
        <div class="bg-white/5 border border-white/10 rounded-xl overflow-hidden overflow-x-auto">
            <table class="w-full text-sm min-w-[550px]">
                <thead>
                    <tr class="border-b border-white/10 bg-white/[0.03] text-gray-500 text-xs">
                        <th class="text-left py-3 px-4 font-medium">Maç</th>
                        <th class="text-center py-3 px-2 font-medium">Dakika</th>
                        <th class="text-center py-3 px-2 font-medium">Gol</th>
                        <th class="text-center py-3 px-2 font-medium">Asist</th>
                        <th class="text-center py-3 px-2 font-medium">Kart</th>
                        <th class="text-center py-3 px-2 font-medium">Puan</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 3; $i++)
                        <tr class="border-b border-white/5 last:border-0 hover:bg-white/[0.03] transition-colors">
                            <td class="py-3 px-4">
                                <span class="text-white">🇹🇷 Türkiye vs Rakip 🏳️</span>
                            </td>
                            <td class="text-center text-gray-400">—</td>
                            <td class="text-center text-gray-400">—</td>
                            <td class="text-center text-gray-400">—</td>
                            <td class="text-center text-gray-400">—</td>
                            <td class="text-center text-gray-400">—</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <p class="text-gray-600 text-xs mt-4 text-center">
            Turnuva başladığında veriler güncellenecektir.
        </p>
    </section>

    @if ($relationNote)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
            <h2 class="text-white font-bold text-xl mb-4">Not</h2>
            <div class="bg-white/5 border border-white/10 rounded-xl p-5 text-sm text-gray-300">
                {{ $relationNote }}
            </div>
        </section>
    @endif

    {{-- ═══════ Geri Dön Linki ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <a href="{{ route('worldcup.aslanlar.index') }}"
           class="text-[#D4AF37] text-sm font-medium hover:underline">
            ← Tüm Aslanlar
        </a>
    </section>

@endsection

{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — TAKIM DETAY
    Route: /dunya-kupasi/takimlar/{team:slug}
    Route name: worldcup.teams.show
    Beklenen değişken: $team (ileride controller'dan)
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $team = $team ?? null;
    $players = $players ?? [];
    $matches = $matches ?? [];
    $activeTournament = $activeTournament ?? null;

    $teamName = $team?->name_override ?: $team?->name_api ?: 'Takım';
    $groupName = $team?->group?->code ?: $team?->group?->name;
    $metaParts = array_filter([
        $groupName ? 'Grup ' . $groupName : null,
        $team?->confederation,
    ]);
    $coachName = $team?->coach_name_api;

    $matchesForGrid = collect($matches)->take(3);

    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', $teamName . ' — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    {{-- ═══════ Hero: Bayrak + Takım Bilgisi ═══════ --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#8D1B3D]/10 via-[#1E1E1C] to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <div class="flex items-center gap-6">
                <div class="flex items-center justify-center w-20 h-20 sm:w-28 sm:h-28 bg-white/10 rounded-full overflow-hidden border-4 border-white/5 flex-shrink-0">
                    @if ($team?->flag_url)
                        <img src="{{ $team->flag_url }}" alt="{{ $teamName }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-4xl">🏳️</span>
                    @endif
                </div>
                <div>
                    <h1 class="text-white font-black text-3xl sm:text-4xl">{{ $teamName }}</h1>
                    <div class="flex flex-wrap items-center gap-3 mt-2 text-sm text-gray-400">
                        @if (!empty($metaParts))
                            @foreach ($metaParts as $index => $part)
                                @if ($index > 0)
                                    <span class="text-white/20">·</span>
                                @endif
                                <span>{{ $part }}</span>
                            @endforeach
                        @else
                            <span>Grup —</span>
                        @endif
                    </div>
                    <div class="mt-2 text-gray-500 text-sm">
                        Teknik Direktör: <span class="text-white">{{ $coachName ?: '—' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════ Kadro Listesi ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h2 class="text-white font-bold text-xl mb-6">Kadro</h2>
        <div class="bg-white/5 border border-white/10 rounded-xl overflow-hidden overflow-x-auto">
            <table class="w-full text-sm min-w-[500px]">
                <thead>
                    <tr class="border-b border-white/10 bg-white/[0.03] text-gray-500 text-xs">
                        <th class="text-left py-3 px-4 font-medium w-10">#</th>
                        <th class="text-left py-3 px-2 font-medium">Oyuncu</th>
                        <th class="text-left py-3 px-2 font-medium">Pozisyon</th>
                        <th class="text-left py-3 px-2 font-medium">Kulüp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($players as $player)
                        <tr class="border-b border-white/5 last:border-0 hover:bg-white/[0.03] transition-colors">
                            <td class="py-3 px-4 text-gray-500">{{ $player->shirt_number ?: $loop->iteration }}</td>
                            <td class="py-3 px-2 text-white font-medium">{{ $player->name_override ?: $player->name_api ?: 'Oyuncu' }}</td>
                            <td class="py-3 px-2 text-gray-400">{{ $player->position ?: '—' }}</td>
                            <td class="py-3 px-2 text-gray-500">{{ $player->club_name_normalized ?: $player->club_name_api ?: '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 px-4 text-center text-gray-500">
                                <div class="text-3xl mb-3">📋</div>
                                <p>Bu turnuva için oyuncu kadrosu henüz açıklanmadı.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- ═══════ Grup Maçları ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <h2 class="text-white font-bold text-xl mb-6">Grup Maçları</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @if ($matchesForGrid->isEmpty())
                @for ($i = 0; $i < 3; $i++)
                    @include('worldcup.partials.match-card')
                @endfor
            @else
                @foreach ($matchesForGrid as $match)
                    @include('worldcup.partials.match-card', ['match' => $match])
                @endforeach
            @endif
        </div>
    </section>

    {{-- ═══════ İstatistik Özeti ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <h2 class="text-white font-bold text-xl mb-6">Turnuva İstatistikleri</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach (['Maç' => '—', 'Gol' => '—', 'Gol Yenilen' => '—', 'Puan' => '—'] as $label => $val)
                <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                    <div class="text-white font-bold text-xl">{{ $val }}</div>
                    <div class="text-gray-500 text-xs mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </section>

@endsection

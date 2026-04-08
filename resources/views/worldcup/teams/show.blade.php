{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — TAKIM DETAY
    Route: /dunya-kupasi/takimlar/{team:slug}
    Route name: worldcup.teams.show
    ══════════════════════════════════════════════════════════════
--}}

@extends('layouts.worldcup')

@php
    $team = $team ?? null;
    $players = $players ?? [];
    $matches = $matches ?? [];
    $activeTournament = $activeTournament ?? null;
    $theme = 'event-light';

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

    <div class="event-layout contents">
        {{-- HERO SECTION --}}
        <section class="relative overflow-hidden pt-12 pb-16 border-b border-[var(--border-default)]">
            <div class="absolute inset-0 bg-gradient-to-br from-[#A91D35]/15 via-[var(--surface-base)] to-transparent"></div>
            <div class="wc-container relative">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 text-center sm:text-left">
                    <div class="flex items-center justify-center w-24 h-24 sm:w-32 sm:h-32 bg-[var(--surface-widget)] rounded-full overflow-hidden border-4 border-[var(--border-soft)] shadow-2xl flex-shrink-0">
                        @if ($team?->flag_url)
                            <img src="{{ $team->flag_url }}" alt="{{ $teamName }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-5xl">🏳️</span>
                        @endif
                    </div>
                    <div class="pt-2">
                        <h1 class="text-[var(--text-primary)] font-black text-4xl sm:text-5xl lg:text-6xl">{{ $teamName }}</h1>
                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 mt-4 text-[11px] font-black uppercase tracking-widest text-[var(--text-secondary)]">
                            @if (!empty($metaParts))
                                @foreach ($metaParts as $index => $part)
                                    @if ($index > 0)
                                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--border-soft)]"></span>
                                    @endif
                                    <span>{{ $part }}</span>
                                @endforeach
                            @else
                                <span>Turnuva Katılımcısı</span>
                            @endif
                        </div>
                        <div class="mt-4 flex flex-wrap items-center justify-center sm:justify-start gap-4">
                            <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[var(--surface-widget)] border border-[var(--border-soft)]">
                                <span class="text-[var(--text-muted)] text-[10px] font-bold uppercase tracking-tight">Teknik Direktör:</span>
                                <span class="text-[var(--text-primary)] text-xs font-bold">{{ $coachName ?: 'Bilgi yok' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <div class="wc-container">
        {{-- KADRO LİSTESİ --}}
        <section class="wc-section wc-section--compact">
            @include('worldcup.partials.wc-section-header', [
                'title' => 'Oyuncu Kadrosu',
                'subtitle' => 'Turnuva için tescil edilen resmi milli takım kadrosu.'
            ])

            @if (empty($players) || count($players) === 0)
                @include('worldcup.partials.wc-empty-state', [
                    'title' => 'Kadrolar açıklanmadı',
                    'description' => 'Milli takım kadroları turnuva öncesi kesinleştiğinde burada tüm detaylarıyla listelenecektir.',
                    'class' => 'wc-empty-state--compact bg-[var(--surface-widget)] border-[var(--border-soft)]'
                ])
            @else
                <div class="wc-card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm min-w-[600px]">
                            <thead>
                                <tr class="border-b border-[var(--border-soft)] bg-[var(--surface-widget)] text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest">
                                    <th class="text-left py-4 px-6 w-16">#</th>
                                    <th class="text-left py-4 px-3">Oyuncu</th>
                                    <th class="text-left py-4 px-3 w-40">Pozisyon</th>
                                    <th class="text-left py-4 px-3">Mevcut Kulüp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($players as $player)
                                    <tr class="border-b border-[var(--border-soft)] last:border-0 hover:bg-[var(--surface-base)] transition-colors group">
                                        <td class="py-4 px-6">
                                            <span class="text-[var(--text-muted)] font-black tabular-nums">{{ $player->shirt_number ?: $loop->iteration }}</span>
                                        </td>
                                        <td class="py-4 px-3 font-bold text-[var(--text-primary)] group-hover:text-[var(--accent-premium)] transition-colors">
                                            {{ $player->name_override ?: $player->name_api ?: 'Oyuncu' }}
                                        </td>
                                        <td class="py-4 px-3 text-[var(--text-secondary)] font-medium">
                                            <span class="px-2 py-0.5 rounded bg-[var(--surface-widget)] border border-[var(--border-soft)] text-[10px]">{{ $player->position ?: '—' }}</span>
                                        </td>
                                        <td class="py-4 px-3 text-[var(--text-muted)] font-medium italic">
                                            {{ $player->club_name_normalized ?: $player->club_name_api ?: '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </section>

        {{-- GRUP MAÇLARI --}}
        <section class="wc-section wc-section--compact pt-0">
             @include('worldcup.partials.wc-section-header', [
                'title' => 'Turnuva Maçları',
                'subtitle' => $teamName . ' takımının turnuva takvimindeki karşılaşmaları.'
            ])

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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

        {{-- İSTATİSTİK ÖZETİ --}}
        <section class="wc-section wc-section--compact pt-0 pb-24">
             @include('worldcup.partials.wc-section-header', [
                'title' => 'Turnuva Özeti',
                'subtitle' => 'Milli takımın turnuva performansı ve genel istatistikleri.'
            ])

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach (['Maç' => '—', 'Gol' => '—', 'Yenilen Gol' => '—', 'Puan' => '—'] as $label => $val)
                    @php
                        $isGhost = is_null($val) || $val === '' || $val === '—';
                    @endphp
                    <div class="wc-card p-5 text-center bg-[var(--surface-widget)]">
                        @if ($isGhost)
                            <div class="wc-ghost-value w-14 h-7 opacity-30 mx-auto"></div>
                        @else
                            <div class="text-[var(--text-primary)] font-black text-2xl tabular-nums leading-none">{{ $val }}</div>
                        @endif
                        <div class="text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest mt-2">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection

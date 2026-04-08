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

    $filters = $filters ?? [];
    $players = $players ?? [];
    $featuredPlayers = $featuredPlayers ?? [];

    $relationFilters = $filters['relation_types'] ?? [];
    $playersForGrid = count($players) > 0 ? $players : $featuredPlayers;
    $hasPlayers = count($playersForGrid) > 0;
@endphp

@section('title', 'Kupadaki Aslanlar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    {{-- HERO SECTION — Editorial Special: Kupadaki Aslanlar --}}
    <section class="relative overflow-hidden pt-20 pb-4 border-b border-[var(--border-soft)]">
        <div class="absolute inset-0 bg-gradient-to-br from-[#A91D35]/15 via-transparent to-[#FFB816]/10"></div>
        <img src="/assets/images/worldcup/maradona.avif" alt="" aria-hidden="true" class="absolute inset-0 w-full h-full object-cover opacity-40">

        <div class="wc-container relative text-center">
            <div class="inline-flex items-center gap-3 mb-8 px-6 py-2.5 rounded-full bg-[var(--surface-widget)] border border-[var(--border-soft)] backdrop-blur-xl shadow-2xl">
                <span class="text-2xl">🦁</span>
                <span class="text-[11px] font-black text-[var(--accent-premium)] uppercase tracking-[0.25em]">Cim Bom'un Gurur Kaynakları</span>
            </div>
            
            <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black leading-none mb-8 tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-[#A91D35] via-[#FFB816] to-[#A91D35] drop-shadow-sm" style="-webkit-text-fill-color: transparent;">
                Kupadaki Aslanlar
            </h1>
            
            <p class="text-[var(--text-primary)] text-xl sm:text-2xl max-w-4xl mx-auto font-medium leading-relaxed mb-10 opacity-80">
                Parçalıyı dünya sahnesine taşıyan yıldızlarımız. Galatasaray'ın gurur verici Dünya Kupası mirası ve 2026 serüveni.
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 max-w-5xl mx-auto">
                @php
                    $heroStats = [
                        ['value' => $hasPlayers ? (string)count($playersForGrid) : null, 'label' => 'Aslan', 'bg' => 'bg-gradient-to-br from-[#A91D35] to-[#8E1B3D]', 'color' => '#FFFFFF'],
                        ['value' => $hasPlayers ? (string)collect($playersForGrid)->pluck('nationalTeam.name')->filter()->unique()->count() : null, 'label' => 'Milli Takım', 'bg' => 'bg-gradient-to-br from-[#FFB816] to-[#E2B747]', 'color' => '#000000'],
                        ['value' => null, 'label' => 'Gol', 'bg' => 'bg-gradient-to-br from-[#A91D35] to-[#8E1B3D]', 'color' => '#FFFFFF'],
                        ['value' => null, 'label' => 'Maç', 'bg' => 'bg-gradient-to-br from-[#FFB816] to-[#E2B747]', 'color' => '#000000'],
                    ];
                @endphp
                @foreach ($heroStats as $hs)
                    <div class="p-8 rounded-[2.5rem] {{ $hs['bg'] }} shadow-3xl group transform hover:-translate-y-1 transition-all border border-[var(--border-soft)]">
                        @if($hs['value'])
                            <div class="font-black text-6xl tabular-nums tracking-tighter mb-2" style="color: {{ $hs['color'] }} !important;">{{ $hs['value'] }}</div>
                        @else
                            <div class="wc-ghost-value w-16 h-12 opacity-30 mx-auto mb-2 bg-[var(--surface-widget)]"></div>
                        @endif
                        <div class="text-[12px] font-black uppercase tracking-widest" style="color: {{ $hs['color'] }} !important; opacity: 0.9;">{{ $hs['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FILTERS & GRID --}}
    <div class="wc-container mt-0">
        <section class="wc-section wc-section--compact py-4">
            <div class="flex flex-wrap items-center justify-center gap-4 mb-6">
                @if (!empty($relationFilters))
                    @foreach ($relationFilters as $i => $filter)
                        <button class="px-8 py-3 rounded-full text-xs font-black uppercase tracking-widest border transition-all
                                       {{ $i === 0 
                                           ? 'bg-[var(--accent-premium)] border-[var(--accent-premium)] text-[#101010] shadow-2xl shadow-[var(--accent-premium)]/20' 
                                           : 'bg-[var(--surface-widget)] border-[var(--border-soft)] text-[var(--text-secondary)] hover:bg-[var(--surface-hover)]' 
                                       }}">
                            {{ $filter }}
                        </button>
                    @endforeach
                @else
                    <button class="px-8 py-3 rounded-full text-xs font-black uppercase tracking-widest bg-[var(--accent-premium)] border-[var(--accent-premium)] text-[#101010] shadow-2xl shadow-[var(--accent-premium)]/20">
                        Tüm Aslanlar
                    </button>
                @endif
            </div>

            @if (!$hasPlayers)
                <div class="max-w-4xl mx-auto mb-4">
                    @include('worldcup.partials.wc-empty-state', [
                        'icon' => '🎭',
                        'title' => 'Kadro henüz açıklanmadı',
                        'description' => 'Resmi kadrolar açıklandığında, Dünya Kupası sahnesine çıkan aslanlarımızı burada göreceksiniz.',
                        'class' => 'wc-empty-state--compact bg-[var(--surface-widget)] border-[var(--border-soft)]'
                    ])
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 mb-4">
                    @foreach ($playersForGrid as $player)
                        @include('worldcup.partials.player-card', ['player' => $player])
                    @endforeach
                </div>
            @endif
        </section>

        {{-- PERFORMANCE TABLE — Deep Look --}}
        <section class="wc-section wc-section--compact pt-0 pb-4">
             <div class="mb-8">
                 @include('worldcup.partials.wc-section-header', [
                    'title' => 'Aslan Performans Analizi',
                    'subtitle' => 'Oyuncularımızın turnuva boyunca sergiledikleri tüm bireysel veriler ve anlık istatistikler.',
                    'class' => 'wc-section-header--center'
                ])
             </div>

            @if (!$hasPlayers)
                <div class="wc-match-card p-12 flex flex-col items-center justify-center min-h-[400px] border-dashed border-[var(--border-soft)] bg-[var(--surface-widget)] text-center rounded-[2.5rem]">
                    <div class="wc-ghost-value w-full max-w-lg h-5 opacity-10 mx-auto mb-6"></div>
                    <div class="wc-ghost-value w-3/4 h-5 opacity-5 mx-auto"></div>
                    <p class="mt-8 text-xs font-black uppercase tracking-[0.25em] text-[var(--text-primary)] opacity-60 animate-pulse">Opta verileri henüz açıklanmadı</p>
                </div>
            @else
                <div class="wc-match-card overflow-hidden border-[var(--border-soft)] rounded-[2rem]">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm min-w-[900px]">
                            <thead>
                                <tr class="border-b border-[var(--border-soft)] bg-[var(--surface-widget)] text-[var(--text-muted)] text-[11px] font-black uppercase tracking-widest">
                                    <th class="text-left py-6 px-10">Oyuncu</th>
                                    <th class="text-center py-6 px-4 w-44">Milli Takım</th>
                                    <th class="text-center py-6 px-3 w-28">Maç</th>
                                    <th class="text-center py-6 px-3 w-28">Gol</th>
                                    <th class="text-center py-6 px-3 w-28">Asist</th>
                                    <th class="text-center py-6 px-3 w-32">Dakika</th>
                                    <th class="text-center py-6 px-3 w-28">Kart</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[var(--border-soft)]">
                                @foreach ($playersForGrid as $player)
                                    <tr class="hover:bg-[var(--surface-hover)] transition-colors group">
                                        <td class="py-6 px-10">
                                            <div class="flex items-center gap-5">
                                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[var(--surface-widget)] to-transparent flex items-center justify-center text-[var(--accent-premium)] text-sm font-black shadow-inner flex-shrink-0 border border-[var(--border-soft)]">
                                                    {{ $player->gs_squad_number ?? '🦁' }}
                                                </div>
                                                <div>
                                                    <div class="text-[var(--text-primary)] font-bold text-lg group-hover:text-[var(--accent-premium)] transition-colors leading-none mb-1.5">
                                                        {{ $player->name }}
                                                    </div>
                                                    <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)]">
                                                        {{ $player->gs_relation_text ?? 'Galatasaray Oyuncusu' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center px-4">
                                            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-[var(--surface-hover)] border border-[var(--border-soft)] group-hover:border-[var(--accent-premium)]/20 transition-colors">
                                                <span class="text-2xl">{{ $player->nationalTeam->flag_emoji ?? '🏳️' }}</span>
                                                <span class="text-[11px] font-black uppercase tracking-widest text-[var(--text-secondary)]">{{ $player->nationalTeam->name ?? '—' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center text-[var(--text-muted)] font-black tabular-nums scale-110">
                                             <span class="wc-ghost-value w-8 h-5 opacity-20 mx-auto"></span>
                                        </td>
                                        <td class="text-center text-[var(--text-muted)] font-black tabular-nums scale-110">
                                             <span class="wc-ghost-value w-8 h-5 opacity-20 mx-auto"></span>
                                        </td>
                                        <td class="text-center text-[var(--text-muted)] font-black tabular-nums scale-110">
                                             <span class="wc-ghost-value w-8 h-5 opacity-20 mx-auto"></span>
                                        </td>
                                        <td class="text-center text-[var(--text-muted)] font-black tabular-nums scale-110">
                                             <span class="wc-ghost-value w-12 h-5 opacity-20 mx-auto"></span>
                                        </td>
                                         <td class="text-center text-[var(--text-muted)] font-black tabular-nums scale-110">
                                             <span class="wc-ghost-value w-8 h-5 opacity-20 mx-auto"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-8 flex items-center justify-center gap-4 text-xs font-black uppercase tracking-[0.2em] text-[var(--text-muted)] bg-[var(--surface-widget)] p-8 rounded-[2rem] border border-[var(--border-soft)] shadow-2xl">
                    <span class="animate-pulse text-[var(--accent-premium)] text-2xl">🏆</span>
                    <span>Turnuva başladığında tüm performans verileri Opta servisleriyle anlık olarak senkronize edilecektir.</span>
                </div>
            @endif
        </section>
    </div>

@endsection

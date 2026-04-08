{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — OYUNCU DETAY (KUPADAKİ ASLANLAR)
    Route: /dunya-kupasi/kupadaki-aslanlar/{player:slug}
    Route name: worldcup.aslanlar.show
    ══════════════════════════════════════════════════════════════
--}}

@extends('layouts.worldcup')

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

@section('title', $playerName . ' — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    {{-- PLAYER PROFILE HERO --}}
    <section class="relative overflow-hidden pt-16 pb-20 border-b border-[var(--border-default)]">
        <div class="absolute inset-0 bg-gradient-to-br from-[var(--accent-premium)]/15 via-[var(--surface-base)] to-[#8D1B3D]/10"></div>
        <div class="absolute inset-0 opacity-[0.03]"
             style="background-image: radial-gradient(circle at 2px 2px, var(--accent-premium) 1px, transparent 0); background-size: 32px 32px;">
        </div>

        <div class="wc-container relative">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-12">
                
                {{-- Player Image Placeholder --}}
                <div class="relative group">
                    <div class="w-48 h-64 sm:w-56 sm:h-72 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-2xl relative overflow-hidden backdrop-blur-md">
                         <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                         <span class="text-8xl opacity-10 filter grayscale group-hover:scale-110 transition-transform duration-500">🦁</span>
                         <div class="absolute bottom-6 left-0 right-0 text-center z-20">
                            <span class="text-[var(--accent-premium)] font-black text-3xl tabular-nums shadow-lg">#{{ $shirtNumber }}</span>
                         </div>
                    </div>
                    <div class="absolute -top-3 -right-3 w-12 h-12 bg-[var(--accent-premium)] rounded-xl flex items-center justify-center shadow-lg border border-white/10 rotate-12 group-hover:rotate-0 transition-transform">
                        <span class="text-xl">🏆</span>
                    </div>
                </div>

                {{-- Player Info --}}
                <div class="text-center md:text-left flex-1 pt-4">
                    <div class="inline-flex items-center gap-2 bg-[#D4AF37]/10 border border-[#D4AF37]/20 rounded-lg px-4 py-1.5 mb-6">
                        <span class="text-[#D4AF37] text-[10px] font-black uppercase tracking-widest">Galatasaray {{ $relationType }}</span>
                    </div>

                    <h1 class="text-white font-black text-4xl sm:text-5xl lg:text-6xl tracking-tight leading-none">{{ $playerName }}</h1>
                    <p class="text-[var(--text-secondary)] text-xl mt-3 font-bold">{{ $position }}</p>

                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-6 mt-8">
                        <div class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/[0.03] border border-white/5">
                            <span class="text-2xl">🏳️</span>
                            <span class="text-white font-black text-sm uppercase tracking-tight">{{ $nationality }}</span>
                        </div>
                    </div>

                    {{-- Quick Stats Grid --}}
                    <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-6 max-w-lg">
                        @php
                            $quickStats = [
                                ['value' => '—', 'label' => 'Karşılaşma'],
                                ['value' => '—', 'label' => 'Gol'],
                                ['value' => '—', 'label' => 'Asist'],
                                ['value' => '—', 'label' => 'Dakika'],
                            ];
                        @endphp
                        @foreach ($quickStats as $qs)
                            <div class="text-center md:text-left border-l-2 border-white/5 pl-4 first:border-0 first:pl-0">
                                <div class="text-[var(--accent-premium)] font-black text-2xl tabular-nums leading-none">{{ $qs['value'] }}</div>
                                <div class="text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest mt-2">{{ $qs['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wc-container">
        {{-- DETAILS GRID --}}
        <section class="wc-section">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- GS INFO --}}
                <div class="wc-card wc-card--highlight p-8">
                    <header class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-lg bg-[var(--accent-premium)]/10 flex items-center justify-center text-lg border border-[var(--accent-premium)]/20 shadow-inner">🦁</div>
                        <h3 class="text-white font-black text-lg tracking-tight uppercase">Galatasaray Bilgileri</h3>
                    </header>
                    
                    <div class="grid grid-cols-2 gap-y-8 gap-x-4">
                        @php
                        $gsInfo = [
                            ['label' => 'Forma Numarası', 'value' => $shirtNumber],
                            ['label' => 'İlişki Türü',     'value' => $relationType],
                            ['label' => 'Mevki',           'value' => $position],
                            ['label' => 'Kulüp',           'value' => $clubName ?: 'Galatasaray SK'],
                        ];
                        @endphp
                        @foreach ($gsInfo as $gi)
                            <div>
                                <div class="text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest mb-2">{{ $gi['label'] }}</div>
                                <div class="text-white font-bold text-base">{{ $gi['value'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- NT INFO --}}
                <div class="wc-card p-8 bg-gradient-to-br from-white/[0.03] to-transparent">
                    <header class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-lg border border-white/10 shadow-inner">🏳️</div>
                        <h3 class="text-white font-black text-lg tracking-tight uppercase">Milli Takım</h3>
                    </header>
                    
                    <div class="flex items-center gap-6">
                        <div class="text-6xl drop-shadow-xl filter grayscale opacity-50">🏳️</div>
                        <div>
                            <h4 class="text-white font-black text-2xl tracking-tighter">{{ $nationality }}</h4>
                            <p class="text-[var(--text-secondary)] font-medium mt-1">Milli takım turnuva kadrosu oyuncusu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PERFORMANCE TABLE --}}
        <section class="wc-section pt-0 pb-12">
            @include('worldcup.partials.wc-section-header', [
                'title' => 'Turnuva Performansı',
                'subtitle' => 'Aslanımızın bu kupa boyunca sergilediği tüm veriler.'
            ])

            <div class="wc-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[600px]">
                        <thead>
                            <tr class="border-b border-white/5 bg-white/[0.02] text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest">
                                <th class="text-left py-4 px-6">Karşılaşma</th>
                                <th class="text-center py-4 px-2 w-24">Dakika</th>
                                <th class="text-center py-4 px-2 w-20">Gol</th>
                                <th class="text-center py-4 px-2 w-20">Asist</th>
                                <th class="text-center py-4 px-2 w-20">Kart</th>
                                <th class="text-center py-4 px-2 w-24">Maç Puanı</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $rows = [1, 2, 3]; @endphp
                            @foreach ($rows as $i)
                                <tr class="border-b border-white/5 last:border-0 hover:bg-white/[0.03] transition-colors group">
                                    <td class="py-5 px-6">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-bold text-white group-hover:text-[var(--accent-premium)] transition-colors italic opacity-50">Maç Bekleniyor...</span>
                                        </div>
                                    </td>
                                    <td class="text-center text-[var(--text-muted)] font-black tabular-nums">—</td>
                                    <td class="text-center text-[var(--text-muted)] font-black tabular-nums">—</td>
                                    <td class="text-center text-[var(--text-muted)] font-black tabular-nums">—</td>
                                    <td class="text-center text-[var(--text-muted)] font-black tabular-nums">—</td>
                                    <td class="text-center text-[var(--text-muted)] font-black tabular-nums">—</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-center">
                 <div class="px-6 py-3 rounded-2xl bg-white/[0.02] border border-white/5 text-[10px] font-black text-[var(--text-muted)] uppercase tracking-widest flex items-center gap-3">
                    <span class="text-[var(--accent-premium)] animate-pulse">●</span>
                    Turnuva başladığında veriler otomatik güncellenecektir.
                </div>
            </div>
        </section>

        @if ($relationNote)
            <section class="wc-section pt-0">
                 @include('worldcup.partials.wc-section-header', [
                    'title' => 'Editör Notu',
                    'subtitle' => 'Galatasaray ve oyuncu bağı üzerine ek bilgiler.'
                ])
                <div class="wc-card border-l-4 border-l-[var(--accent-premium)] p-8 italic text-[var(--text-secondary)] font-medium leading-relaxed bg-gradient-to-r from-[var(--accent-premium)]/5 to-transparent">
                    "{{ $relationNote }}"
                </div>
            </section>
        @endif

        {{-- BACK LINK --}}
        <section class="wc-section pt-0 pb-32">
            <div class="flex justify-center">
                <a href="{{ route('worldcup.aslanlar.index') }}"
                   class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-white/5 border border-white/10 text-white text-xs font-black uppercase tracking-widest transition-all hover:bg-[var(--accent-premium)] hover:text-[#101010] hover:border-[var(--accent-premium)] hover:shadow-lg hover:shadow-[var(--accent-premium)]/20 group">
                    <span class="group-hover:-translate-x-1 transition-transform">←</span>
                    Tüm Aslanlar Listesi
                </a>
            </div>
        </section>
    </div>

@endsection

{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — STADYUM DETAY
    Route: /dunya-kupasi/stadyumlar/{stadium:slug}
    Route name: worldcup.stadiums.show
    ══════════════════════════════════════════════════════════════
--}}

@extends('layouts.worldcup')

@php
    $stadium = $stadium ?? null;
    $relatedMatches = $relatedMatches ?? [];
    $activeTournament = $activeTournament ?? null;

    $stadiumName = $stadium?->name ?? 'Stadyum';
    $stadiumCity = $stadium?->city ?? 'Şehir';
    $stadiumCountry = $stadium?->country ?? 'Ülke';
    $stadiumCapacity = $stadium?->capacity;
    if (is_numeric($stadiumCapacity) && (int) $stadiumCapacity <= 0) {
        $stadiumCapacity = null;
    }
    $stadiumImage = data_get($stadium, 'image_url');

    $matchesForGrid = collect($relatedMatches)->take(4);

    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', $stadiumName . ' — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    {{-- STADIUM HERO --}}
    <section class="relative overflow-hidden pt-12 pb-24 border-b border-[var(--border-default)]">
        <div class="absolute inset-0 bg-gradient-to-b from-white/5 via-[var(--surface-base)] to-[var(--surface-base)]"></div>
        <div class="wc-container relative">
             <div class="aspect-[21/9] max-h-96 bg-white/[0.03] rounded-3xl overflow-hidden border border-white/5 flex items-center justify-center relative group">
                @if($stadiumImage)
                    <img src="{{ $stadiumImage }}" alt="{{ $stadiumName }}" class="w-full h-full object-cover">
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-white/[0.02] to-transparent"></div>
                    <span class="text-8xl opacity-10 filter grayscale group-hover:opacity-20 transition-opacity">🏟️</span>
                    <div class="absolute top-6 left-6 px-3 py-1 rounded-full bg-black/50 backdrop-blur-md border border-white/10 text-[9px] font-black uppercase tracking-widest text-[var(--text-muted)]">
                        Görsel hazırlanıyor
                    </div>
                @endif
                <div class="absolute bottom-10 left-10 text-left">
                     <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-black/40 backdrop-blur-md border border-white/10 mb-4">
                        <span class="text-[10px] font-black text-[var(--accent-premium)] uppercase tracking-widest">Resmi Arena</span>
                    </div>
                    <h1 class="text-white font-black text-4xl sm:text-5xl lg:text-6xl drop-shadow-2xl">{{ $stadiumName }}</h1>
                </div>
            </div>
        </div>
    </section>

    {{-- STADIUM INFO CARDS --}}
    <div class="wc-container -mt-12 relative z-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $stadiumInfo = [
                    ['label' => 'Şehir',      'icon' => '📍', 'value' => $stadiumCity],
                    ['label' => 'Ülke',        'icon' => '🏳️', 'value' => $stadiumCountry],
                    ['label' => 'Kapasite',    'icon' => '👥', 'value' => $stadiumCapacity ? number_format($stadiumCapacity, 0, ',', '.') : '—'],
                    ['label' => 'Açılış Yılı', 'icon' => '🏗️', 'value' => '—'],
                ];
            @endphp
            @foreach ($stadiumInfo as $info)
                <div class="wc-card p-6 backdrop-blur-xl bg-[var(--surface-card)]/80">
                    <div class="text-xl mb-3">{{ $info['icon'] }}</div>
                    <div class="text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest mb-1">{{ $info['label'] }}</div>
                    @php
                        $infoValue = $info['value'] ?? null;
                        $isGhost = is_null($infoValue) || $infoValue === '' || $infoValue === '—' || $infoValue === 'Şehir' || $infoValue === 'Ülke';
                    @endphp
                    @if ($isGhost)
                        <div class="wc-ghost-value w-20 h-6 opacity-30"></div>
                    @else
                        <div class="text-white font-black text-lg tabular-nums">{{ $infoValue }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- RELATED MATCHES --}}
    <div class="wc-container">
        <section class="wc-section wc-section--compact">
            @include('worldcup.partials.wc-section-header', [
                'title' => 'Bu Stadyumdaki Maçlar',
                'subtitle' => $stadiumName . ' ev sahipliğinde gerçekleşecek olan tüm karşılaşmalar.'
            ])

            @if ($matchesForGrid->isEmpty())
                @include('worldcup.partials.wc-empty-state', [
                    'title' => 'Henüz maç planlanmadı',
                    'description' => 'Grup kuraları ve turnuva fikstürü kesinleştiğinde bu stadyumda oynanacak maçlar burada listelenecektir.'
                ])
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($matchesForGrid as $match)
                        @include('worldcup.partials.match-card', ['match' => $match])
                    @endforeach
                </div>
            @endif
        </section>

        {{-- LOCATION/HARİTA --}}
        <section class="wc-section pt-0 pb-32">
             @include('worldcup.partials.wc-section-header', [
                'title' => 'Konum & Ulaşım',
                'subtitle' => 'Stadyumun şehir içindeki konumu ve ulaşım rehberi.'
            ])
            @include('worldcup.partials.wc-empty-state', [
                'icon' => '🗺️',
                'title' => 'Konum bilgisi henüz açıklanmadı',
                'description' => 'Harita ve ulaşım detayları resmi olarak paylaşıldığında burada görünecektir.',
                'class' => 'wc-empty-state--compact bg-white/[0.02] border-white/10'
            ])
        </section>
    </div>

@endsection

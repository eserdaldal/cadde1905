{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — MAÇ DETAY
    Route: /dunya-kupasi/maclar/{match}
    Route name: worldcup.matches.show
    Beklenen değişken: $match (ileride controller'dan)
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $match = $match ?? null;
    $homeTeam = $match?->homeTeam ?? null;
    $awayTeam = $match?->awayTeam ?? null;
    $activeTournament = $activeTournament ?? null;

    $homeName = $homeTeam?->name ?? 'Ev Sahibi';
    $awayName = $awayTeam?->name ?? 'Deplasman';

    $roundLabel = $match?->round ?? 'Grup';
    $matchDate = $match?->date_label;

    $stadiumName = $match?->stadium?->name ?? null;
    $stadiumCity = $match?->stadium?->city ?? null;
    $stadiumCapacity = $match?->stadium?->capacity ?? null;

    $scoreHome = $match?->home_score;
    $scoreAway = $match?->away_score;

    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', $homeName . ' vs ' . $awayName . ' — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    {{-- ═══════ Skor Hero ═══════ --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#8D1B3D]/10 via-[#1E1E1C] to-[#1D6F42]/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

            <div class="text-center mb-4">
                <span class="text-xs text-gray-500 uppercase tracking-wider">
                    {{ $roundLabel ?: 'Grup' }}
                </span>
            </div>

            <div class="flex items-center justify-center gap-6 sm:gap-10">
                {{-- Ev sahibi --}}
                <div class="text-center">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-white/10 rounded-full overflow-hidden flex-shrink-0 border-2 border-white/5 mx-auto mb-2">
                        @if ($match->homeTeam->flag_url ?? null)
                            <img src="{{ $match->homeTeam->flag_url }}" alt="{{ $homeName }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl">🏳️</div>
                        @endif
                    </div>
                    <h2 class="text-white font-bold text-lg">{{ $homeName }}</h2>
                </div>

                {{-- Skor --}}
                <div class="flex items-center gap-3 px-6 py-3 bg-white/5 rounded-2xl border border-white/10">
                    <span class="text-white font-black text-4xl sm:text-5xl tabular-nums">{{ $scoreHome ?? '–' }}</span>
                    <span class="text-gray-600 text-xl">:</span>
                    <span class="text-white font-black text-4xl sm:text-5xl tabular-nums">{{ $scoreAway ?? '–' }}</span>
                </div>

                {{-- Deplasman --}}
                <div class="text-center">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-white/10 rounded-full overflow-hidden flex-shrink-0 border-2 border-white/5 mx-auto mb-2">
                        @if ($match->awayTeam->flag_url ?? null)
                            <img src="{{ $match->awayTeam->flag_url }}" alt="{{ $awayName }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl">🏳️</div>
                        @endif
                    </div>
                    <h2 class="text-white font-bold text-lg">{{ $awayName }}</h2>
                </div>
            </div>

            <div class="text-center mt-4 text-sm text-gray-500">
                {{ $matchDate ?? 'Tarih henüz netleşmedi' }}
                @if ($stadiumName)
                    · {{ $stadiumName }}{{ $stadiumCity ? ', ' . $stadiumCity : '' }}
                @else
                    · Stadyum henüz açıklanmadı
                @endif
            </div>
        </div>
    </section>

    {{-- ═══════ Maç Olayları Zaman Çizelgesi ═══════ --}}
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h2 class="text-white font-bold text-xl mb-6">Maç Olayları</h2>
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <p class="text-gray-500 text-sm text-center">
                Maç olayları turnuva başladığında burada görüntülenecektir.
            </p>
        </div>
    </section>

    {{-- ═══════ Maç İstatistikleri ═══════ --}}
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <h2 class="text-white font-bold text-xl mb-6">Maç İstatistikleri</h2>
        <div class="bg-white/5 border border-white/10 rounded-xl p-5 space-y-4">
            @php
                $matchStats = [
                    ['label' => 'Top Hakimiyeti', 'home' => '—%', 'away' => '—%'],
                    ['label' => 'Şut (İsabetli)', 'home' => '—',  'away' => '—'],
                    ['label' => 'Korner',          'home' => '—',  'away' => '—'],
                    ['label' => 'Faul',            'home' => '—',  'away' => '—'],
                    ['label' => 'Ofsayt',          'home' => '—',  'away' => '—'],
                ];
            @endphp
            @foreach ($matchStats as $ms)
                <div class="flex items-center justify-between text-sm">
                    <span class="text-white tabular-nums w-16 text-left">{{ $ms['home'] }}</span>
                    <span class="text-gray-500 text-xs flex-1 text-center">{{ $ms['label'] }}</span>
                    <span class="text-white tabular-nums w-16 text-right">{{ $ms['away'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ═══════ Kadro / İlk 11 ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <h2 class="text-white font-bold text-xl mb-6">Kadrolar</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ([$homeName, $awayName] as $side)
                <div class="bg-white/5 border border-white/10 rounded-xl overflow-hidden">
                    <div class="px-4 py-3 border-b border-white/10 bg-white/[0.03]">
                        <h3 class="text-white font-bold text-sm">{{ $side }}</h3>
                    </div>
                    <div class="p-4 space-y-2">
                        @for ($i = 0; $i < 11; $i++)
                            <div class="flex items-center gap-3 text-sm">
                                <span class="text-gray-500 w-6 text-right tabular-nums">{{ $i + 1 }}</span>
                                <span class="text-white">Oyuncu {{ $i + 1 }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <h2 class="text-white font-bold text-xl mb-6">Stadyum</h2>
        <div class="bg-white/5 border border-white/10 rounded-xl p-5 flex items-center gap-4">
            <span class="text-3xl">🏟️</span>
            <div>
                <h3 class="text-white font-semibold">
                    @if ($stadiumName)
                        {{ $stadiumName }}
                    @else
                        Stadyum henüz açıklanmadı
                    @endif
                </h3>
                <p class="text-gray-500 text-sm">
                    @if ($stadiumCity)
                        {{ $stadiumCity }}
                        @if (!empty($stadiumCapacity))
                            · {{ number_format($stadiumCapacity, 0, ',', '.') }} kişilik
                        @endif
                    @else
                        Konum bilgisi yakında paylaşılacaktır.
                    @endif
                </p>
            </div>
        </div>
    </section>

@endsection

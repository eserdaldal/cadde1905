{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — STADYUM DETAY
    Route: /dunya-kupasi/stadyumlar/{stadium:slug}
    Route name: worldcup.stadiums.show
    Beklenen değişken: $stadium (ileride controller'dan)
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $stadium = $stadium ?? null;
    $relatedMatches = $relatedMatches ?? [];
    $activeTournament = $activeTournament ?? null;

    $stadiumName = $stadium?->name ?? 'Stadyum';
    $stadiumCity = $stadium?->city ?? 'Şehir';
    $stadiumCountry = $stadium?->country ?? 'Ülke';
    $stadiumCapacity = $stadium?->capacity;

    $matchesForGrid = collect($relatedMatches)->take(4);

    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', $stadiumName . ' — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    {{-- ═══════ Hero: Stadyum Görseli + Bilgi ═══════ --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-white/5 via-[#1E1E1C] to-[#1E1E1C]"></div>
        {{-- Görsel placeholder --}}
        <div class="relative aspect-[21/9] max-h-80 bg-white/5 flex items-center justify-center">
            <span class="text-7xl opacity-15">🏟️</span>
        </div>
    </section>

    {{-- ═══════ Stadyum Bilgi Kartı ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10 pb-10">
        <div class="bg-white/5 border border-white/10 rounded-xl p-6 backdrop-blur-sm">
            <h1 class="text-white font-black text-3xl mb-4">{{ $stadiumName }}</h1>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @php
                    $stadiumInfo = [
                        ['label' => 'Şehir',      'value' => $stadiumCity],
                        ['label' => 'Ülke',        'value' => $stadiumCountry],
                        ['label' => 'Kapasite',    'value' => $stadiumCapacity ? number_format($stadiumCapacity, 0, ',', '.') : '—'],
                        ['label' => 'Açılış Yılı', 'value' => '—'],
                    ];
                @endphp
                @foreach ($stadiumInfo as $info)
                    <div>
                        <div class="text-gray-500 text-xs uppercase tracking-wider mb-1">{{ $info['label'] }}</div>
                        <div class="text-white font-semibold text-sm">{{ $info['value'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════ Bu Stadyumdaki Maçlar ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <h2 class="text-white font-bold text-xl mb-6">Bu Stadyumdaki Maçlar</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if ($matchesForGrid->isEmpty())
                @for ($i = 0; $i < 4; $i++)
                    @include('worldcup.partials.match-card')
                @endfor
            @else
                @foreach ($matchesForGrid as $match)
                    @include('worldcup.partials.match-card', ['match' => $match])
                @endforeach
            @endif
        </div>
    </section>

    {{-- ═══════ Konum Placeholder ═══════ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <h2 class="text-white font-bold text-xl mb-6">Konum</h2>
        <div class="bg-white/5 border border-white/10 border-dashed rounded-xl p-12 text-center">
            <span class="text-3xl opacity-30 block mb-3">🗺️</span>
            <p class="text-gray-500 text-sm">
                Harita entegrasyonu ileride eklenecektir.
            </p>
        </div>
    </section>

@endsection

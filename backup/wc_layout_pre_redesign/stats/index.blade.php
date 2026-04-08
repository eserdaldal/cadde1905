{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — İSTATİSTİKLER
    Route: /dunya-kupasi/istatistikler
    Route name: worldcup.stats.index
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', 'İstatistikler — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $summaryStats = $summaryStats ?? [];
        $rankingRows = $rankingRows ?? [];
        $teamStats = $teamStats ?? [];

        if (empty($summaryStats)) {
            $summaryStats = [
                ['label' => 'Toplam Maç', 'value' => '—'],
                ['label' => 'Toplam Gol', 'value' => '—'],
                ['label' => 'Ort. Gol/Maç', 'value' => '—'],
                ['label' => 'Katılımcı Takım', 'value' => '—'],
            ];
        }

        if (empty($teamStats)) {
            $teamStats = [
                ['title' => 'En Çok Gol Atan', 'icon' => '⚽', 'team' => '—', 'value' => '— gol'],
                ['title' => 'En Az Gol Yiyen', 'icon' => '🛡️', 'team' => '—', 'value' => '— gol'],
                ['title' => 'En İyi Averaj', 'icon' => '📈', 'team' => '—', 'value' => '— averaj'],
            ];
        }

        $categories = [
            ['label' => 'Gol Kralı', 'icon' => '⚽', 'active' => true],
            ['label' => 'Asist', 'icon' => '🎯', 'active' => false],
            ['label' => 'Temiz Sayfa', 'icon' => '🧤', 'active' => false],
            ['label' => 'Sarı Kart', 'icon' => '🟨', 'active' => false],
            ['label' => 'Kırmızı Kart', 'icon' => '🟥', 'active' => false],
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
        <h1 class="text-white font-black text-3xl">İstatistikler</h1>
        <p class="text-gray-500 text-sm mt-2">
            {{ $pageTitleWithYear }} — Bireysel ve takım bazlı turnuva istatistikleri
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach ($summaryStats as $ss)
                <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                    <div class="text-white font-black text-2xl">{{ $ss['value'] }}</div>
                    <div class="text-gray-500 text-xs mt-1">{{ $ss['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6">
        <div class="flex flex-wrap items-center gap-2">
            @foreach ($categories as $cat)
                <button class="px-3 py-1.5 rounded-full text-xs font-medium border transition-colors flex items-center gap-1.5
                               {{ $cat['active'] ? 'bg-[#8D1B3D] border-[#8D1B3D] text-white' : 'bg-transparent border-white/10 text-gray-400 hover:text-white hover:border-white/30' }}">
                    <span>{{ $cat['icon'] }}</span>
                    {{ $cat['label'] }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        @if(empty($rankingRows) || count($rankingRows) === 0)
            <div class="text-center text-white/60 py-10">
                No data available
            </div>
        @else
            <div class="bg-white/5 border border-white/10 rounded-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-sm min-w-[500px]">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/[0.03] text-gray-500 text-xs">
                            <th class="text-left py-3 px-4 font-medium w-10">#</th>
                            <th class="text-left py-3 px-2 font-medium">Oyuncu</th>
                            <th class="text-center py-3 px-2 font-medium">Takım</th>
                            <th class="text-center py-3 px-2 font-medium">Maç</th>
                            <th class="text-center py-3 px-2 font-medium">Gol</th>
                            <th class="text-center py-3 px-2 font-medium">Dk/Gol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rankingRows as $row)
                            <tr class="border-b border-white/5 last:border-0 hover:bg-white/[0.03] transition-colors">
                                <td class="py-3 px-4 text-gray-500 text-xs">{{ $row['rank'] }}</td>
                                <td class="py-3 px-2">
                                    <span class="text-white font-medium">{{ $row['name'] }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-lg">{{ $row['flag'] }}</span>
                                </td>
                                <td class="text-center text-gray-400">{{ $row['played'] }}</td>
                                <td class="text-center text-white font-bold">{{ $row['goals'] }}</td>
                                <td class="text-center text-gray-400">{{ $row['ratio'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <p class="text-gray-600 text-xs mt-4 text-center">
            Turnuva başladığında veriler güncellenecektir.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <h2 class="text-white font-bold text-lg mb-4">Takım İstatistikleri</h2>

        @if(empty($teamStats) || count($teamStats) === 0)
            <div class="text-center text-white/60 py-10">
                No data available
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($teamStats as $ts)
                    @include('worldcup.partials.stat-card', [
                        'icon'       => $ts['icon'],
                        'title'      => $ts['title'],
                        'value'      => $ts['team'],
                        'playerName' => $ts['value'],
                    ])
                @endforeach
            </div>
        @endif
    </div>

@endsection

@extends('layouts.worldcup')

@php
    $theme = 'event-light';
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';

    $cleanPageTitle = $pageTitle;
    if ($pageYear && str_contains($pageTitle, (string)$pageYear)) {
        $cleanPageTitle = trim(str_replace((string)$pageYear, '', $pageTitle));
    }

    $pageTitleWithYear = $pageYear ? ($cleanPageTitle . ' ' . $pageYear) : $cleanPageTitle;

    $summaryStats = $summaryStats ?? null;
    $rankingRows = $rankingRows ?? [];
    $teamStats = $teamStats ?? [];

    $hasData = !empty($rankingRows) && count($rankingRows) > 0;

    if (empty($summaryStats)) {
        $summaryStats = [
            ['label' => 'Toplam Maç', 'value' => null],
            ['label' => 'Toplam Gol', 'value' => null],
            ['label' => 'Ort. Gol/Maç', 'value' => null],
            ['label' => 'Katılımcı Takım', 'value' => null],
        ];
    }

    if (empty($teamStats)) {
        $teamStats = [
            ['title' => 'En Çok Gol Atan', 'icon' => '⚽', 'team' => null, 'value' => '— gol'],
            ['title' => 'En Az Gol Yiyen', 'icon' => '🛡️', 'team' => null, 'value' => '— gol'],
            ['title' => 'En İyi Averaj', 'icon' => '📈', 'team' => null, 'value' => '— averaj'],
        ];
    }

    $categories = [
        ['key' => 'goals', 'label' => 'Gol Kralı', 'icon' => '⚽'],
        ['key' => 'assists', 'label' => 'Asist', 'icon' => '🎯'],
        ['key' => 'clean', 'label' => 'Gol Yememe', 'icon' => '🧤'],
        ['key' => 'yellow', 'label' => 'Sarı Kart', 'icon' => '🟨'],
        ['key' => 'red', 'label' => 'Kırmızı Kart', 'icon' => '🟥'],
    ];
    $categoryLabels = collect($categories)->mapWithKeys(fn ($cat) => [$cat['key'] => $cat['label']])->all();
    $defaultCategory = $categories[0]['key'];
@endphp

@section('title', 'İstatistikler — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')
    <div class="wc-container mb-16" x-data="{
        activeCategory: '{{ $defaultCategory }}',
        hasData: {{ $hasData ? 'true' : 'false' }},
        labels: @json($categoryLabels)
    }">
        <section class="wc-section wc-section--compact wc-section--compact-top">

            <header class="wc-page-header">
                <div class="inline-flex items-center gap-2 mb-2 px-3 py-1 rounded-full bg-[var(--wc-table-header-bg)] border border-[var(--wc-table-border)]">
                    <span class="text-[10px] font-black text-[var(--accent-premium)] uppercase tracking-widest">Performans Analizi</span>
                </div>
                <h1 class="wc-page-title">İstatistikler</h1>
                <p class="wc-page-subtitle">{{ $pageTitleWithYear }} turnuvasına ait tüm bireysel ve takım istatistikleri turnuva boyunca eş zamanlı güncellenir.</p>
                <div class="wc-page-divider"></div>
            </header>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-10 px-4 sm:px-0">
                @foreach ($summaryStats as $ss)
                    @php
                        $statValue = $ss['value'] ?? null;
                        $hasStatValue = !(is_null($statValue) || $statValue === '' || $statValue === '—');
                    @endphp
                    <div class="wc-match-card p-6 text-center bg-gradient-to-b from-[var(--wc-table-header-bg)] to-transparent border-[var(--wc-table-border)]">
                        <div class="flex flex-col items-center gap-3">
                            @if($hasStatValue)
                                <div class="text-[var(--text-primary)] font-black text-3xl tabular-nums leading-none tracking-tighter">{{ $statValue }}</div>
                            @else
                                <div class="wc-ghost-value w-20 h-9 opacity-40"></div>
                            @endif
                            <div class="text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest">{{ $ss['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-8 sticky top-[var(--wc-nav-height)] z-20 bg-[var(--surface-base)]/80 backdrop-blur-md py-3 -mx-4 px-4 border-b border-[var(--wc-table-border)]">
                <div class="flex flex-wrap items-center justify-center gap-2">
                    @foreach ($categories as $cat)
                        <button type="button" @click="activeCategory = '{{ $cat['key'] }}'"
                                class="px-5 py-2.5 rounded-full text-[11px] font-black uppercase tracking-widest border transition-all flex items-center gap-3"
                                :class="activeCategory === '{{ $cat['key'] }}'
                                    ? 'bg-[var(--accent-premium)] border-[var(--accent-premium)] text-[#101010] shadow-xl shadow-[var(--accent-premium)]/20 ring-1 ring-[var(--accent-premium)]'
                                    : 'bg-[var(--wc-table-header-bg)] border-[var(--wc-table-border)] text-[var(--text-secondary)] hover:bg-[var(--wc-table-hover)]'">
                            <span :class="activeCategory === '{{ $cat['key'] }}' ? 'opacity-100' : 'opacity-40'">{{ $cat['icon'] }}</span>
                            {{ $cat['label'] }}
                        </button>
                    @endforeach
                </div>
                <div class="mt-4 text-center text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)]">
                    Seçili: <span class="text-[var(--accent-premium)]" x-text="labels[activeCategory]">{{ $categoryLabels[$defaultCategory] }}</span>
                </div>
            </div>

            @if(!$hasData)
                <div class="max-w-4xl mx-auto">
                    @include('worldcup.partials.wc-empty-state', [
                        'icon' => '📊',
                        'title' => 'İstatistikler henüz açıklanmadı',
                        'description' => 'Resmi maç verileri netleştikçe güvenilir istatistikler bu alanda yayınlanacaktır.',
                        'class' => 'wc-empty-state--compact bg-[var(--wc-table-header-bg)] border-[var(--wc-table-border)]'
                    ])
                    <div class="mt-6 text-[11px] font-black uppercase tracking-widest text-center text-[var(--text-muted)]" x-text="labels[activeCategory] + ' verileri turnuva boyunca güncellenecektir.'"></div>
                </div>
            @else
                <div class="wc-match-card overflow-hidden border-[var(--wc-table-border)]">
                    <div class="px-8 py-5 border-b border-[var(--wc-table-border)] bg-[var(--wc-table-header-bg)] flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)]">Kategori</span>
                        <span class="text-[var(--wc-table-text-bold)] font-black" x-text="labels[activeCategory]"></span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm min-w-[600px]">
                            <thead>
                                <tr class="border-b border-[var(--wc-table-border)] bg-[var(--wc-table-header-bg)] text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest">
                                    <th class="text-left py-5 px-8 w-20">#</th>
                                    <th class="text-left py-5 px-3">Oyuncu / Milli Takım</th>
                                    <th class="text-center py-5 px-3 w-32">Maç</th>
                                    <th class="text-center py-5 px-3 w-32">Gol</th>
                                    <th class="text-center py-5 px-3 w-32">Dk/Gol</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[var(--wc-table-border)]">
                                @foreach ($rankingRows as $row)
                                    <tr class="hover:bg-[var(--wc-table-hover)] transition-colors group">
                                        <td class="py-5 px-8">
                                            <span class="text-[var(--text-muted)] font-black tabular-nums text-base">{{ $row['rank'] }}</span>
                                        </td>
                                        <td class="py-5 px-3">
                                            <div class="flex items-center gap-4">
                                                <div class="wc-flag wc-flag--sm">
                                                    @if(isset($row['flag_url']))
                                                        <img src="{{ $row['flag_url'] }}" alt="">
                                                    @else
                                                        <span class="text-base">{{ $row['flag'] ?? '🏳️' }}</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="text-[var(--wc-table-text-bold)] font-bold text-base group-hover:text-[var(--accent-premium)] transition-colors leading-none mb-1">
                                                        {{ $row['name'] }}
                                                    </div>
                                                    <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)]">
                                                        {{ $row['team_name'] ?? 'Milli Takım' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-[var(--text-secondary)] font-black tabular-nums text-base">{{ $row['played'] ?? '—' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-[var(--accent-premium)] font-black tabular-nums text-xl">{{ $row['goals'] ?? '—' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-[var(--text-muted)] font-bold tabular-nums text-sm">{{ $row['ratio'] ?? '—' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="mt-16">
                @include('worldcup.partials.wc-section-header', [
                    'title' => 'Takım Performansları',
                    'subtitle' => 'Turnuva genelinde ülke bazlı dikkat çeken performans verileri.'
                ])

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($teamStats as $ts)
                        <div class="wc-match-card wc-stat-card border-[var(--wc-table-border)] hover:border-[var(--accent-premium)]/30 transition-all overflow-hidden">
                            <div class="flex items-center gap-4 mb-6 pb-4 border-b border-[var(--wc-table-border)] pt-1">
                                <span class="text-3xl">{{ $ts['icon'] }}</span>
                                <h4 class="text-[11px] font-black uppercase tracking-widest text-[var(--text-muted)]">{{ $ts['title'] }}</h4>
                            </div>

                            @php
                                $teamValue = $ts['team'] ?? null;
                                $hasTeamValue = !(is_null($teamValue) || $teamValue === '' || $teamValue === '—');
                            @endphp
                            @if($hasTeamValue)
                                <div class="flex flex-col gap-2">
                                    <div class="wc-stat-team text-2xl font-black text-[var(--wc-table-text-bold)] tracking-tight">{{ $ts['team'] }}</div>
                                    <div class="wc-stat-value text-base font-black text-[var(--accent-premium)] leading-tight">{{ $ts['value'] }}</div>
                                </div>
                            @else
                                <div class="space-y-3">
                                    <div class="wc-ghost-value w-32 h-7 opacity-30"></div>
                                    <div class="wc-ghost-value w-20 h-4 opacity-20 block"></div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
    </div>
@endsection

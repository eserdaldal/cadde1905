@extends('layouts.app')

@section('content')
@php
    $home = [
        'id' => $match['home_id'] ?? 0,
        'name' => $match['home_name'] ?? '-',
        'logo' => $match['home_logo'] ?? '',
        'goals' => $match['home_goals'] ?? null,
        'winner' => (bool) ($match['home_winner'] ?? false),
    ];

    $away = [
        'id' => $match['away_id'] ?? 0,
        'name' => $match['away_name'] ?? '-',
        'logo' => $match['away_logo'] ?? '',
        'goals' => $match['away_goals'] ?? null,
        'winner' => (bool) ($match['away_winner'] ?? false),
    ];

    $leftTeam = $pitch['left_team'] ?? [];
    $rightTeam = $pitch['right_team'] ?? [];

    $leftPlayers = collect($leftTeam['players'] ?? []);
    $rightPlayers = collect($rightTeam['players'] ?? []);

    $leftBench = collect($leftTeam['bench'] ?? []);
    $rightBench = collect($rightTeam['bench'] ?? []);

    $leftRows = $leftPlayers
        ->filter(fn ($player) => ! empty($player['grid_row']))
        ->sortBy([
            ['grid_row', 'asc'],
            ['grid_col', 'asc'],
        ])
        ->groupBy('grid_row');

    $rightRows = $rightPlayers
        ->filter(fn ($player) => ! empty($player['grid_row']))
        ->sortBy([
            ['grid_row', 'asc'],
            ['grid_col', 'asc'],
        ])
        ->groupBy('grid_row');

    $leftPlayerColors = $leftTeam['colors']['player'] ?? [];
    $leftKeeperColors = $leftTeam['colors']['goalkeeper'] ?? [];
    $rightPlayerColors = $rightTeam['colors']['player'] ?? [];
    $rightKeeperColors = $rightTeam['colors']['goalkeeper'] ?? [];

    $teamColorResolver = function (array $player, array $playerColors, array $keeperColors): array {
        $isKeeper = ($player['role'] ?? '') === 'goalkeeper' || ($player['pos'] ?? '') === 'G';
        $palette = $isKeeper ? $keeperColors : $playerColors;

        return [
            'bg' => $palette['primary'] ?? '#2a2f3a',
            'fg' => $palette['number'] ?? '#ffffff',
            'border' => $palette['border'] ?? ($palette['primary'] ?? '#2a2f3a'),
        ];
    };

    $statusLongMap = [
        'Time to be defined' => 'Saat Belirsiz',
        'Not Started' => 'Başlamadı',
        'First Half' => 'İlk Yarı',
        'Halftime' => 'Devre Arası',
        'Second Half' => 'İkinci Yarı',
        'Extra Time' => 'Uzatmalar',
        'Penalty In Progress' => 'Penaltılar',
        'Match Finished' => 'Maç Bitti',
        'Match Finished After Extra Time' => 'Uzatmalar Sonrası Bitti',
        'Match Finished After Penalty' => 'Penaltılarla Bitti',
        'Match Postponed' => 'Ertelendi',
        'Match Cancelled' => 'İptal Edildi',
        'Match Abandoned' => 'Yarıda Kaldı',
        'Technical loss' => 'Hükmen Yenilgi'
    ];

    $statMap = [
        'Shots on Goal' => 'İsabetli Şut',
        'Shots off Goal' => 'İsabetsiz Şut',
        'Total Shots' => 'Toplam Şut',
        'Blocked Shots' => 'Engellenen Şut',
        'Shots insidebox' => 'Ceza Sahası İçi Şut',
        'Shots outsidebox' => 'Ceza Sahası Dışı Şut',
        'Fouls' => 'Faul',
        'Corner Kicks' => 'Korner',
        'Offsides' => 'Ofsayt',
        'Ball Possession' => 'Topla Oynama',
        'Yellow Cards' => 'Sarı Kart',
        'Red Cards' => 'Kırmızı Kart',
        'Goalkeeper Saves' => 'Kurtarış',
        'Total passes' => 'Toplam Pas',
        'Passes accurate' => 'İsabetli Pas',
        'Passes %' => 'Pas İsabeti',
        'expected_goals' => 'Gol Beklentisi (xG)',
        'goals_prevented' => 'Önlenen Gol'
    ];

    $eventMap = [
        'Goal' => 'Gol',
        'goal' => 'Gol',
        'Yellow Card' => 'Sarı Kart',
        'Red Card' => 'Kırmızı Kart',
        'Card' => 'Kart',
        'card' => 'Kart',
        'subst' => 'Oyuncu Değişikliği',
        'Substitution' => 'Oyuncu Değişikliği',
        'Var' => 'VAR Kararı'
    ];

    $detailMap = [
        'Yellow Card' => 'Sarı Kart',
        'Red Card' => 'Kırmızı Kart',
        'Normal Goal' => 'Normal Gol',
        'Penalty' => 'Penaltı',
        'Own Goal' => 'Kendi Kalesine Gol',
        'Substitution 1' => 'Giren / Çıkan',
        'Substitution 2' => 'Giren / Çıkan',
        'Substitution 3' => 'Giren / Çıkan',
        'Substitution 4' => 'Giren / Çıkan',
        'Substitution 5' => 'Giren / Çıkan',
        'Substitution' => 'Giren / Çıkan',
    ];

    $getSubStatus = function($playerName, $isHtml = true) use ($events) {
        if (empty($playerName) || empty($events)) return '';
        $out = [];
        foreach ($events as $e) {
            if (in_array(strtolower($e['type'] ?? ''), ['subst', 'substitution'])) {
                $evOut = (string)($e['player_name'] ?? '');
                $evIn = (string)($e['assist_name'] ?? '');
                
                $matchOut = ($evOut === $playerName || (strlen($evOut) > 3 && str_contains($playerName, $evOut)) || (strlen($playerName) > 3 && str_contains($evOut, $playerName)));
                $matchIn = ($evIn === $playerName || (strlen($evIn) > 3 && str_contains($playerName, $evIn)) || (strlen($playerName) > 3 && str_contains($evIn, $playerName)));

                if ($matchOut) {
                    $out[] = $isHtml ? "<span style=\"color:#ef4444; font-weight:900; margin-left:4px;\">↓{$e['minute']}'</span>" : "↓{$e['minute']}'";
                }
                if ($matchIn) {
                    $out[] = $isHtml ? "<span style=\"color:#10b981; font-weight:900; margin-left:4px;\">↑{$e['minute']}'</span>" : "↑{$e['minute']}'";
                }
            }
        }
        return !empty($out) ? implode(' ', $out) : '';
    };

    $hasSubBadge = function($playerName) use ($events) {
        if (empty($playerName) || empty($events)) return false;
        foreach ($events as $e) {
            if (in_array(strtolower($e['type'] ?? ''), ['subst', 'substitution'])) {
                $evOut = (string)($e['player_name'] ?? '');
                $evIn = (string)($e['assist_name'] ?? '');
                
                if ($evOut === $playerName || (strlen($evOut) > 3 && str_contains($playerName, $evOut)) || (strlen($playerName) > 3 && str_contains($evOut, $playerName))) {
                    return true;
                }
                if ($evIn === $playerName || (strlen($evIn) > 3 && str_contains($playerName, $evIn)) || (strlen($playerName) > 3 && str_contains($evIn, $playerName))) {
                    return true;
                }
            }
        }
        return false;
    };

    $statComparison = [];
    if (!empty($statistics)) {
        $homeStats = $statistics[0]['items'] ?? [];
        $awayStats = $statistics[1]['items'] ?? [];
        
        foreach ($homeStats as $item) {
            $key = $item['type'] ?? '';
            $statComparison[$key] = [
                'home' => $item['value'] ?? '-',
                'away' => '-',
                'label' => $statMap[$key] ?? $key
            ];
        }
        foreach ($awayStats as $item) {
            $key = $item['type'] ?? '';
            if (!isset($statComparison[$key])) {
                $statComparison[$key] = [
                    'home' => '-',
                    'away' => $item['value'] ?? '-',
                    'label' => $statMap[$key] ?? $key
                ];
            } else {
                $statComparison[$key]['away'] = $item['value'] ?? '-';
            }
        }
    }

    $scoreLabel = $match['score'] ?? (($home['goals'] ?? '-') . ' - ' . ($away['goals'] ?? '-'));
    
    // Yardımcı: İngilizce status'ü türkçeye çevir
    $rawStatus = $match['status_long'] ?? 'Bilinmiyor';
    $mappedStatus = $statusLongMap[$rawStatus] ?? $rawStatus;
@endphp

<div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 match-center-page mc-wrap mc-detail-page">
    @if(!$found)
        <section class="mc-hero-card mc-detail-empty">
            <p class="mc-hero-kicker">Maç Merkezi</p>
            <h1 class="mc-hero-title">Maç bulunamadı</h1>
            <p class="mc-hero-desc mc-hero-desc-muted mc-hero-desc-limit">
                İstenen fixture kaydı mevcut değil veya API detail yanıtı alınamadı.
            </p>
            <div class="mc-detail-actions">
                <a href="{{ route('match.show') }}" class="mc-detail-link">Maç Merkezine Dön</a>
            </div>
        </section>
    @else
        <div class="mc-stack">

            <section class="mc-hero-card mc-detail-hero mc-detail-hero--compact">
                <div class="mc-detail-topbar">
                    <a href="{{ route('match.show') }}" class="mc-detail-link mc-detail-link--ghost">← Maç Merkezi</a>
                </div>

                <div class="mc-detail-scoreboard mc-detail-scoreboard--compact">
                    <div class="mc-detail-team-chip {{ $home['winner'] ? 'is-winner' : '' }}">
                        @if(!empty($home['logo']))
                            <div class="mc-detail-team-chip__logo">
                                <img src="{{ $home['logo'] }}" alt="{{ $home['name'] }}" loading="lazy" class="mc-team-logo">
                            </div>
                        @endif
                        <div class="mc-detail-team-chip__body">
                            <div class="mc-detail-team-chip__name">{{ $home['name'] }}</div>
                            <div class="mc-detail-team-chip__meta">Ev Sahibi</div>
                        </div>
                    </div>

                    <div class="mc-middle mc-detail-middle mc-detail-middle--compact">
                        @if(!empty($match['league_name']))
                            <div style="font-size: 0.85rem; font-weight: 800; color: var(--text-muted); margin-bottom: 6px;">{{ mb_strtoupper($match['league_name'], 'UTF-8') }}</div>
                        @else
                            <div style="font-size: 0.85rem; font-weight: 800; color: var(--text-muted); margin-bottom: 6px;">SÜPER LİG</div>
                        @endif
                        <span class="mc-status-pill {{ !empty($match['is_live']) ? 'mc-status-live' : 'mc-status-upcoming' }}">
                            {{ mb_strtoupper($mappedStatus, 'UTF-8') }}
                        </span>
                        <div class="mc-detail-score">{{ $scoreLabel ?? 'VS' }}</div>
                        <div class="mc-detail-meta-inline">
                            <span>{{ $match['match_datetime'] ?? '-' }}</span>
                            @if(!empty($match['venue_name']))
                                <span>· {{ $match['venue_name'] }}</span>
                            @endif
                            @if(!empty($match['referee']))
                                <span>· Hakem: {{ $match['referee'] }}</span>
                            @endif
                        </div>
                        @if(!empty($match['status_short']))
                            @php 
                                $sMap = ['FT'=>'MS', 'HT'=>'İY', 'NS'=>'BAŞLAMADI', 'TBD'=>'BELİRSİZ', '1H'=>'1Y', '2H'=>'2Y'];
                            @endphp
                            <div class="mc-detail-status-short">{{ $sMap[$match['status_short']] ?? $match['status_short'] }}</div>
                        @endif
                    </div>

                    <div class="mc-detail-team-chip mc-detail-team-chip--away {{ $away['winner'] ? 'is-winner' : '' }}">
                        <div class="mc-detail-team-chip__body">
                            <div class="mc-detail-team-chip__name">{{ $away['name'] }}</div>
                            <div class="mc-detail-team-chip__meta">Deplasman</div>
                        </div>
                        @if(!empty($away['logo']))
                            <div class="mc-detail-team-chip__logo mc-detail-team-chip__logo--away">
                                <img src="{{ $away['logo'] }}" alt="{{ $away['name'] }}" loading="lazy" class="mc-team-logo">
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="mc-list-card mc-pitch-card">
                <div class="mc-list-body">
                    @if(!empty($leftTeam) && !empty($rightTeam))
                        <div class="mc-pitch-meta">
                            <div class="mc-pitch-team-meta mc-pitch-team-meta--left">
                                @if(!empty($leftTeam['team_logo']))
                                    <img src="{{ $leftTeam['team_logo'] }}" alt="{{ $leftTeam['team_name'] }}" class="mc-pitch-team-logo" loading="lazy">
                                @endif
                                <div>
                                    <div class="mc-pitch-team-name">{{ $leftTeam['team_name'] ?? '-' }}</div>
                                    <div class="mc-pitch-team-sub">
                                        {{ $leftTeam['formation'] ?? '-' }}
                                        @if(!empty($leftTeam['coach']['name']))
                                            · {{ $leftTeam['coach']['name'] }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mc-pitch-team-meta mc-pitch-team-meta--right">
                                <div>
                                    <div class="mc-pitch-team-name">{{ $rightTeam['team_name'] ?? '-' }}</div>
                                    <div class="mc-pitch-team-sub">
                                        {{ $rightTeam['formation'] ?? '-' }}
                                        @if(!empty($rightTeam['coach']['name']))
                                            · {{ $rightTeam['coach']['name'] }}
                                        @endif
                                    </div>
                                </div>
                                @if(!empty($rightTeam['team_logo']))
                                    <img src="{{ $rightTeam['team_logo'] }}" alt="{{ $rightTeam['team_name'] }}" class="mc-pitch-team-logo" loading="lazy">
                                @endif
                            </div>
                        </div>

                        <div class="mc-pitch-board-wrap">
                            <div class="mc-pitch-board" aria-label="Desktop yatay çift takım saha">
                                @for($lane = 1; $lane <= 5; $lane++)
                                    <div class="mc-pitch-lane">
                                        @foreach(($leftRows->get($lane) ?? collect()) as $player)
                                            @php
                                                $palette = $teamColorResolver($player, $leftPlayerColors, $leftKeeperColors);
                                            @endphp
                                            <div
                                                class="mc-pitch-node {{ ($player['role'] ?? '') === 'goalkeeper' ? 'is-goalkeeper' : '' }}"
                                                data-name="{{ $player['name'] ?? 'Bilinmiyor' }} {{ $getSubStatus($player['name'] ?? '', false) }}"
                                                style="--mc-node-bg: {{ $palette['bg'] }}; --mc-node-fg: {{ $palette['fg'] }}; --mc-node-border: {{ $palette['border'] }};"
                                            >
                                                {{ $player['number'] ?? '?' }}
                                                @if($hasSubBadge($player['name'] ?? ''))
                                                    <div class="mc-sub-badge">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 4l3 3-3 3M21 7H8a4 4 0 0 0-4 4v1"></path>
                                                            <path d="M6 20l-3-3 3-3M3 17h13a4 4 0 0 0 4-4v-1"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endfor

                                <div class="mc-pitch-divider">
                                    <div class="mc-pitch-circle"></div>
                                </div>

                                @for($lane = 5; $lane >= 1; $lane--)
                                    <div class="mc-pitch-lane">
                                        @foreach(($rightRows->get($lane) ?? collect()) as $player)
                                            @php
                                                $palette = $teamColorResolver($player, $rightPlayerColors, $rightKeeperColors);
                                            @endphp
                                            <div
                                                class="mc-pitch-node {{ ($player['role'] ?? '') === 'goalkeeper' ? 'is-goalkeeper' : '' }}"
                                                data-name="{{ $player['name'] ?? 'Bilinmiyor' }} {{ $getSubStatus($player['name'] ?? '', false) }}"
                                                style="--mc-node-bg: {{ $palette['bg'] }}; --mc-node-fg: {{ $palette['fg'] }}; --mc-node-border: {{ $palette['border'] }};"
                                            >
                                                {{ $player['number'] ?? '?' }}
                                                @if($hasSubBadge($player['name'] ?? ''))
                                                    <div class="mc-sub-badge">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 4l3 3-3 3M21 7H8a4 4 0 0 0-4 4v1"></path>
                                                            <path d="M6 20l-3-3 3-3M3 17h13a4 4 0 0 0 4-4v-1"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="mc-pitch-mobile">
                            <div class="mc-pitch-mobile-stack">
                                <article class="mc-detail-lineup-card">
                                    <div class="mc-detail-lineup-head">
                                        <div class="mc-detail-lineup-team">{{ $leftTeam['team_name'] ?? '-' }}</div>
                                        <div class="mc-detail-lineup-badge">{{ $leftTeam['formation'] ?? '-' }}</div>
                                    </div>

                                    @for($lane = 1; $lane <= 5; $lane++)
                                        @php $rowPlayers = $leftRows->get($lane) ?? collect(); @endphp
                                        @if($rowPlayers->count() > 0)
                                            <div class="mc-pitch-mobile-row">
                                                @foreach($rowPlayers as $player)
                                                    @php $palette = $teamColorResolver($player, $leftPlayerColors, $leftKeeperColors); @endphp
                                                    <span
                                                        class="mc-pitch-mobile-node"
                                                        style="--mc-node-bg: {{ $palette['bg'] }}; --mc-node-fg: {{ $palette['fg'] }}; --mc-node-border: {{ $palette['border'] }};"
                                                        data-name="{{ $player['name'] ?? 'Bilinmiyor' }} {{ $getSubStatus($player['name'] ?? '', false) }}"
                                                    >
                                                        {{ $player['number'] ?? '?' }}
                                                        @if($hasSubBadge($player['name'] ?? ''))
                                                            <div class="mc-sub-badge">
                                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 4l3 3-3 3M21 7H8a4 4 0 0 0-4 4v1"></path><path d="M6 20l-3-3 3-3M3 17h13a4 4 0 0 0 4-4v-1"></path></svg>
                                                            </div>
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endfor
                                </article>

                                <article class="mc-detail-lineup-card">
                                    <div class="mc-detail-lineup-head">
                                        <div class="mc-detail-lineup-team">{{ $rightTeam['team_name'] ?? '-' }}</div>
                                        <div class="mc-detail-lineup-badge">{{ $rightTeam['formation'] ?? '-' }}</div>
                                    </div>

                                    @for($lane = 1; $lane <= 5; $lane++)
                                        @php $rowPlayers = $rightRows->get($lane) ?? collect(); @endphp
                                        @if($rowPlayers->count() > 0)
                                            <div class="mc-pitch-mobile-row">
                                                @foreach($rowPlayers as $player)
                                                    @php $palette = $teamColorResolver($player, $rightPlayerColors, $rightKeeperColors); @endphp
                                                    <span
                                                        class="mc-pitch-mobile-node"
                                                        style="--mc-node-bg: {{ $palette['bg'] }}; --mc-node-fg: {{ $palette['fg'] }}; --mc-node-border: {{ $palette['border'] }};"
                                                        data-name="{{ $player['name'] ?? 'Bilinmiyor' }} {{ $getSubStatus($player['name'] ?? '', false) }}"
                                                    >
                                                        {{ $player['number'] ?? '?' }}
                                                        @if($hasSubBadge($player['name'] ?? ''))
                                                            <div class="mc-sub-badge">
                                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 4l3 3-3 3M21 7H8a4 4 0 0 0-4 4v1"></path><path d="M6 20l-3-3 3-3M3 17h13a4 4 0 0 0 4-4v-1"></path></svg>
                                                            </div>
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endfor
                                </article>
                            </div>
                        </div>
                    @else
                        <p class="mc-empty">Bu maç için ilk 11 verisi henüz hazır değil.</p>
                    @endif
                </div>
            </section>

            <div class="mc-split mc-detail-split">
                <section class="mc-list-card">
                    <div class="mc-list-head mc-last-head">
                        <span class="mc-dot-pill mc-dot-last"></span>
                        <h2 class="mc-list-title">Yedekler</h2>
                    </div>

                    <div class="mc-list-body">
                        <div class="mc-detail-lineup-grid" style="grid-template-columns: 1fr; gap: 32px;">
                            <article class="mc-detail-lineup-card">
                                <div class="mc-detail-lineup-head">
                                    <div class="mc-detail-lineup-team">{{ $leftTeam['team_name'] ?? '-' }}</div>
                                </div>

                                @if($leftBench->count() > 0)
                                    <ul class="mc-detail-player-list">
                                        @foreach($leftBench as $player)
                                            <li>{{ $player['number'] ?? '?' }} · {{ $player['name'] ?? '-' }} {!! $getSubStatus($player['name'] ?? '', true) !!}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="mc-empty">Yedek verisi yok.</p>
                                @endif
                            </article>

                            <article class="mc-detail-lineup-card">
                                <div class="mc-detail-lineup-head">
                                    <div class="mc-detail-lineup-team">{{ $rightTeam['team_name'] ?? '-' }}</div>
                                </div>

                                @if($rightBench->count() > 0)
                                    <ul class="mc-detail-player-list">
                                        @foreach($rightBench as $player)
                                            <li>{{ $player['number'] ?? '?' }} · {{ $player['name'] ?? '-' }} {!! $getSubStatus($player['name'] ?? '', true) !!}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="mc-empty">Yedek verisi yok.</p>
                                @endif
                            </article>
                        </div>
                    </div>
                </section>

                <section class="mc-list-card">
                    <div class="mc-list-head mc-upcoming-head">
                        <span class="mc-dot-pill mc-dot-upcoming"></span>
                        <h2 class="mc-list-title">Maç Olayları</h2>
                    </div>

                    <div class="mc-list-body">
                        @if(!empty($events))
                            <div class="mc-detail-event-stack">
                                @foreach($events as $event)
                                    @php
                                        $evType = $eventMap[$event['type'] ?? ''] ?? ucfirst($event['type'] ?? 'Olay');
                                        $evDetail = $detailMap[$event['detail'] ?? ''] ?? $event['detail'] ?? '';
                                    @endphp
                                    <div class="mc-detail-event-item">
                                        <div class="mc-detail-event-minute">
                                            {{ $event['minute'] ?? '-' }}'
                                        </div>
                                        <div class="mc-detail-event-body">
                                            <div class="mc-detail-event-title">
                                                @if(in_array(strtolower($event['type'] ?? ''), ['subst', 'substitution']))
                                                    Oyuncu Değişikliği
                                                @else
                                                    {{ $evDetail ?: $evType }} <span style="opacity:0.6; font-size:0.8em; font-weight:600;">{{ $evDetail ? "($evType)" : '' }}</span>
                                                @endif
                                            </div>
                                            <div class="mc-detail-event-meta">
                                                {{ $event['team_name'] ?? '-' }} · {{ $event['player_name'] ?? '-' }}
                                                @if(!empty($event['assist_name'])) · {{ in_array(strtolower($event['type'] ?? ''), ['subst', 'substitution']) ? 'Giren:' : 'Asist:' }} {{ $event['assist_name'] }} @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mc-empty">Bu maç için olay verisi mevcut değil.</p>
                        @endif
                    </div>
                </section>
            </div>

            <section class="mc-list-card mc-stats-card" style="margin-top: 28px;">
                <div class="mc-list-head mc-last-head">
                    <span class="mc-dot-pill mc-dot-last"></span>
                    <h2 class="mc-list-title">Karşılıklı İstatistikler</h2>
                </div>

                <div class="mc-list-body">
                    @if(!empty($statComparison))
                        <div class="mc-stat-comparison-wrap">
                            <div class="mc-stat-teams-head">
                                <div class="mc-stat-team-name left">{{ $leftTeam['team_name'] ?? $home['name'] }}</div>
                                <div class="mc-stat-team-name right" style="text-align: right;">{{ $rightTeam['team_name'] ?? $away['name'] }}</div>
                            </div>
                            
                            <div class="mc-stat-comparison-list">
                                @foreach($statComparison as $key => $data)
                                    <div class="mc-stat-row">
                                        <div class="mc-stat-val mc-stat-val-home">{{ $data['home'] }}</div>
                                        <div class="mc-stat-label">{{ $data['label'] }}</div>
                                        <div class="mc-stat-val mc-stat-val-away">{{ $data['away'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="mc-empty">Bu maç için istatistik verisi mevcut değil.</p>
                    @endif
                </div>
            </section>
        </div>
    @endif
</div>
@endsection

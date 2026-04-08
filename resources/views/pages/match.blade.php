@extends('layouts.app')

@section('content')
<div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 match-center-page mc-wrap">
    <div class="mc-stack">

        {{-- Sayfa Başlığı Kartı --}}
        <section class="mc-hero-card">
            <p class="mc-hero-kicker">
                Yaklaşan Maç
            </p>
            <h1 class="mc-hero-title">
                {{ $pageTitle ?? 'Maç Merkezi' }}
            </h1>
            @if (($status ?? 'empty') === 'ok' && !empty($match))
                <p class="mc-hero-desc mc-hero-desc-muted mc-hero-desc-limit">
                    Galatasaray'ın sıradaki karşılaşması, yaklaşan fikstür ve son sonuçlar.
                </p>
            @elseif (($status ?? 'empty') === 'error')
                <p class="mc-hero-desc mc-hero-desc-error">
                    Maç verisi şu anda alınamadı.
                </p>
            @else
                <p class="mc-hero-desc mc-hero-desc-muted">
                    Sıradaki maç verisi henüz bulunamadı.
                </p>
            @endif
        </section>

        @if (($status ?? 'empty') === 'ok' && !empty($match))
            {{-- Ana Maç Kartı --}}
            <section class="mc-match-card">

                {{-- Üst Bilgi Çubuğu --}}
                <div class="mc-top-bar">
                    <div class="mc-top-row">
                        <span class="mc-league-pill">
                            {{ $match['league_name'] ?? 'Organizasyon' }}
                        </span>
                        <span class="mc-dot">•</span>
                        <span class="mc-meta">{{ $match['match_datetime'] ?? '-' }}</span>
                        @if(!empty($match['venue_name']))
                            <span class="mc-dot">•</span>
                            <span class="mc-meta">{{ $match['venue_name'] }}@if(!empty($match['venue_city'])), {{ $match['venue_city'] }}@endif</span>
                        @endif
                    </div>
                </div>

                {{-- Takım Alanı --}}
                <div class="mc-body">
                    <div class="mc-grid">

                        {{-- Ev Sahibi --}}
                        <div class="mc-team-col">
                            @if(!empty($match['home_logo']))
                                <div class="mc-team-logo-wrap">
                                    <img src="{{ $match['home_logo'] }}" alt="{{ $match['home_name'] ?? 'Ev sahibi' }}" loading="lazy" class="mc-team-logo">
                                </div>
                            @endif
                            <div>
                                <div class="mc-team-name">{{ $match['home_name'] ?? '-' }}</div>
                                <div class="mc-team-label">Ev Sahibi</div>
                            </div>
                        </div>

                        {{-- Orta --}}
                        <div class="mc-middle">
                            <div class="mc-vs-circle">VS</div>
                            <div class="mc-middle-meta">{{ $match['match_datetime'] ?? '-' }}</div>
                            @if(!empty($match['is_live']))
                                <span class="mc-status-pill mc-status-live">Canlı</span>
                            @else
                                <span class="mc-status-pill mc-status-upcoming">{{ $match['status_long'] ?? 'Planlandı' }}</span>
                            @endif
                        </div>

                        {{-- Deplasman --}}
                        <div class="mc-team-col">
                            @if(!empty($match['away_logo']))
                                <div class="mc-team-logo-wrap mc-team-logo-wrap-light">
                                    <img src="{{ $match['away_logo'] }}" alt="{{ $match['away_name'] ?? 'Deplasman' }}" loading="lazy" class="mc-team-logo">
                                </div>
                            @endif
                            <div>
                                <div class="mc-team-name">{{ $match['away_name'] ?? '-' }}</div>
                                <div class="mc-team-label">Deplasman</div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Detay Şeridi --}}
                <div class="mc-detail-bar">
                    <div>
                        <div class="mc-detail-label">Organizasyon</div>
                        <div class="mc-detail-value">{{ $match['league_name'] ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="mc-detail-label">Tarih / Saat</div>
                        <div class="mc-detail-value">{{ $match['match_datetime'] ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="mc-detail-label">Stadyum</div>
                        <div class="mc-detail-value">
                            {{ $match['venue_name'] ?? '-' }}@if(!empty($match['venue_city'])) <span class="mc-detail-muted">, {{ $match['venue_city'] }}</span>@endif
                        </div>
                    </div>
                </div>

            </section>
        @endif

        {{-- Yaklaşan + Son yan yana --}}
        <div class="mc-split">

            {{-- Yaklaşan Karşılaşmalar --}}
            <section class="mc-list-card">
                <div class="mc-list-head mc-upcoming-head">
                    <span class="mc-dot-pill mc-dot-upcoming"></span>
                    <h2 class="mc-list-title">Yaklaşan Karşılaşmalar</h2>
                </div>
                <div class="mc-list-body">
                    @if(!empty($upcoming) && is_array($upcoming))
                        @foreach($upcoming as $item)
                            <article class="mc-upcoming-item">
                                <div class="mc-upcoming-row">
                                    <div class="mc-flex-fill">
                                        <div class="mc-upcoming-league">
                                            {{ $item['league_name'] ?? '-' }}
                                        </div>
                                        <div class="mc-match-line">
                                            {{ $item['home_name'] ?? '-' }}
                                            <span class="mc-vs-muted"> vs </span>
                                            {{ $item['away_name'] ?? '-' }}
                                        </div>
                                        @if(!empty($item['venue_name']))
                                            <div class="mc-upcoming-venue">{{ $item['venue_name'] }}</div>
                                        @endif
                                    </div>
                                    <div class="mc-upcoming-time">
                                        {{ $item['match_datetime'] ?? '-' }}
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p class="mc-empty">Yaklaşan maç listesi bulunamadı.</p>
                    @endif
                </div>
            </section>

            {{-- Son Karşılaşmalar --}}
            <section class="mc-list-card">
                <div class="mc-list-head mc-last-head">
                    <span class="mc-dot-pill mc-dot-last"></span>
                    <h2 class="mc-list-title">Son Karşılaşmalar</h2>
                </div>
                <div class="mc-list-body">
                    @if(!empty($last_matches) && is_array($last_matches))
                        @foreach($last_matches as $item)
                            <article class="mc-last-item">
                                <div class="mc-last-row">
                                    <div class="mc-flex-fill">
                                        <div class="mc-last-meta">
                                            {{ $item['match_datetime'] ?? '-' }}@if(!empty($item['league_name'])) <span class="mc-meta-sep">•</span>{{ $item['league_name'] }}@endif
                                        </div>
                                        <div class="mc-match-line">
                                            {{ $item['home_name'] ?? '-' }}
                                            <span class="mc-vs-muted"> vs </span>
                                            {{ $item['away_name'] ?? '-' }}
                                        </div>
                                    </div>
                                    <div class="mc-score-wrap">
                                        <div class="mc-score">{{ $item['score'] ?? '-' }}</div>
                                        @if(($item['result'] ?? null) === 'win')
                                            <span class="mc-result-pill mc-result-win">G</span>
                                        @elseif(($item['result'] ?? null) === 'loss')
                                            <span class="mc-result-pill mc-result-loss">M</span>
                                        @elseif(($item['result'] ?? null) === 'draw')
                                            <span class="mc-result-pill mc-result-draw">B</span>
                                        @else
                                            <span class="mc-result-pill mc-result-neutral">-</span>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p class="mc-empty">Son maç verisi bulunamadı.</p>
                    @endif
                </div>
            </section>

        </div>
    </div>
</div>
@endsection

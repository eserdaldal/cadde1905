<div class="widget widget-next-match">
    <div class="wid-hd">
        <span class="wid-title">{{ $title }}</span>
    </div>

    @if (in_array($status, ['ok', 'live'], true))
        <div class="match-body">
            <div class="nm-center">
                <div class="nm-league">
                    {{ $data['league_name'] ?? '' }}
                </div>

                <div class="nm-datetime">
                    <div>{{ $data['match_datetime'] ?? '' }}</div>
                    @if (!empty($data['venue_name']))
                        <div>{{ $data['venue_name'] }}</div>
                    @endif
                </div>

                <div class="nm-teams">
                    <div class="nm-team">
                        @if (!empty($data['home_logo']))
                            <img
                                src="{{ $data['home_logo'] }}"
                                alt="{{ $data['home_name'] ?? 'Ev sahibi' }}"
                                class="nm-team-logo"
                                loading="lazy"
                            >
                        @else
                            <span class="tbadge">{{ mb_substr($data['home_name'] ?? 'EV', 0, 2) }}</span>
                        @endif

                        <div class="nm-team-name">
                            {{ $data['home_name'] ?? '' }}
                        </div>
                    </div>

                    <div class="nm-vs">
                        <div class="nm-vs-text">
                            vs
                        </div>
                    </div>

                    <div class="nm-team">
                        @if (!empty($data['away_logo']))
                            <img
                                src="{{ $data['away_logo'] }}"
                                alt="{{ $data['away_name'] ?? 'Deplasman' }}"
                                class="nm-team-logo"
                                loading="lazy"
                            >
                        @else
                            <span class="tbadge">{{ mb_substr($data['away_name'] ?? 'DP', 0, 2) }}</span>
                        @endif

                        <div class="nm-team-name">
                            {{ $data['away_name'] ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="nm-link-wrap">
                    <a href="{{ route('match.show') }}" class="text-xs text-gray-400 hover:text-[var(--red)] transition">
    Maç detayları →
</a>
                </div>
            </div>
        </div>
    @elseif ($status === 'empty')
        <div class="match-body">
            {{ $props['message'] ?? 'Veri yok.' }}
        </div>
    @else
        <div class="match-body">
            {{ $props['message'] ?? 'Veri geçici olarak alınamadı.' }}
        </div>
    @endif
</div>

<div class="widget widget-league-table">
    <div class="wid-hd">
        <span class="wid-title">{{ $title }}</span>
    </div>

    @if (in_array($status, ['ok', 'live'], true) && !empty($data['rows'] ?? []))
        <div class="std-hd">
            <span>#</span>
            <span></span>
            <span>Takım</span>
            <span>O</span>
            <span>P</span>
        </div>

        @foreach (($data['rows'] ?? []) as $row)
            <div
                class="std-row {{ !empty($row['is_galatasaray']) ? 'std-row--gs' : '' }}"
            >
                <span class="rank-cell {{ !empty($row['is_galatasaray']) ? 'text-[var(--yellow)]' : '' }}">
                    {{ $row['rank'] ?? '—' }}
                </span>

                <span class="logo-cell">
                    @if (!empty($row['team_logo']))
                        <img
                            src="{{ $row['team_logo'] }}"
                            alt="{{ $row['team_name'] ?? '' }}"
                            class="team-mini-logo"
                            loading="lazy"
                        >
                    @else
                        <span class="tbadge">{{ mb_substr($row['team_name'] ?? '', 0, 2) }}</span>
                    @endif
                </span>

                <span class="team-name-cell {{ !empty($row['is_galatasaray']) ? 'font-bold text-white' : '' }}">
                    {{ $row['team_name'] ?? '' }}
                </span>

                <span class="cc {{ !empty($row['is_galatasaray']) ? 'font-bold text-white' : '' }}">
                    {{ $row['played'] ?? '—' }}
                </span>

                <span class="pts {{ !empty($row['is_galatasaray']) ? 'pts-gold' : '' }}">
                    {{ $row['points'] ?? '—' }}
                </span>
            </div>
        @endforeach

        <div class="details-link-wrap">
            <a href="{{ route('standings.index') }}" class="text-xs text-[var(--muted)] hover:text-[var(--red)] transition">
                Detaylı tablo →
            </a>
        </div>
    @elseif ($status === 'empty')
        <div class="match-body">
            {{ $props['message'] ?? 'Lig tablosu verisi bulunamadı.' }}
        </div>
    @else
        <div class="match-body">
            {{ $props['message'] ?? 'Lig tablosu geçici olarak alınamadı.' }}
        </div>
    @endif
</div>

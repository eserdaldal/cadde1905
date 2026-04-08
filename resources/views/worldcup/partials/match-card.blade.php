{{--
    PARTIAL: match-card.blade.php
    Stadium detail ve ilgili maç listelerinde kullanılan kompakt maç kartı.
    Kural:
    - nested link yok
    - kart tek link ise tamamı maç detayına gider
    - alt bilgi footer gibi yapışık görünmez
--}}

@props(['match' => null])

@if (!empty($match) && is_object($match))
    @php
        $roundMap = [
            'Group Stage' => 'Grup Aşaması',
            'Round of 32' => 'Son 32',
            'Round of 16' => 'Son 16',
            'Quarter-finals' => 'Çeyrek Final',
            'Quarterfinals' => 'Çeyrek Final',
            'Semi-finals' => 'Yarı Final',
            'Semi-final' => 'Yarı Final',
            'Final' => 'Final',
            'Third Place Playoff' => 'Üçüncülük Maçı',
        ];

        $normalizeRound = function ($raw) use ($roundMap) {
            $raw = trim((string) $raw);

            if ($raw === '') {
                return 'Grup Aşaması';
            }

            foreach ($roundMap as $en => $tr) {
                if (stripos($raw, $en) !== false) {
                    $raw = str_ireplace($en, $tr, $raw);
                }
            }

            return $raw;
        };

        $displayRound = $normalizeRound($match->round ?? 'Grup Aşaması');
        $displayTime = $match->time ?? null;
        $displayTime = blank($displayTime) || in_array(strtoupper((string) $displayTime), ['TBD', 'TBA'], true)
            ? 'Saat açıklanacak'
            : $displayTime;

        $dateLabel = $match->date_label ?? null;

        $homeName = $match->home ?? data_get($match, 'homeTeam.name') ?? 'Takım';
        $awayName = $match->away ?? data_get($match, 'awayTeam.name') ?? 'Takım';

        $homeFlagUrl = data_get($match, 'home_flag_url') ?: data_get($match, 'homeTeam.flag_url');
        $awayFlagUrl = data_get($match, 'away_flag_url') ?: data_get($match, 'awayTeam.flag_url');

        $stadiumName = data_get($match, 'stadium.name') ?? $match->stadium_name ?? $match->stadium_title ?? null;
        if (!$stadiumName && isset($match->stadium) && is_string($match->stadium)) {
            $stadiumName = $match->stadium;
        } elseif (!$stadiumName && isset($match->stadium) && is_object($match->stadium) && isset($match->stadium->name)) {
            $stadiumName = $match->stadium->name;
        }

        $stadiumCity = data_get($match, 'stadium.city') ?? null;

        $matchId = $match->id ?? null;
        $matchSlug = $match->slug ?? null;
        $matchUrl = $matchSlug
            ? route('worldcup.matches.show', $matchSlug)
            : ($matchId ? route('worldcup.matches.show', $matchId) : null);

        $scoreHome = $match->home_score;
        $scoreAway = $match->away_score;
        $hasScore = isset($scoreHome) || isset($scoreAway);
    @endphp

    @if ($matchUrl)
        <a href="{{ $matchUrl }}" class="wc-card wc-card--interactive block overflow-hidden !p-0 shadow-lg hover:shadow-xl transition-all duration-300">
    @else
        <div class="wc-card block overflow-hidden !p-0 shadow-lg">
    @endif

        <div class="p-5 sm:p-6">
            {{-- ÜST META --}}
            <div class="flex items-center justify-between gap-3 mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-[var(--accent-premium)]/10 text-[10px] font-black uppercase tracking-widest text-[var(--accent-premium)] whitespace-nowrap">
                    {{ $displayRound }}
                </span>

                <div class="text-[11px] font-bold text-[var(--text-muted)] text-right whitespace-nowrap">
                    {{ $dateLabel ?: $displayTime }}
                </div>
            </div>

            {{-- MAÇ GÖVDESİ --}}
            <div class="flex items-center justify-between gap-2 sm:gap-4">
                <div class="flex-1 min-w-0 flex items-center gap-2.5">
                    <div class="shrink-0 w-7 h-7 sm:w-8 sm:h-8 rounded-full overflow-hidden border border-[var(--border-soft)] bg-[var(--surface-widget)] flex items-center justify-center">
                        @if ($homeFlagUrl)
                            <img src="{{ $homeFlagUrl }}" alt="" class="w-full h-full object-cover">
                        @else
                            <span class="text-sm">🏳️</span>
                        @endif
                    </div>

                    <div class="min-w-0">
                        <div class="text-sm sm:text-base font-black text-[var(--text-primary)] truncate">
                            {{ $homeName }}
                        </div>
                    </div>
                </div>

                <div class="shrink-0 px-2 sm:px-3 text-center min-w-[64px] sm:min-w-[72px]">
                    @if ($hasScore)
                        <div class="text-xl font-black text-[var(--text-primary)] leading-none">
                            {{ $scoreHome ?? '–' }}<span class="mx-1 opacity-40">:</span>{{ $scoreAway ?? '–' }}
                        </div>
                    @else
                        <div class="text-[11px] font-black uppercase tracking-widest text-[var(--text-muted)]">
                            {{ $displayTime }}
                        </div>
                    @endif
                </div>

                <div class="flex-1 min-w-0 flex items-center justify-end gap-2.5 sm:gap-3">
                    <div class="min-w-0 text-right">
                        <div class="text-sm sm:text-base font-black text-[var(--text-primary)] truncate">
                            {{ $awayName }}
                        </div>
                    </div>

                    <div class="shrink-0 w-7 h-7 sm:w-8 sm:h-8 rounded-full overflow-hidden border border-[var(--border-soft)] bg-[var(--surface-widget)] flex items-center justify-center">
                        @if ($awayFlagUrl)
                            <img src="{{ $awayFlagUrl }}" alt="" class="w-full h-full object-cover">
                        @else
                            <span class="text-sm">🏳️</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ALT BİLGİ --}}
            @if ($stadiumName || $stadiumCity)
                <div class="mt-5 pt-4 border-t border-[var(--border-soft)] min-h-[40px] flex items-center justify-between gap-4">
                    <div class="text-[11px] font-bold text-[var(--text-secondary)] truncate">
                        {{ $stadiumName ?: 'Stadyum açıklanmadı' }}
                    </div>

                    @if ($stadiumCity)
                        <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] whitespace-nowrap">
                            {{ $stadiumCity }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

    @if ($matchUrl)
        </a>
    @else
        </div>
    @endif
@else
    <div class="wc-card opacity-40 p-8 text-center">
        <span class="text-[10px] font-black uppercase tracking-widest">Maç Bilgisi Bekleniyor</span>
    </div>
@endif
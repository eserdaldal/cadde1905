{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — MAÇ DETAY
    Route: /dunya-kupasi/maclar/{match}
    Route name: worldcup.matches.show
    ══════════════════════════════════════════════════════════════
--}}

@extends('layouts.worldcup')

@php
    use Illuminate\Support\Facades\DB;

    $match = $match ?? null;
    $homeTeam = $match?->homeTeam ?? null;
    $awayTeam = $match?->awayTeam ?? null;
    $activeTournament = $activeTournament ?? null;
    $theme = 'event-light';

    $homeName = $homeTeam?->name ?? 'Ev Sahibi';
    $awayName = $awayTeam?->name ?? 'Deplasman';

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

    $roundLabel = $normalizeRound($match?->round ?? 'Grup Aşaması');
    $matchDate = $match?->date_label;
    $engDays = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    $trDays  = ['Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi','Pazar'];
    $engMonths = [
        'January','February','March','April','May','June','July','August','September','October','November','December',
        'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
    ];
    $trMonths  = [
        'Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık',
        'Oca','Şub','Mar','Nis','May','Haz','Tem','Ağu','Eyl','Eki','Kas','Ara'
    ];
    if ($matchDate) {
        $matchDate = str_ireplace($engDays, $trDays, $matchDate);
        $matchDate = str_ireplace($engMonths, $trMonths, $matchDate);
    }

    $stadiumName = $match?->stadium?->name_override
        ?? $match?->stadium?->name_api
        ?? $match?->stadium?->name
        ?? null;

    $stadiumCity = $match?->stadium?->city_api
        ?? $match?->stadium?->city
        ?? null;

    $stadiumCapacity = $match?->stadium?->capacity ?? null;

    $stadiumSlug = $match?->stadium?->slug
        ?? $match?->stadium_slug
        ?? null;

    if (! $stadiumSlug && $stadiumName) {
        $resolvedStadium = DB::table('world_cup_stadiums')
            ->select('slug')
            ->where('tournament_id', $activeTournament?->id)
            ->where(function ($query) use ($stadiumName) {
                $query->where('name_override', $stadiumName)
                    ->orWhere('name_api', $stadiumName);
            })
            ->first();

        $stadiumSlug = $resolvedStadium->slug ?? null;
    }

    $stadiumDetailUrl = $stadiumSlug
        ? route('worldcup.stadiums.show', $stadiumSlug)
        : route('worldcup.stadiums.index');

    $scoreHome = $match?->home_score;
    $scoreAway = $match?->away_score;

    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', $homeName . ' vs ' . $awayName . ' — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    <div class="event-layout contents">
        {{-- SCOREBOARD HERO --}}
        <section class="relative overflow-hidden pt-16 pb-20 border-b border-[var(--border-default)]">
            <div class="absolute inset-0 bg-gradient-to-br from-[#A91D35]/10 via-[var(--surface-base)] to-[#1D6F42]/10"></div>
            <div class="absolute inset-0 opacity-[0.03]"
                 style="background-image: radial-gradient(circle at 2px 2px, var(--accent-premium) 1px, transparent 0); background-size: 32px 32px;">
            </div>
            
            <div class="wc-container relative">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[var(--surface-widget)] border border-[var(--border-soft)] backdrop-blur-md">
                        <span class="text-[10px] font-black text-[var(--accent-premium)] uppercase tracking-widest">
                            {{ $roundLabel ?: 'Grup Aşaması' }}
                        </span>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center justify-center gap-10 lg:gap-16">
                    {{-- HOME TEAM --}}
                    <div class="text-center group flex-1 min-w-[220px]">
                        <div class="w-24 h-24 sm:w-32 sm:h-32 bg-[var(--surface-widget)] rounded-full overflow-hidden border-4 border-[var(--border-soft)] mx-auto mb-4 shadow-2xl transition-transform group-hover:scale-105">
                            @if ($match->homeTeam->flag_url ?? null)
                                <img src="{{ $match->homeTeam->flag_url }}" alt="{{ $homeName }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-5xl">🏳️</div>
                            @endif
                        </div>
                        <h2 class="text-[var(--text-primary)] font-black text-xl sm:text-2xl tracking-tight group-hover:text-[var(--accent-premium)] transition-colors max-w-[260px] mx-auto truncate">{{ $homeName }}</h2>
                        <p class="text-[var(--text-muted)] text-[10px] font-bold uppercase tracking-widest mt-1">Ev Sahibi</p>
                    </div>

                    {{-- SCORE --}}
                    <div class="relative flex flex-col items-center">
                        <div class="wc-score-panel flex items-center gap-4 px-8 py-4 bg-[var(--surface-widget)] backdrop-blur-xl rounded-3xl border border-[var(--border-soft)] shadow-2xl">
                            <span class="text-[var(--text-primary)] font-black text-5xl sm:text-7xl lg:text-8xl tabular-nums leading-none">{{ $scoreHome ?? '–' }}</span>
                            <span class="text-[var(--accent-premium)] text-2xl sm:text-4xl font-black">:</span>
                            <span class="text-[var(--text-primary)] font-black text-5xl sm:text-7xl lg:text-8xl tabular-nums leading-none">{{ $scoreAway ?? '–' }}</span>
                        </div>
                        <div class="wc-score-badge mt-3 px-3 py-1 rounded bg-[var(--accent-premium)] text-[#101010] text-[9px] font-black uppercase tracking-widest">Canlı</div>
                    </div>

                    {{-- AWAY TEAM --}}
                    <div class="text-center group flex-1 min-w-[220px]">
                        <div class="w-24 h-24 sm:w-32 sm:h-32 bg-[var(--surface-widget)] rounded-full overflow-hidden border-4 border-[var(--border-soft)] mx-auto mb-4 shadow-2xl transition-transform group-hover:scale-105">
                            @if ($match->awayTeam->flag_url ?? null)
                                <img src="{{ $match->awayTeam->flag_url }}" alt="{{ $awayName }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-5xl">🏳️</div>
                            @endif
                        </div>
                        <h2 class="text-[var(--text-primary)] font-black text-xl sm:text-2xl tracking-tight group-hover:text-[var(--accent-premium)] transition-colors max-w-[260px] mx-auto truncate">{{ $awayName }}</h2>
                        <p class="text-[var(--text-muted)] text-[10px] font-bold uppercase tracking-widest mt-1">Deplasman</p>
                    </div>
                </div>

            <div class="text-center mt-8 flex flex-col items-center gap-2">
                <div class="text-sm font-bold text-[var(--text-secondary)] flex items-center gap-3">
                    <span>{{ $matchDate ?? 'Tarih henüz netleşmedi' }}</span>
                </div>
                <div class="text-[var(--text-muted)] text-xs font-medium bg-[var(--surface-widget)] px-4 py-1.5 rounded-full border border-[var(--border-soft)]">
                    @if ($stadiumName)
                        🏟️ {{ $stadiumName }}{{ $stadiumCity ? ', ' . $stadiumCity : '' }}
                    @else
                        🏟️ Stadyum henüz açıklanmadı
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="wc-container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            {{-- MATCH EVENTS --}}
            <section class="wc-section wc-section--compact">
                @include('worldcup.partials.wc-section-header', [
                    'title' => 'Maç Olayları',
                    'subtitle' => 'Goller, kartlar ve karşılaşmanın önemli anları.'
                ])
                @include('worldcup.partials.wc-empty-state', [
                    'title' => 'Henüz bir olay gerçekleşmedi',
                    'description' => 'Maç başladığında goller, kartlar ve oyuncu değişiklikleri zaman çizelgesi olarak burada görünecektir.',
                    'class' => 'wc-empty-state--compact bg-[var(--surface-widget)] border-[var(--border-soft)]'
                ])
            </section>

            {{-- MATCH STATS --}}
            <section class="wc-section wc-section--compact">
                 @include('worldcup.partials.wc-section-header', [
                    'title' => 'Karşılaştırmalı İstatistikler',
                    'subtitle' => 'İki takımın sahadaki performans verileri.'
                ])

                <div class="wc-card p-7 bg-gradient-to-b from-[var(--surface-widget)] to-transparent">
                    <div class="max-w-xl mx-auto space-y-6">
                        @php
                            $matchStats = [
                                ['label' => 'Top Hakimiyeti', 'home' => '—%', 'away' => '—%'],
                                ['label' => 'Toplam Şut',     'home' => '—',  'away' => '—'],
                                ['label' => 'Korner',          'home' => '—',  'away' => '—'],
                                ['label' => 'Faul',            'home' => '—',  'away' => '—'],
                                ['label' => 'Ofsayt',          'home' => '—',  'away' => '—'],
                            ];
                        @endphp
                        @foreach ($matchStats as $ms)
                            @php
                                $homeStat = $ms['home'] ?? '—';
                                $awayStat = $ms['away'] ?? '—';
                                $isPlaceholder = str_contains((string) $homeStat, '—') && str_contains((string) $awayStat, '—');
                            @endphp
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-[var(--text-primary)] font-black tabular-nums w-20 text-left">
                                    @if ($isPlaceholder)
                                        <span class="wc-ghost-value w-10 h-4 opacity-30"></span>
                                    @else
                                        {{ $homeStat }}
                                    @endif
                                </span>
                                <div class="flex-1 px-4">
                                    <div class="text-[var(--text-muted)] text-[10px] font-black uppercase tracking-widest text-center mb-2">{{ $ms['label'] }}</div>
                                    <div class="h-1.5 w-full bg-[var(--border-soft)] rounded-full overflow-hidden flex">
                                        <div class="h-full bg-[var(--accent-premium)] {{ $isPlaceholder ? 'opacity-20' : 'opacity-50' }}" style="width: 50%"></div>
                                        <div class="h-full bg-[var(--border-default)] {{ $isPlaceholder ? 'opacity-20' : '' }}" style="width: 50%"></div>
                                    </div>
                                </div>
                                <span class="text-[var(--text-primary)] font-black tabular-nums w-20 text-right">
                                    @if ($isPlaceholder)
                                        <span class="wc-ghost-value w-10 h-4 opacity-30"></span>
                                    @else
                                        {{ $awayStat }}
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        {{-- LINEUPS --}}
        <section class="wc-section wc-section--compact pt-0">
             @include('worldcup.partials.wc-section-header', [
                'title' => 'Dizilişler',
                'subtitle' => 'Takımların sahaya çıkacağı ilk 11 ve yedek oyuncuları.'
            ])

            @php
                $lineups = data_get($match, 'lineups');
                $homeLineup = data_get($lineups, 'home')
                    ?? data_get($lineups, '0.starting')
                    ?? data_get($lineups, '0.players')
                    ?? data_get($lineups, '0')
                    ?? [];
                $awayLineup = data_get($lineups, 'away')
                    ?? data_get($lineups, '1.starting')
                    ?? data_get($lineups, '1.players')
                    ?? data_get($lineups, '1')
                    ?? [];

                $normalizeLineup = function ($items) {
                    if ($items instanceof \Illuminate\Support\Collection) {
                        $items = $items->all();
                    }
                    if (!is_array($items)) {
                        $items = [];
                    }
                    return collect($items)->filter()->values();
                };

                $extractName = function ($player, string $fallback = 'Oyuncu') {
                    if (is_string($player)) {
                        return trim($player) !== '' ? $player : $fallback;
                    }
                    if (is_array($player)) {
                        return $player['name'] ?? data_get($player, 'player.name') ?? data_get($player, 'full_name') ?? $fallback;
                    }
                    if (is_object($player)) {
                        return $player->name ?? data_get($player, 'player.name') ?? data_get($player, 'full_name') ?? $fallback;
                    }
                    return $fallback;
                };

                $extractPosition = function ($player) {
                    if (is_array($player)) {
                        return $player['position'] ?? data_get($player, 'player.position');
                    }
                    if (is_object($player)) {
                        return $player->position ?? data_get($player, 'player.position');
                    }
                    return null;
                };

                $homeLineup = $normalizeLineup($homeLineup);
                $awayLineup = $normalizeLineup($awayLineup);
                $hasLineups = $homeLineup->isNotEmpty() || $awayLineup->isNotEmpty();
            @endphp

            @if (! $hasLineups)
                @include('worldcup.partials.wc-empty-state', [
                    'title' => 'Kadrolar henüz açıklanmadı',
                    'description' => 'İlk 11 ve yedek oyuncu bilgileri resmi olarak paylaşıldığında burada listelenecektir.',
                    'class' => 'wc-empty-state--compact bg-[var(--surface-widget)] border-[var(--border-soft)]'
                ])
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ([
                        ['label' => $homeName, 'items' => $homeLineup],
                        ['label' => $awayName, 'items' => $awayLineup],
                    ] as $side)
                        <div class="wc-card">
                            <div class="px-5 py-4 border-b border-[var(--border-soft)] bg-[var(--surface-widget)]">
                                <h3 class="text-[var(--text-primary)] font-black text-sm uppercase tracking-tight">{{ $side['label'] }}</h3>
                            </div>
                            <div class="p-5 space-y-3">
                                @foreach ($side['items']->take(11) as $idx => $player)
                                    @php
                                        $playerName = $extractName($player, 'Oyuncu');
                                        $playerPos = $extractPosition($player);
                                    @endphp
                                    <div class="flex items-center gap-4 text-xs font-bold transition-all hover:translate-x-1 group">
                                        <span class="w-8 h-8 rounded-lg bg-[var(--surface-widget)] border border-[var(--border-soft)] flex items-center justify-center text-[var(--accent-premium)] tabular-nums group-hover:bg-[var(--accent-premium)] group-hover:text-[#101010] transition-colors">{{ $idx + 1 }}</span>
                                        <span class="text-[var(--text-secondary)] group-hover:text-[var(--text-primary)] transition-colors">{{ $playerName }}</span>
                                        <span class="ml-auto text-[9px] text-[var(--text-muted)] uppercase tracking-widest">{{ $playerPos ?: 'Mevki' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- STADIUM INFO CARD --}}
        <section class="wc-section wc-section--compact pt-0 pb-24">
            <div class="wc-card wc-card--highlight p-6 flex flex-col md:flex-row items-center gap-6 border border-[var(--accent-premium)]/30 bg-[var(--surface-widget)] shadow-2xl">
                 <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[var(--accent-premium)]/10 rounded-2xl flex items-center justify-center text-4xl shadow-inner border border-[var(--accent-premium)]/20">
                    🏟️
                 </div>
                 <div class="text-center md:text-left flex-1">
                    <h3 class="text-[var(--text-primary)] font-black text-2xl tracking-tight">
                        @if ($stadiumName)
                            {{ $stadiumName }}
                        @else
                            Stadyum henüz açıklanmadı
                        @endif
                    </h3>
                    <p class="text-[var(--text-secondary)] font-medium mt-2">
                        @if ($stadiumCity)
                            {{ $stadiumCity }}
                            @if (!empty($stadiumCapacity))
                                <span class="mx-2 opacity-20">|</span>
                                <span class="text-[var(--accent-premium)] tabular-nums">{{ number_format($stadiumCapacity, 0, ',', '.') }}</span> kapasite
                            @endif
                        @else
                            Konum bilgisi yakında paylaşılacaktır.
                        @endif
                    </p>
                 </div>
                 <div class="flex-shrink-0">
                     <a href="{{ $stadiumDetailUrl }}" class="px-6 py-3 rounded-full bg-[var(--surface-base)] border border-[var(--border-soft)] text-[var(--text-primary)] text-xs font-black uppercase tracking-widest hover:bg-[var(--border-soft)] transition-all">Stadyum Detayları</a>
                 </div>
            </div>
        </section>
    </div>
</div>

@endsection
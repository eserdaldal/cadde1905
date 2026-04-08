{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — LANDING PAGE
    Route: /dunya-kupasi
    ══════════════════════════════════════════════════════════════
--}}

@extends('worldcup.layouts.app')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;
@endphp

@section('title', $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $settings = $settings ?? null;
        $activeTournament = $activeTournament ?? null;

        $heroDateRange = $heroDateRange ?? null;
        $heroStart = $activeTournament?->starts_at;
        $heroEnd = $activeTournament?->ends_at;
        $dateRange = $heroDateRange;

        if (! $dateRange && $heroStart && $heroEnd) {
            $dateRange = $heroStart->format('d M') . ' – ' . $heroEnd->format('d M Y');
        }

        $dateRange = $dateRange ?: 'Tarih açıklanacak';

        $heroTitle = $activeTournament?->hero_title ?? $activeTournament?->name ?? 'FIFA Dünya Kupası';
        $heroYear = $activeTournament?->year;
        $heroSubtitle = $activeTournament?->hero_subtitle;

        $hostCountriesRaw = $activeTournament?->host_country;
        $hostCountries = $hostCountriesRaw
            ? preg_split('/\s*,\s*/', $hostCountriesRaw)
            : [];

        $countryEmojiMap = [
            'ABD' => '🇺🇸',
            'Meksika' => '🇲🇽',
            'Kanada' => '🇨🇦',
            'USA' => '🇺🇸',
            'United States' => '🇺🇸',
            'Mexico' => '🇲🇽',
            'Canada' => '🇨🇦',
        ];

        $showCountdown = $settings ? (bool) $settings->countdown_enabled : true;
        $showFeaturedPlayers = $settings ? (bool) $settings->show_featured_players : true;
        $showFeaturedMatches = $settings ? (bool) $settings->show_featured_matches : true;
        $showFeaturedStadiums = $settings ? (bool) $settings->show_featured_stadiums : true;
        $showStatCards = $settings ? (bool) $settings->show_stat_cards : true;
        $showFeaturedTeams = true;

        $lastSyncLabel = $lastSyncLabel ?? null;

        $countdownTarget = $activeTournament?->starts_at?->toIso8601String();
    @endphp

    {{-- ╔══════════════════════════════════════════════════════╗
         ║  BÖLÜM 1: HERO                                      ║
         ║  Geri sayım, başlık, ev sahibi ülkeler               ║
         ╚══════════════════════════════════════════════════════╝ --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#8D1B3D]/20 via-[#1E1E1C] to-[#1D6F42]/10"></div>
        <div class="absolute inset-0 bg-[url('/images/worldcup/pattern.svg')] opacity-5"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full px-4 py-1.5 mb-6">
                <span class="text-[#D4AF37] text-sm">🏆</span>
                <span class="text-white/80 text-xs font-medium uppercase tracking-wider">
                    {{ $dateRange }}
                </span>
            </div>

            @if ($lastSyncLabel)
                <div class="text-xs text-white/50 mb-4">
                    Son güncelleme: {{ $lastSyncLabel }}
                </div>
            @endif

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-4">
                {{ $heroTitle }}
                @if ($heroYear)
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#8D1B3D]">
                        {{ $heroYear }}
                    </span>
                @endif
            </h1>

            @if (!empty($heroSubtitle))
                <p class="text-white/70 text-sm sm:text-base mb-6 max-w-2xl mx-auto">
                    {{ $heroSubtitle }}
                </p>
            @endif

            @if (! empty($hostCountries))
                <div class="flex items-center justify-center gap-4 sm:gap-6 mb-10">
                    @foreach ($hostCountries as $country)
                        <div class="flex items-center gap-1.5 text-gray-400 text-sm">
                            <span class="text-xl">{{ $countryEmojiMap[$country] ?? '🏳️' }}</span>
                            {{ $country }}
                        </div>
                        @if (! $loop->last)
                            <span class="text-white/20">·</span>
                        @endif
                    @endforeach
                </div>
            @endif

            @if ($showCountdown)
                @include('worldcup.partials.countdown', ['countdownTarget' => $countdownTarget])
            @endif
        </div>
    </section>

    @if ($showFeaturedPlayers)
        {{-- ╔══════════════════════════════════════════════════════╗
             ║  BÖLÜM 2: KUPADAKİ ASLANLAR VİTRİN                 ║
             ║  Galatasaray oyuncuları — altın vurgulu özel alan    ║
             ╚══════════════════════════════════════════════════════╝ --}}
        <section class="relative border-y border-[#D4AF37]/20 bg-gradient-to-r from-[#D4AF37]/5 via-transparent to-[#D4AF37]/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <span class="text-[#D4AF37] text-2xl">🦁</span>
                        <div>
                            <h2 class="text-white font-bold text-xl">Kupadaki Aslanlar</h2>
                            <p class="text-gray-500 text-sm mt-0.5">
                                Galatasaraylı oyuncularımız dünya sahnesinde
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('worldcup.aslanlar.index') }}"
                       class="text-[#D4AF37] text-sm font-medium hover:underline hidden sm:block">
                        Tümünü Gör →
                    </a>
                </div>

                @php
                    $featuredPlayers = $featuredPlayers ?? [];
                    $aslanlarPlayers = count($featuredPlayers) > 0 ? $featuredPlayers : [
                        (object) [
                            'slug' => 'oyuncu-1',
                            'name' => 'Oyuncu Adı 1',
                            'position' => 'Forvet',
                            'gs_squad_number' => 23,
                            'nationalTeam' => (object) ['flag_url' => null, 'name' => 'Türkiye'],
                        ],
                        (object) [
                            'slug' => 'oyuncu-2',
                            'name' => 'Oyuncu Adı 2',
                            'position' => 'Orta Saha',
                            'gs_squad_number' => 10,
                            'nationalTeam' => (object) ['flag_url' => null, 'name' => 'Arjantin'],
                        ],
                        (object) [
                            'slug' => 'oyuncu-3',
                            'name' => 'Oyuncu Adı 3',
                            'position' => 'Defans',
                            'gs_squad_number' => 7,
                            'nationalTeam' => (object) ['flag_url' => null, 'name' => 'Brezilya'],
                        ],
                        (object) [
                            'slug' => 'oyuncu-4',
                            'name' => 'Oyuncu Adı 4',
                            'position' => 'Kaleci',
                            'gs_squad_number' => 4,
                            'nationalTeam' => (object) ['flag_url' => null, 'name' => 'Uruguay'],
                        ],
                        (object) [
                            'slug' => 'oyuncu-5',
                            'name' => 'Oyuncu Adı 5',
                            'position' => 'Orta Saha',
                            'gs_squad_number' => 19,
                            'nationalTeam' => (object) ['flag_url' => null, 'name' => 'Nijerya'],
                        ],
                    ];
                @endphp

                @if (empty($aslanlarPlayers) || count($aslanlarPlayers) === 0)
                    <div class="text-center text-white/60 py-10">
                        No data available
                    </div>
                @else
                    <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide snap-x snap-mandatory">
                        @foreach ($aslanlarPlayers as $player)
                            <div class="w-48 flex-shrink-0 snap-start">
                                @include('worldcup.partials.player-card', ['player' => $player])
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4 text-center sm:hidden">
                    <a href="{{ route('worldcup.aslanlar.index') }}"
                       class="text-[#D4AF37] text-sm font-medium hover:underline">
                        Tümünü Gör →
                    </a>
                </div>
            </div>
        </section>
    @endif

    @if ($showFeaturedTeams)
        {{-- ╔══════════════════════════════════════════════════════╗
             ║  BÖLÜM 3: TAKIMLAR VİTRİNİ                         ║
             ║  Öne çıkan takımların hızlı görünümü               ║
             ╚══════════════════════════════════════════════════════╝ --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white font-bold text-xl">Takımlar</h2>
                <a href="{{ route('worldcup.teams.index') }}"
                   class="text-gray-400 text-sm hover:text-white transition-colors">
                    Tüm Takımlar →
                </a>
            </div>

            @php
                $featuredTeams = $featuredTeams ?? collect();
                $groupsCollection = collect($groups ?? []);
                $groupNamesById = $groupsCollection->mapWithKeys(function ($group) {
                    return [$group->id => $group->name ?: $group->code];
                })->all();

                $teamCards = collect($featuredTeams)->map(function ($team) use ($groupNamesById) {
                    $groupName = $groupNamesById[$team->group_id] ?? null;

                    return (object) [
                        'slug' => $team->slug,
                        'name' => $team->name_override ?: $team->name_api,
                        'confederation' => $team->confederation,
                        'flag_emoji' => '🏳️',
                        'fifa_ranking' => null,
                        'group' => (object) ['name' => $groupName],
                    ];
                })->all();
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @if (count($teamCards) === 0)
                    @for ($i = 0; $i < 6; $i++)
                        @include('worldcup.partials.team-card')
                    @endfor
                @else
                    @foreach ($teamCards as $team)
                        @include('worldcup.partials.team-card', ['team' => $team])
                    @endforeach
                @endif
            </div>
        </section>
    @endif

    @if ($showFeaturedMatches)
        {{-- ╔══════════════════════════════════════════════════════╗
             ║  BÖLÜM 4: YAKIN MAÇLAR                              ║
             ║  Günün maçları veya yaklaşan maçlar                  ║
             ╚══════════════════════════════════════════════════════╝ --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white font-bold text-xl">Maçlar</h2>
                <a href="{{ route('worldcup.matches.index') }}"
                   class="text-gray-400 text-sm hover:text-white transition-colors">
                    Tüm Maçlar →
                </a>
            </div>

            @php
                $featuredMatches = $featuredMatches ?? [];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @if (count($featuredMatches) === 0)
                    @for ($i = 0; $i < 3; $i++)
                        @include('worldcup.partials.match-card')
                    @endfor
                @else
                    @foreach ($featuredMatches as $match)
                        @include('worldcup.partials.match-card', ['match' => $match])
                    @endforeach
                @endif
            </div>
        </section>
    @endif

    {{-- ╔══════════════════════════════════════════════════════╗
         ║  BÖLÜM 4.5: ELEME TURU (KNOCKOUT)                   ║
         ║  Round bazlı eşleşmeler                              ║
         ╚══════════════════════════════════════════════════════╝ --}}
    @include('worldcup.partials.knockout', ['knockoutData' => $knockoutData])

    {{-- ╔══════════════════════════════════════════════════════╗
         ║  BÖLÜM 5: GRUP DURUMLARI ÖZETİ                     ║
         ║  12 grubun mini tabloları                            ║
         ╚══════════════════════════════════════════════════════╝ --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-white font-bold text-xl">Gruplar</h2>
            <a href="{{ route('worldcup.groups.index') }}"
               class="text-gray-400 text-sm hover:text-white transition-colors">
                Detaylı Görünüm →
            </a>
        </div>

        @php
            $groupLetters = [];
            $groupsCollection = collect($groups ?? []);
            $groupStandingsCollection = collect($groupStandings ?? []);

            if ($groupsCollection->isNotEmpty()) {
                $groupLetters = $groupsCollection
                    ->pluck('code')
                    ->filter()
                    ->unique()
                    ->values()
                    ->all();
            } elseif ($groupStandingsCollection->isNotEmpty()) {
                $groupLetters = $groupStandingsCollection
                    ->map(function ($standing) {
                        return $standing->group?->code;
                    })
                    ->filter()
                    ->unique()
                    ->values()
                    ->all();
            }

            if (empty($groupLetters)) {
                $groupLetters = range('A', 'L');
            }
        @endphp

        @if (empty($groupLetters) || count($groupLetters) === 0)
            <div class="text-center text-white/60 py-10">
                No data available
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($groupLetters as $groupLetter)
                    @php
                        $groupStandings = collect($groupStandings ?? [])->filter(fn($s) => ($s->group?->code ?: $s->group?->name) === $groupLetter);
                    @endphp
                    @include('worldcup.partials.group-table-mini', [
                        'groupLetter' => $groupLetter,
                        'standings' => $groupStandings
                    ])
                @endforeach
            </div>
        @endif
    </section>

    @if ($showFeaturedStadiums)
        {{-- ╔══════════════════════════════════════════════════════╗
             ║  BÖLÜM 6: STADYUMLAR GALERİSİ                      ║
             ║  Görsel kartlar, şehir ve kapasite bilgisi           ║
             ╚══════════════════════════════════════════════════════╝ --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white font-bold text-xl">Stadyumlar</h2>
                <a href="{{ route('worldcup.stadiums.index') }}"
                   class="text-gray-400 text-sm hover:text-white transition-colors">
                    Tümünü Gör →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $featuredStadiums = $featuredStadiums ?? [];
                    $stadiums = count($featuredStadiums) > 0 ? $featuredStadiums : [
                        ['name' => 'MetLife Stadium', 'city' => 'New Jersey', 'country' => 'ABD', 'capacity' => 82500],
                        ['name' => 'AT&T Stadium', 'city' => 'Dallas', 'country' => 'ABD', 'capacity' => 80000],
                        ['name' => 'Estadio Azteca', 'city' => 'Meksika City', 'country' => 'Meksika', 'capacity' => 87523],
                        ['name' => 'SoFi Stadium', 'city' => 'Los Angeles', 'country' => 'ABD', 'capacity' => 70000],
                        ['name' => 'Hard Rock Stadium', 'city' => 'Miami', 'country' => 'ABD', 'capacity' => 64767],
                        ['name' => 'BMO Field', 'city' => 'Toronto', 'country' => 'Kanada', 'capacity' => 45000],
                    ];
                @endphp

                @foreach ($stadiums as $stadium)
                    @include('worldcup.partials.stadium-card', ['stadium' => $stadium])
                @endforeach
            </div>
        </section>
    @endif

    @php
        $contentRelations = $contentRelations ?? collect();
    @endphp

    @if (count($contentRelations) > 0)
        {{-- ╔══════════════════════════════════════════════════════╗
             ║  BÖLÜM 7: ÖNE ÇIKAN İÇERİKLER                     ║
             ║  World Cup ile ilişkili içerik özetleri           ║
             ╚══════════════════════════════════════════════════════╝ --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-white font-bold text-lg">Öne Çıkan İçerikler</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach ($contentRelations as $relation)
                    <div class="p-3 bg-white/5 border border-white/10 rounded-lg">
                        <div class="text-[10px] text-white/50 uppercase tracking-wider">
                            {{ $relation->relation_type ?? 'İçerik' }}
                        </div>
                        <div class="text-sm text-white">
                            {{ class_basename($relation->related_type ?? 'Content') }} #{{ $relation->related_id ?? '—' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($showStatCards)
        {{-- ╔══════════════════════════════════════════════════════╗
             ║  BÖLÜM 8: İSTATİSTİK ÖZETLERİ                      ║
             ║  Turnuva başlamadan önce "yakında" mesajı             ║
             ╚══════════════════════════════════════════════════════╝ --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white font-bold text-xl">İstatistikler</h2>
                <a href="{{ route('worldcup.stats.index') }}"
                   class="text-gray-400 text-sm hover:text-white transition-colors">
                    Tüm İstatistikler →
                </a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $stats = [
                        ['icon' => '⚽', 'title' => 'Gol Kralı', 'value' => '—', 'sub' => 'Turnuva başlamadı'],
                        ['icon' => '🎯', 'title' => 'Asist Lideri', 'value' => '—', 'sub' => 'Turnuva başlamadı'],
                        ['icon' => '🧤', 'title' => 'Temiz Sayfa', 'value' => '—', 'sub' => 'Turnuva başlamadı'],
                        ['icon' => '🟨', 'title' => 'Kart Sıralaması', 'value' => '—', 'sub' => 'Turnuva başlamadı'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    @include('worldcup.partials.stat-card', [
                        'icon'       => $stat['icon'],
                        'title'      => $stat['title'],
                        'value'      => $stat['value'],
                        'playerName' => $stat['sub'],
                    ])
                @endforeach
            </div>
        </section>
    @endif

@endsection

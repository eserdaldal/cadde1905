@php
    $theme = 'event-light';
@endphp
@extends('layouts.worldcup')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;

    $settings = $settings ?? null;
    $heroDateRange = $heroDateRange ?? null;
    $heroStart = $activeTournament?->starts_at;
    $heroEnd = $activeTournament?->ends_at;
    $dateRange = $heroDateRange;

    if (! $dateRange && $heroStart && $heroEnd) {
        $dateRange = $heroStart->format('d M') . ' – ' . $heroEnd->format('d M Y');
    }
    $dateRange = $dateRange ?: 'Tarih açıklanacak';

    // Translation for dates
    $eng = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    $tr  = ['Oca','Şub','Mar','Nis','May','Haz','Tem','Ağu','Eyl','Eki','Kas','Ara','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi','Pazar'];
    $dateRange = str_ireplace($eng, $tr, $dateRange);

    $heroTitle = $activeTournament?->hero_title ?? $activeTournament?->name ?? 'FIFA Dünya Kupası';
    $heroYear = $activeTournament?->year;
    $heroSubtitle = $activeTournament?->hero_subtitle;

    $hostCountriesRaw = $activeTournament?->host_country;
    $hostCountries = $hostCountriesRaw ? preg_split('/\s*,\s*/', $hostCountriesRaw) : [];
    $countryEmojiMap = ['ABD' => '🇺🇸', 'Meksika' => '🇲🇽', 'Kanada' => '🇨🇦', 'USA' => '🇺🇸', 'Mexico' => '🇲🇽', 'Canada' => '🇨🇦'];

    $showCountdown = $settings ? (bool) $settings->countdown_enabled : true;
    $showFeaturedPlayers = $settings ? (bool) $settings->show_featured_players : true;
    $showFeaturedMatches = $settings ? (bool) $settings->show_featured_matches : true;
    $showFeaturedStadiums = $settings ? (bool) $settings->show_featured_stadiums : true;
    $showStatCards = $settings ? (bool) $settings->show_stat_cards : true;
    
    $countdownTarget = $activeTournament?->starts_at?->toIso8601String();

    $cleanHeroTitle = $heroTitle;
    if ($heroYear && str_contains($heroTitle, (string)$heroYear)) {
        $cleanHeroTitle = trim(str_replace((string)$heroYear, '', $heroTitle));
    }

    $groupsCollection = collect($groups ?? []);
    $groupOptions = collect();

    if ($groupsCollection->isNotEmpty()) {
        $groupOptions = $groupsCollection->map(function ($group) {
            $label = $group->code ?: $group->name ?: $group->id;
            $label = trim(str_ireplace(['Grup', 'Group'], '', $label));
            return ['key' => (string) $group->id, 'label' => $label];
        })->values();
    } elseif (!empty($groupStandings) && count($groupStandings) > 0) {
        $groupOptions = collect($groupStandings)
            ->pluck('group')
            ->filter()
            ->unique('id')
            ->map(function ($group) {
                $label = $group->code ?: $group->name ?: $group->id;
                $label = trim(str_ireplace(['Grup', 'Group'], '', $label));
                return ['key' => (string) $group->id, 'label' => $label];
            })
            ->values();
    }

    if ($groupOptions->isEmpty()) {
        $groupOptions = collect(range('A', 'L'))->map(fn ($label) => ['key' => $label, 'label' => $label]);
    }

    $defaultGroupKey = $groupOptions->first()['key'] ?? 'A';
    $defaultGroupLabel = $groupOptions->first()['label'] ?? 'A';
@endphp

@section('title', $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    {{-- 🏔️ HERO SECTION --}}
    <section class="wc-hero relative overflow-hidden border-b border-[var(--border-soft)]">
        <div class="absolute inset-0 bg-gradient-to-br from-[var(--accent-premium)]/12 via-[var(--surface-base)] to-[#8D1B3D]/10"></div>
        <img src="/assets/images/worldcup/maradona.avif" alt="" aria-hidden="true" class="absolute inset-0 w-full h-full object-cover opacity-20">
        <div class="wc-hero-overlay"></div>
        
        <div class="wc-container relative text-center wc-hero-content">
            <h1 class="wc-hero-title font-black mb-8 tracking-tighter mt-64">
                {{ $cleanHeroTitle }}@if ($heroYear) {{ $heroYear }}@endif
            </h1>

            @if (!empty($heroSubtitle))
                <p class="text-[var(--text-muted)] text-xl sm:text-2xl mb-14 max-w-3xl mx-auto font-medium leading-relaxed">
                    {{ $heroSubtitle }}
                </p>
            @endif

            @if (! empty($hostCountries))
                <div class="flex flex-wrap items-center justify-center gap-10 mb-20 scale-110">
                    @foreach ($hostCountries as $country)
                        <div class="flex items-center gap-4 text-[var(--text-primary)] font-black text-sm uppercase tracking-widest">
                            <span class="text-4xl filter drop-shadow-2xl">{{ $countryEmojiMap[$country] ?? '🏳️' }}</span>
                            {{ $country }}
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($showCountdown)
                <div class="max-w-4xl mx-auto mt-4">
                    @include('worldcup.partials.countdown', ['countdownTarget' => $countdownTarget])
                </div>
            @endif
        </div>
    </section>

    {{-- 📊 GRUP + ⚽ GÜNÜN HEYECANI --}}
    <section class="wc-section wc-section--compact wc-section--compact-bottom border-b border-[var(--border-soft)]" x-data="{ selectedGroup: '{{ $defaultGroupKey }}', selectedGroupLabel: '{{ $defaultGroupLabel }}', openGroup: false }">
        <div class="wc-container">
            <div class="wc-home-grid grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="wc-card p-5 sm:p-6">
                    <div class="flex flex-wrap items-end justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-[var(--text-primary)] text-2xl font-black">Grup Aşaması</h2>
                            <p class="text-[var(--text-muted)] text-sm">Seçili grubun puan durumu ve sıralaması.</p>
                        </div>
                        <div class="relative wc-group-select-wrap">
                            <button type="button"
                                    class="wc-group-trigger"
                                    @click="openGroup = !openGroup"
                                    :aria-expanded="openGroup.toString()">
                                <span>Grup <span x-text="selectedGroupLabel"></span></span>
                                <span class="wc-group-trigger__chevron">▾</span>
                            </button>
                            <div class="wc-group-menu"
                                 x-show="openGroup"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translateY(-6px)"
                                 x-transition:enter-end="opacity-100 translateY(0)"
                                 @click.outside="openGroup = false">
                                @foreach ($groupOptions as $groupOption)
                                    <button type="button"
                                            class="wc-group-option"
                                            :class="selectedGroup === '{{ $groupOption['key'] }}' ? 'is-active' : ''"
                                            @click="selectedGroup = '{{ $groupOption['key'] }}'; selectedGroupLabel = '{{ $groupOption['label'] }}'; openGroup = false">
                                        Grup {{ $groupOption['label'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @foreach ($groupOptions as $groupOption)
                            @php
                                $groupStandingsForOption = collect($groupStandings ?? [])->filter(function($s) use ($groupOption) {
                                    $key = $groupOption['key'];
                                    if (is_numeric($key)) {
                                        return (string) $s->group_id === (string) $key;
                                    }
                                    $sLetter = $s->group?->code ?: $s->group?->name ?: '';
                                    $sLetter = trim(str_ireplace(['Grup', 'Group'], '', $sLetter));
                                    return trim(strtoupper($sLetter)) === trim(strtoupper($groupOption['label']));
                                });
                            @endphp
                            <div x-show="selectedGroup === '{{ $groupOption['key'] }}'"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translateY(6px)"
                                 x-transition:enter-end="opacity-100 translateY(0)">
                                @include('worldcup.partials.group-table-mini', [
                                    'groupLetter' => $groupOption['label'],
                                    'standings' => $groupStandingsForOption
                                ])
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="wc-card p-5 sm:p-6">
                    <div class="flex items-end justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-[var(--text-primary)] text-2xl font-black">Günün Heyecanı</h2>
                            <p class="text-[var(--text-muted)] text-sm">Öne çıkan eşleşmeler ve anlık skor akışı.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if (! $showFeaturedMatches)
                            @include('worldcup.partials.wc-empty-state', [
                                'title' => 'Maç listesi henüz açıklanmadı',
                                'description' => 'Turnuva akışı netleştiğinde günün heyecanı burada listelenecek.',
                                'class' => 'wc-empty-state--compact bg-[var(--surface-widget)] border-[var(--border-soft)]'
                            ])
                        @elseif (empty($featuredMatches) || count($featuredMatches) === 0)
                            @for ($i = 0; $i < 2; $i++)
                                @include('worldcup.partials.match-card')
                            @endfor
                        @else
                            @foreach ($featuredMatches as $match)
                                @include('worldcup.partials.match-card', ['match' => $match])
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 🦁 KUPADAKİ ASLANLAR + 🧭 TURNUVA MERKEZİ --}}
    <section class="wc-section wc-section--compact wc-section--compact-top wc-section--compact-bottom border-t border-[var(--border-soft)]">
        <div class="wc-container">
            <div class="wc-home-grid grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="wc-card p-5 sm:p-6">
                    <div class="flex items-end justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-[var(--text-primary)] text-2xl font-black">Kupadaki Aslanlar</h2>
                            <p class="text-[var(--text-muted)] text-sm">Galatasaraylı yıldızlarımızın dünya sahnesindeki mücadelesi.</p>
                        </div>
                    </div>

                    @if (! $showFeaturedPlayers)
                        @include('worldcup.partials.wc-empty-state', [
                            'icon' => '🦁',
                            'title' => 'Kadro henüz açıklanmadı',
                            'description' => 'Milli takım kadroları resmileştiğinde burada listelenecek.',
                            'class' => 'wc-empty-state--compact bg-[var(--surface-widget)] border-[var(--border-soft)]'
                        ])
                    @elseif (empty($featuredPlayers) || count($featuredPlayers) === 0)
                        @include('worldcup.partials.wc-empty-state', [
                            'icon' => '🦁',
                            'title' => 'Kadro henüz açıklanmadı',
                            'description' => 'Milli takım kadroları resmileştiğinde burada listelenecek.',
                            'class' => 'wc-empty-state--compact bg-[var(--surface-widget)] border-[var(--border-soft)]'
                        ])
                    @else
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach (collect($featuredPlayers)->take(3) as $player)
                                @include('worldcup.partials.player-card', ['player' => $player])
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="wc-card p-5 sm:p-6">
                    <div class="flex items-end justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-[var(--text-primary)] text-2xl font-black">Turnuva Merkezi</h2>
                            <p class="text-[var(--text-muted)] text-sm">Eleme yolu, stadyumlar ve istatistiklere hızlı geçiş.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <a href="{{ route('worldcup.matches.index') }}" class="wc-card wc-card--interactive p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-xl">🗺️</span>
                                <h3 class="text-[var(--text-primary)] font-black text-base">Final Yolu</h3>
                            </div>
                            <p class="text-[var(--text-muted)] text-sm font-medium">Eleme turlarının akışını maç takviminde takip edin.</p>
                        </a>

                        <a href="{{ route('worldcup.stadiums.index') }}" class="wc-card wc-card--interactive p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-xl">🏟️</span>
                                <h3 class="text-[var(--text-primary)] font-black text-base">Stadyumlar</h3>
                            </div>
                            <p class="text-[var(--text-muted)] text-sm font-medium">Ev sahipliği yapacak arenaları tek ekranda görün.</p>
                        </a>

                        <a href="{{ route('worldcup.stats.index') }}" class="wc-card wc-card--interactive p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-xl">📈</span>
                                <h3 class="text-[var(--text-primary)] font-black text-base">İstatistik Merkezi</h3>
                            </div>
                            <p class="text-[var(--text-muted)] text-sm font-medium">Gol krallığı ve asist listeleri burada.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

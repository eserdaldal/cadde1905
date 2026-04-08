@php
    $theme = 'event-light';
@endphp
@extends('layouts.worldcup')

@php
    $activeTournament = $activeTournament ?? null;
    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';

    $cleanPageTitle = $pageTitle;
    if ($pageYear && str_contains($pageTitle, (string)$pageYear)) {
        $cleanPageTitle = trim(str_replace((string)$pageYear, '', $pageTitle));
    }

    $pageTitleWithYear = $pageYear ? ($cleanPageTitle . ' ' . $pageYear) : $cleanPageTitle;
@endphp

@section('title', 'Takımlar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $filters = $filters ?? [];
        $confederations = $filters['confederations'] ?? ['Tümü', 'UEFA', 'CONMEBOL', 'CONCACAF', 'CAF', 'AFC', 'OFC'];
        $teams = $teams ?? [];
        $featuredTeams = $featuredTeams ?? [];
        $teamsForGrid = count($teams) > 0 ? $teams : $featuredTeams;
    @endphp

    <div class="wc-container" x-data="{
        search: '',
        visibleCount: 0,
        normalize(value) {
            return (value || '').toString().toLocaleLowerCase('tr-TR').trim();
        },
        matches(card) {
            const term = this.normalize(this.search);
            if (!term) {
                return true;
            }
            const name = this.normalize(card.dataset.name || '');
            return name.includes(term);
        },
        updateVisible() {
            this.$nextTick(() => {
                const cards = this.$el.querySelectorAll('.team-card-wrapper');
                let count = 0;
                cards.forEach(card => {
                    if (getComputedStyle(card).display !== 'none') {
                        count++;
                    }
                });
                this.visibleCount = count;
            });
        }
    }" x-init="updateVisible()" x-effect="search; updateVisible()">
        <section class="wc-section wc-section--compact">
            <div class="grid gap-4 sm:grid-cols-[1fr_2fr_1fr] sm:items-end">
                <div class="hidden sm:block"></div>
                <div class="text-center">
                    <h1 class="wc-page-title wc-page-title--compact">Turnuva Takımları</h1>
                    <p class="wc-page-subtitle">{{ $pageTitleWithYear }} finallerinde mücadele eden tüm ulusal takımlar.</p>
                </div>
                <div class="relative group w-full sm:max-w-[220px] sm:justify-self-end">
                    <input type="text"
                           x-model="search"
                           placeholder="Takım ara..."
                           class="w-full h-9 bg-[var(--surface-widget)] border border-[var(--border-soft)] rounded-2xl px-9 text-[13px] text-[var(--text-primary)] placeholder-gray-500 focus:outline-none focus:border-[var(--accent-gold)] focus:ring-4 focus:ring-[var(--accent-gold)]/10 transition-all">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-lg opacity-40 group-focus-within:opacity-100 transition-opacity">🔍</span>
                </div>
            </div>
            <div class="wc-page-divider"></div>

            @if (empty($teamsForGrid) || count($teamsForGrid) === 0)
                <div class="py-12">
                    @include('worldcup.partials.wc-empty-state', [
                        'title' => 'Takımlar listesi bekleniyor',
                        'description' => 'Turnuva katılımcıları kesinleştiğinde tüm takımlar burada listelenecektir.'
                    ])
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-x-4 gap-y-6 sm:gap-x-5 sm:gap-y-6 mt-5">
                    @foreach ($teamsForGrid as $team)
                        @php
                            $teamName = $team->name ?? '';
                        @endphp
                        <div class="team-card-wrapper"
                             data-name="{{ e($teamName) }}"
                             x-show="matches($el)"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translateY(10px)"
                             x-transition:enter-end="opacity-100 translateY(0)">
                            @include('worldcup.partials.team-card', ['team' => $team])
                        </div>
                    @endforeach
                </div>

                <div x-show="search.trim() !== '' && visibleCount === 0" class="mt-16">
                    @include('worldcup.partials.wc-empty-state', [
                        'title' => 'Sonuç bulunamadı',
                        'description' => 'Seçtiğiniz filtreler veya arama terimi ile eşleşen bir takım bulamadık.'
                    ])
                </div>
            @endif
        </section>
    </div>

@endsection

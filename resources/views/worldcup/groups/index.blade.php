{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — GRUPLAR & PUAN DURUMU
    Route: /dunya-kupasi/gruplar
    ══════════════════════════════════════════════════════════════
--}}

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
@endphp

@section('title', 'Gruplar — ' . $pageTitleWithYear . ' — CADDE1905')

@section('worldcup-content')

    @php
        $filters = $filters ?? [];
        $groups = $groups ?? [];
        $groupFilters = $filters['groups'] ?? [];
        $groupFilters = collect($groupFilters)->filter()->unique()->values()->all();
        array_unshift($groupFilters, 'Tümü');
        $groupsForGrid = !empty($groups) && count($groups) > 0 ? $groups : [];
    @endphp

    <div class="wc-container" x-data="{ activeGroup: 'Tümü' }">
        <section class="wc-section wc-section--compact wc-section--compact-top">

            <header class="wc-page-header">
                <h1 class="wc-page-title">Gruplar & Puan Durumu</h1>
                <p class="wc-page-subtitle">{{ $pageTitleWithYear }} — 12 grup, 48 takım</p>
                <div class="wc-page-divider"></div>
            </header>

            @if (!empty($groupFilters))
                <div class="mb-8">
                    <div class="flex flex-wrap items-center gap-2">
                        @foreach ($groupFilters as $filter)
                            @php
                                $filterCode = $filter === 'Tümü' ? 'Tümü' : strtoupper(trim(str_replace('Grup', '', $filter)));
                            @endphp
                            <button @click="activeGroup = '{{ $filterCode }}'"
                                    class="px-4 py-1.5 rounded-lg text-xs font-extrabold border transition-all"
                                    :class="activeGroup === '{{ $filterCode }}'
                                        ? 'bg-[var(--accent-gold)] border-[var(--accent-gold)] text-[#0c0c0c] shadow-lg shadow-[var(--accent-gold)]/20'
                                        : 'bg-transparent border-[var(--border-soft)] text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:border-[var(--border-highlight)]/40'">
                                {{ $filter === 'Tümü' ? 'Tümü' : 'Grup ' . $filter }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (empty($groupsForGrid) || count($groupsForGrid) === 0)
                <div class="py-20">
                    @include('worldcup.partials.wc-empty-state', [
                        'title' => 'Grup aşaması bekleniyor',
                        'description' => 'Turnuva kuraları çekildiğinde tüm gruplar ve puan durumları burada listelenecektir.'
                    ])
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($groupsForGrid as $group)
                        @php
                            $groupName = $group->name ?? $group->code ?? '';
                            $groupCode = strtoupper(trim(str_replace('Grup', '', $groupName)));
                        @endphp
                        <div x-show="activeGroup === 'Tümü' || activeGroup === '{{ $groupCode }}'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translateY(10px)"
                                x-transition:enter-end="opacity-100 translateY(0)">
                            @include('worldcup.partials.group-table', ['group' => $group])
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-12 flex flex-wrap items-center gap-8 p-6 bg-[var(--surface-widget)] border border-[var(--border-soft)] rounded-2xl">
                <div class="flex items-center gap-3">
                    <span class="w-4 h-4 rounded-md bg-[#1D6F42] shadow-sm shadow-[#1D6F42]/30"></span>
                    <span class="text-[11px] font-black text-[var(--text-primary)] uppercase tracking-wider">Son 32 turuna katılır</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-4 h-4 rounded-md bg-[var(--accent-gold)] shadow-sm shadow-[var(--accent-gold)]/30"></span>
                    <span class="text-[11px] font-black text-[var(--text-primary)] uppercase tracking-wider">En iyi 3. kontenjanı</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-4 h-4 rounded-md bg-[var(--border-soft)]"></span>
                    <span class="text-[11px] font-black text-[var(--text-muted)] uppercase tracking-wider">Elenir</span>
                </div>
            </div>
        </section>
    </div>
@endsection

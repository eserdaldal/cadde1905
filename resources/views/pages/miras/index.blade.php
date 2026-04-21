@extends('layouts.app')

@php
    \Carbon\Carbon::setLocale('tr');
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/miras-timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/miras-page.css') }}">
@endpush

@section('content')
<div class="miras-page miras-page--museum">

{{-- HERO --}}
<div class="miras-hero">
    <div class="miras-hero-content">
        <div class="miras-hero-visual">
            <img src="{{ asset('images/miras-hero-archive-v3.webp') }}" alt="Miras arşivi görseli" class="miras-hero-media">
            <p class="miras-hero-text">Galatasaray tarihindeki unutulmaz anlar, efsaneler ve kupalar; küratöryel seçkiler ve kronolojiyle bir arada.</p>
        </div>
    </div>
</div>

{{-- MIRASIN UC EKSENI --}}
<div class="miras-section">
    <div class="miras-section-hd">
        <h2 class="miras-sec-title">Mirasın Üç Ekseni</h2>
        <span class="text-xs font-semibold uppercase tracking-[0.4em] text-[var(--muted)]">Sana Özel Seçkiler</span>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- UNUTULMAZ ANLAR --}}
        <article class="group flex h-full flex-col gap-5 rounded-2xl border border-[var(--border)] bg-[var(--card)] p-6 shadow-[0_18px_34px_rgba(var(--bg-rgb),0.35)] transition hover:-translate-y-1 hover:border-[var(--yellow)]">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-[0.35em] text-[var(--muted)]">Unutulmaz Anlar</div>
                    <div class="mt-2 text-lg font-black text-[var(--text)]">Tarihin Nabzı</div>
                </div>
                <div class="miras-stat-badge rounded-full border border-[var(--border)] bg-[var(--card2)] px-3 py-1 text-xs font-bold text-[var(--yellow)]">
                    {{ $stats['moments'] ?? 0 }}
                </div>
            </div>
            <p class="text-sm text-[var(--muted)]">Dönüm noktaları, efsanevi maçlar ve unutulmaz anlar.</p>

            <div class="grid gap-3 miras-mini-grid">
                @if(isset($featuredMoments) && $featuredMoments->count() > 0)
                    @foreach($featuredMoments as $moment)
                        <a href="{{ route('miras.moments.show', $moment->slug) }}" class="miras-mini-card rounded-xl border border-transparent bg-[var(--surface-elevated)] p-3 text-[var(--text)] transition hover:border-[var(--yellow)] hover:shadow-[0_12px_24px_rgba(var(--bg-rgb),0.35)]">
                            <div class="miras-year-label text-[11px] font-bold uppercase tracking-[0.3em] text-[var(--yellow)]">{{ $moment->year }}</div>
                            <div class="mt-1 text-sm font-semibold">{{ $moment->title }}</div>
                        </a>
                    @endforeach
                @else
                    <div class="rounded-xl border border-[var(--border)] bg-[var(--card2)] p-3 text-xs text-[var(--muted)]">
                        Anlar arşivi hazırlanıyor.
                    </div>
                @endif
            </div>

            @if(isset($featuredMatch) && $featuredMatch)
                <a href="{{ route('miras.matches.show', $featuredMatch->slug) }}" class="rounded-xl border border-[var(--border)] bg-[var(--card2)] p-3 transition hover:border-[var(--yellow)] hover:shadow-[0_12px_24px_rgba(var(--bg-rgb),0.35)]">
                    <div class="text-[11px] font-bold uppercase tracking-[0.3em] text-[var(--muted)]">Tarihi Maç</div>
                    <div class="mt-1 text-sm font-semibold text-[var(--text)]">
                        {{ $featuredMatch->home_team_name }}
                        <span class="text-[var(--red)] font-black">{{ $featuredMatch->home_score }} - {{ $featuredMatch->away_score }}</span>
                        {{ $featuredMatch->away_team_name }}
                    </div>
                    <div class="mt-1 text-xs text-[var(--muted)]">
                        {{ \Carbon\Carbon::parse($featuredMatch->match_date)->format('d.m.Y') }} &middot; {{ $featuredMatch->competition_name }}
                    </div>
                </a>
            @endif

            <div class="miras-quicklinks mt-auto flex flex-wrap gap-3 text-[11px] font-bold uppercase tracking-[0.3em]">
                <a href="{{ route('miras.moments.index') }}" class="miras-quicklink text-[var(--yellow)] transition hover:text-[var(--red)]">Anlar</a>
                <a href="{{ route('miras.matches.index') }}" class="miras-quicklink text-[var(--yellow)] transition hover:text-[var(--red)]">Maçlar</a>
                <a href="{{ route('miras.achievements.index') }}" class="miras-quicklink text-[var(--yellow)] transition hover:text-[var(--red)]">Başarılar</a>
            </div>
        </article>

        {{-- UNUTULMAZ EFSANELER --}}
        <article class="group flex h-full flex-col gap-5 rounded-2xl border border-[var(--border)] bg-[var(--card)] p-6 shadow-[0_18px_34px_rgba(var(--bg-rgb),0.35)] transition hover:-translate-y-1 hover:border-[var(--yellow)]">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-[0.35em] text-[var(--muted)]">Unutulmaz Efsaneler</div>
                    <div class="mt-2 text-lg font-black text-[var(--text)]">Saygı Kuşağı</div>
                </div>
                <div class="miras-stat-badge rounded-full border border-[var(--border)] bg-[var(--card2)] px-3 py-1 text-xs font-bold text-[var(--yellow)]">
                    {{ $stats['legends'] ?? 0 }}
                </div>
            </div>
            <p class="text-sm text-[var(--muted)]">Kulübün karakterini ve ruhunu taşıyan isimler.</p>

            <div class="grid gap-3 miras-mini-grid">
                @if(isset($featuredLegends) && $featuredLegends->count() > 0)
                    @foreach($featuredLegends as $legend)
                        <a href="{{ route('miras.legends.show', $legend->slug) }}" class="miras-mini-card rounded-xl border border-[var(--border)] bg-[var(--card2)] p-4 transition hover:border-[var(--yellow)] hover:shadow-[0_12px_24px_rgba(var(--bg-rgb),0.35)]">
                            <div class="text-[11px] font-bold uppercase tracking-[0.3em] text-[var(--muted)]">
                                Dönem: {{ $legend->era_start_year }} - {{ $legend->era_end_year ?? 'Sonsuz' }}
                            </div>
                            <div class="mt-1 text-sm font-semibold text-[var(--text)]">{{ $legend->name }}</div>
                            @if($legend->role)
                                <div class="mt-2 text-[10px] font-bold uppercase tracking-[0.3em] text-[var(--yellow)]">
                                    {{ $legend->role }}
                                </div>
                            @endif
                        </a>
                    @endforeach
                @else
                    <div class="rounded-xl border border-[var(--border)] bg-[var(--card2)] p-3 text-xs text-[var(--muted)]">
                        Efsaneler galerisi hazırlanıyor.
                    </div>
                @endif
            </div>

            <div class="miras-quicklinks mt-auto flex flex-wrap gap-3 text-[11px] font-bold uppercase tracking-[0.3em]">
                <a href="{{ route('miras.legends.index') }}" class="miras-quicklink text-[var(--yellow)] transition hover:text-[var(--red)]">Efsaneler</a>
            </div>
        </article>

        {{-- UNUTULMAZ KUPALAR --}}
        <article class="group flex h-full flex-col gap-5 rounded-2xl border border-[var(--border)] bg-[var(--card)] p-6 shadow-[0_18px_34px_rgba(var(--bg-rgb),0.35)] transition hover:-translate-y-1 hover:border-[var(--yellow)]">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-[0.35em] text-[var(--muted)]">Unutulmaz Kupalar</div>
                    <div class="mt-2 text-lg font-black text-[var(--text)]">Sergideki Taçlar</div>
                </div>
                <div class="miras-stat-badge rounded-full border border-[var(--border)] bg-[var(--card2)] px-3 py-1 text-xs font-bold text-[var(--yellow)]">
                    {{ $stats['trophies'] ?? 0 }}
                </div>
            </div>
            <p class="text-sm text-[var(--muted)]">Sarı-kırmızının vitrindeki tarihçesi ve gurur anları.</p>

            <div class="grid gap-3 miras-mini-grid">
                @if(isset($featuredTrophies) && $featuredTrophies->count() > 0)
                    @foreach($featuredTrophies as $trophy)
                        <a href="{{ route('miras.trophies.show', $trophy->slug) }}" class="miras-mini-card rounded-xl border border-transparent bg-[var(--surface-elevated)] p-3 text-[var(--text)] transition hover:border-[var(--yellow)] hover:shadow-[0_12px_24px_rgba(var(--bg-rgb),0.35)]">
                            <div class="text-sm font-semibold">{{ $trophy->name }}</div>
                            <div class="mt-1 text-xs text-[var(--muted)]">{{ $trophy->description ?? 'Müzenin kıymetli parçası' }}</div>
                        </a>
                    @endforeach
                @else
                    <div class="rounded-xl border border-[var(--border)] bg-[var(--card2)] p-3 text-xs text-[var(--muted)]">
                        Kupa sergisi hazırlıkta.
                    </div>
                @endif
            </div>

            @if(isset($featuredAchievement) && $featuredAchievement)
                <a href="{{ route('miras.achievements.show', $featuredAchievement->slug) }}" class="rounded-xl border border-[var(--border)] bg-[var(--card2)] p-4 transition hover:border-[var(--yellow)] hover:shadow-[0_12px_24px_rgba(var(--bg-rgb),0.35)]">
                    <div class="text-[11px] font-bold uppercase tracking-[0.3em] text-[var(--muted)]">Büyük Zafer</div>
                    <div class="mt-1 text-sm font-semibold text-[var(--text)]">{{ $featuredAchievement->title }}</div>
                    <div class="mt-1 text-xs text-[var(--muted)]">{{ \Carbon\Carbon::parse($featuredAchievement->event_date)->format('d.m.Y') }}</div>
                </a>
            @endif

            <div class="miras-quicklinks mt-auto flex flex-wrap gap-3 text-[11px] font-bold uppercase tracking-[0.3em]">
                <a href="{{ route('miras.trophies.index') }}" class="miras-quicklink text-[var(--yellow)] transition hover:text-[var(--red)]">Kupalar</a>
                <a href="{{ route('miras.achievements.index') }}" class="miras-quicklink text-[var(--yellow)] transition hover:text-[var(--red)]">Başarılar</a>
            </div>
        </article>
    </div>
</div>

{{-- KRONOLOJI / TIMELINE --}}
<div class="miras-section">
    <div class="miras-section-hd">
        <h2 class="miras-sec-title">Kronoloji</h2>
        <a href="{{ route('timeline.index') }}" class="miras-sec-link">Tüm Zaman Tüneli &rarr;</a>
    </div>

    @php
        $timelineCount = isset($timelineEntries) ? $timelineEntries->count() : 0;
    @endphp

    <div class="miras-timeline {{ $timelineCount < 3 ? 'miras-timeline--compact' : '' }}">
        <span class="miras-timeline__line"></span>

        @if(isset($timelineEntries) && $timelineEntries->count() > 0)
            @foreach($timelineEntries as $entry)
                @php
                    $side = $loop->index % 2 === 0 ? 'left' : 'right';
                    $entryDate = $entry->timeline_date;
                    $entryYear = $entryDate ? $entryDate->format('Y') : 'Bilinmeyen';
                    $entryDay = $entryDate ? $entryDate->translatedFormat('d F') : 'Tarih Belirsiz';
                    $detailUrl = $entry->detailUrl();
                @endphp

                <article class="miras-timeline__item {{ $side }}">
                    <span class="miras-timeline__dot"></span>
                    <span class="miras-timeline__connector"></span>

                    @if($detailUrl)
                        <a href="{{ $detailUrl }}" class="miras-timeline__card">
                    @else
                        <div class="miras-timeline__card">
                    @endif
                            <div class="miras-timeline__year">{{ $entryYear }}</div>
                            <div class="miras-timeline__meta">
                                <span>{{ $entryDay }}</span>
                                <span class="miras-timeline__separator">•</span>
                                <span>{{ $entry->type_label }}</span>
                                @if($entry->source_label)
                                    <span class="miras-timeline__separator">•</span>
                                    <span>{{ $entry->source_label }}</span>
                                @endif
                            </div>
                            <div class="miras-timeline__title">{{ $entry->title }}</div>
                            @if($entry->excerpt)
                                <div class="miras-timeline__excerpt">{{ $entry->excerpt }}</div>
                            @endif
                            <div class="miras-timeline__cta">Detaya Git →</div>
                    @if($detailUrl)
                        </a>
                    @else
                        </div>
                    @endif
                </article>
            @endforeach
        @else
            <div class="miras-timeline__empty">Kronoloji içerikleri hazırlanıyor.</div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/miras-page.js') }}" defer></script>
@endpush

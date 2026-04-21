@extends('layouts.app')

@section('content')
@php
    function highlight($text, $q) {
        if (!$q) return e($text);
        return preg_replace('/(' . preg_quote($q, '/') . ')/i', '<mark class="search-mark">$1</mark>', e($text));
    }

    $counts = $counts ?? [
        'all' => 0,
        'Haber' => 0,
        'Efsane' => 0,
        'Kupa' => 0,
        'Sezon' => 0,
        'Tarihi Maç' => 0,
    ];

    $typeMap = $typeMap ?? [
        'all' => 'Tümü',
        'Haber' => 'Haberler',
        'Efsane' => 'Efsaneler',
        'Kupa' => 'Kupalar',
        'Sezon' => 'Sezonlar',
        'Tarihi Maç' => 'Tarihi Maçlar',
    ];

    $activeType = $activeType ?? request('type', 'all');
    $hasQuery = trim((string) $query) !== '';
    $totalCount = method_exists($results, 'total') ? $results->total() : count($results);
    $currentCount = method_exists($results, 'count') ? $results->count() : count($results);
    $activeLabel = $typeMap[$activeType] ?? 'Tümü';

    $badgeClasses = [
        'Haber' => 'search-badge search-badge--news',
        'Efsane' => 'search-badge search-badge--legend',
        'Kupa' => 'search-badge search-badge--trophy',
        'Sezon' => 'search-badge search-badge--season',
        'Tarihi Maç' => 'search-badge search-badge--match',
    ];
@endphp

<style>
    .search-shell {
        max-width: 920px;
        margin: 0 auto;
        padding: 28px 16px 40px;
    }

    .search-hero {
        background: linear-gradient(135deg, rgba(var(--accent-primary-rgb), .10), transparent 48%), var(--surface-card);
        border: 1px solid var(--border-default);
        border-radius: var(--radius-lg);
        padding: 22px 20px;
        box-shadow: var(--shadow-base);
        margin-bottom: 20px;
    }

    .search-kicker {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--accent-primary);
        margin-bottom: 8px;
    }

    .search-title {
        font-size: clamp(1.55rem, 2.2vw, 2.15rem);
        line-height: 1.1;
        font-weight: 900;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .search-subtitle {
        color: var(--text-secondary);
        font-size: .96rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .search-query {
        color: var(--text-primary);
        font-weight: 800;
    }

    .search-form {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-form-input {
        flex: 1 1 340px;
        min-width: 0;
        height: 48px;
        padding: 0 16px;
        border-radius: 999px;
        border: 1px solid var(--border-default);
        background: var(--surface-base);
        color: var(--text-primary);
        transition: .2s ease;
    }

    .search-form-input::placeholder {
        color: var(--text-muted);
    }

    .search-form-input:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px rgba(var(--accent-primary-rgb), .12);
    }

    .search-form-button {
        height: 48px;
        padding: 0 18px;
        border-radius: 999px;
        border: 1px solid var(--accent-primary);
        background: rgba(var(--accent-primary-rgb), .10);
        color: var(--text-primary);
        font-weight: 800;
        cursor: pointer;
        transition: .2s ease;
    }

    .search-form-button:hover {
        background: rgba(var(--accent-primary-rgb), .16);
    }

    .search-summary {
        margin-bottom: 16px;
        padding: 12px 14px;
        border: 1px solid var(--border-default);
        border-radius: var(--radius-md);
        background: var(--surface-card);
        color: var(--text-secondary);
        box-shadow: var(--shadow-base);
        font-size: .94rem;
        line-height: 1.6;
    }

    .search-summary strong {
        color: var(--text-primary);
    }

    .search-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
    }

    .search-filter {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        border: 1px solid var(--border-default);
        background: var(--surface-card);
        color: var(--text-secondary);
        text-decoration: none;
        font-size: .9rem;
        font-weight: 700;
        transition: .2s ease;
    }

    .search-filter:hover {
        background: var(--hover-surface);
        border-color: var(--hover-border);
        color: var(--text-primary);
    }

    .search-filter.is-active {
        background: var(--selected-surface);
        border-color: var(--selected-border);
        color: var(--text-primary);
    }

    .search-filter-count {
        color: var(--text-muted);
        font-size: .82rem;
        font-weight: 800;
    }

    .search-results {
        display: grid;
        gap: 14px;
    }

    .search-card {
        display: block;
        padding: 18px 18px 16px;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-default);
        background: var(--surface-card);
        color: inherit;
        text-decoration: none;
        box-shadow: var(--shadow-base);
        transition: .22s ease;
    }

    .search-card:hover {
        transform: translateY(-1px);
        background: var(--hover-surface);
        border-color: var(--hover-border);
        box-shadow: var(--shadow-elevated);
    }

    .search-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
    }

    .search-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 999px;
        border: 1px solid var(--border-soft);
        background: var(--surface-elevated);
        color: var(--text-secondary);
        font-size: .75rem;
        font-weight: 800;
        letter-spacing: .02em;
    }

    .search-badge::before {
        content: "";
        width: 7px;
        height: 7px;
        border-radius: 999px;
        background: var(--accent-primary);
        opacity: .95;
    }

    .search-badge--legend::before { background: var(--accent-highlight); }
    .search-badge--trophy::before { background: var(--accent-premium); }
    .search-badge--season::before { background: var(--accent-primary); }
    .search-badge--match::before { background: var(--accent-highlight); }

    .search-date {
        color: var(--text-muted);
        font-size: .8rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .search-card-title {
        color: var(--text-primary);
        font-size: 1.08rem;
        line-height: 1.3;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .search-card-excerpt {
        color: var(--text-secondary);
        font-size: .94rem;
        line-height: 1.65;
    }

    .search-empty {
        padding: 22px 18px;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-default);
        background: var(--surface-card);
        box-shadow: var(--shadow-base);
    }

    .search-empty-title {
        color: var(--text-primary);
        font-size: 1.05rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .search-empty-text {
        color: var(--text-secondary);
        line-height: 1.7;
        font-size: .95rem;
    }

    .search-empty-list {
        margin-top: 10px;
        padding-left: 18px;
        color: var(--text-muted);
        font-size: .92rem;
        line-height: 1.8;
    }

    .search-mark {
        background: rgba(var(--accent-primary-rgb), .18);
        color: var(--text-primary);
        padding: 0 2px;
        border-radius: 3px;
        font-weight: 800;
    }

    .search-pagination-wrap {
        margin-top: 22px;
        display: flex;
        justify-content: center;
    }

    .search-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .search-page-btn,
    .search-page-current,
    .search-page-sep {
        min-width: 42px;
        height: 42px;
        padding: 0 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        border: 1px solid var(--border-default);
        background: var(--surface-card);
        color: var(--text-secondary);
        text-decoration: none;
        font-size: .92rem;
        font-weight: 800;
        box-shadow: var(--shadow-base);
    }

    .search-page-btn:hover {
        background: var(--hover-surface);
        border-color: var(--hover-border);
        color: var(--text-primary);
    }

    .search-page-current {
        background: var(--selected-surface);
        border-color: var(--selected-border);
        color: var(--text-primary);
    }

    .search-page-sep {
        min-width: auto;
        padding: 0 6px;
        border: 0;
        background: transparent;
        box-shadow: none;
    }

    @media (max-width: 640px) {
        .search-shell {
            padding-top: 18px;
        }

        .search-card-top {
            align-items: flex-start;
            flex-direction: column;
        }

        .search-date {
            white-space: normal;
        }

        .search-form {
            flex-direction: column;
            align-items: stretch;
        }

        .search-form-button,
        .search-form-input {
            width: 100%;
        }

        .search-pagination {
            gap: 8px;
        }

        .search-page-btn,
        .search-page-current {
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
        }
    }
</style>

<div class="search-shell">
    <section class="search-hero">
        <div class="search-kicker">Site İçi Arama</div>
        <h1 class="search-title">
            @if($hasQuery)
                "<span class="search-query">{{ $query }}</span>" için sonuçlar
            @else
                Site içinde arama
            @endif
        </h1>
        <p class="search-subtitle">
            Tüm içerik tiplerinde arama yapılır. Sonuçlar başlık, özet ve içerik eşleşmesine göre sıralanır.
        </p>

        <form action="{{ route('search.index') }}" method="GET" class="search-form">
            <input
                type="text"
                name="q"
                value="{{ $query }}"
                placeholder="Ara..."
                autocomplete="off"
                class="search-form-input"
                onfocus="if(!this.dataset.cleared){this.dataset.cleared='1';this.value='';}"
            >
            @if($activeType !== 'all')
                <input type="hidden" name="type" value="{{ $activeType }}">
            @endif
            <button type="submit" class="search-form-button">Ara</button>
        </form>
    </section>

    @if($hasQuery)
        <div class="search-summary">
            <strong>{{ $totalCount }}</strong> toplam sonuç ·
            bu sayfada <strong>{{ $currentCount }}</strong> sonuç ·
            görünüm <strong>{{ $activeLabel }}</strong>
        </div>
    @else
        <div class="search-summary">
            Aramak istediğin ismi, sezonu, kupayı, efsaneyi veya tarihi maçı yaz.
        </div>
    @endif

    <nav class="search-toolbar" aria-label="Arama filtreleri">
        @foreach($typeMap as $typeKey => $label)
            <a
                href="{{ route('search.index', ['q' => $query, 'type' => $typeKey]) }}"
                class="search-filter {{ $activeType === $typeKey ? 'is-active' : '' }}"
            >
                <span>{{ $label }}</span>
                <span class="search-filter-count">{{ $counts[$typeKey] ?? 0 }}</span>
            </a>
        @endforeach
    </nav>

    @if(!$hasQuery)
        <section class="search-empty">
            <div class="search-empty-title">Arama başlatılmadı</div>
            <div class="search-empty-text">
                Henüz bir anahtar kelime girilmedi.
            </div>
            <ul class="search-empty-list">
                <li>Örnek: Fatih Terim</li>
                <li>Örnek: UEFA Kupası</li>
                <li>Örnek: 2000</li>
                <li>Örnek: Real Madrid</li>
            </ul>
        </section>
    @elseif($results->isEmpty())
        <section class="search-empty">
            <div class="search-empty-title">Sonuç bulunamadı</div>
            <div class="search-empty-text">
                "<strong>{{ $query }}</strong>" için eşleşen içerik bulunamadı.
            </div>
            <ul class="search-empty-list">
                <li>Daha kısa bir ifade dene</li>
                <li>Sadece soyad veya anahtar kelime ile ara</li>
                <li>Filtreyi “Tümü” konumuna getir</li>
            </ul>
        </section>
    @else
        <section class="search-results">
            @foreach($results as $item)
                <a href="{{ $item['url'] }}" class="search-card">
                    <div class="search-card-top">
                        <span class="{{ $badgeClasses[$item['type']] ?? 'search-badge' }}">
                            {{ $item['type'] }}
                        </span>

                        @if(!empty($item['date']))
                            <span class="search-date">{{ $item['date'] }}</span>
                        @endif
                    </div>

                    <div class="search-card-title">{!! highlight($item['title'], $query) !!}</div>

                    @if(!empty($item['excerpt']))
                        <div class="search-card-excerpt">{!! highlight($item['excerpt'], $query) !!}</div>
                    @endif
                </a>
            @endforeach
        </section>

        @if(method_exists($results, 'currentPage') && $results->lastPage() > 1)
            @php
                $currentPage = $results->currentPage();
                $lastPage = $results->lastPage();
                $startPage = max(1, $currentPage - 1);
                $endPage = min($lastPage, $currentPage + 1);
            @endphp

            <div class="search-pagination-wrap">
                <nav class="search-pagination" aria-label="Arama sayfaları">
                    @if($results->onFirstPage())
                        <span class="search-page-current">‹</span>
                    @else
                        <a class="search-page-btn" href="{{ $results->previousPageUrl() }}">‹</a>
                    @endif

                    @if($startPage > 1)
                        <a class="search-page-btn" href="{{ $results->url(1) }}">1</a>
                        @if($startPage > 2)
                            <span class="search-page-sep">…</span>
                        @endif
                    @endif

                    @for($page = $startPage; $page <= $endPage; $page++)
                        @if($page === $currentPage)
                            <span class="search-page-current">{{ $page }}</span>
                        @else
                            <a class="search-page-btn" href="{{ $results->url($page) }}">{{ $page }}</a>
                        @endif
                    @endfor

                    @if($endPage < $lastPage)
                        @if($endPage < $lastPage - 1)
                            <span class="search-page-sep">…</span>
                        @endif
                        <a class="search-page-btn" href="{{ $results->url($lastPage) }}">{{ $lastPage }}</a>
                    @endif

                    @if($results->hasMorePages())
                        <a class="search-page-btn" href="{{ $results->nextPageUrl() }}">›</a>
                    @else
                        <span class="search-page-current">›</span>
                    @endif
                </nav>
            </div>
        @endif
    @endif
</div>
@endsection

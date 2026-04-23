@props(['paginator' => null])

@php
    $pagination = $paginator instanceof \Illuminate\Contracts\Pagination\Paginator ? $paginator : null;
    $desktopPaginator = $pagination && method_exists($pagination, 'onEachSide')
        ? $pagination->onEachSide(1)
        : $pagination;
    $desktopLinks = ($desktopPaginator && method_exists($desktopPaginator, 'linkCollection'))
        ? $desktopPaginator->linkCollection()
            ->filter(function ($link) {
                $label = trim(strip_tags((string) data_get($link, 'label', '')));

                return is_numeric($label);
            })
            ->values()
        : collect();
    $from = ($desktopPaginator && method_exists($desktopPaginator, 'firstItem'))
        ? ($desktopPaginator->firstItem() ?? 0)
        : 0;
    $to = ($desktopPaginator && method_exists($desktopPaginator, 'lastItem'))
        ? ($desktopPaginator->lastItem() ?? 0)
        : 0;
    $total = ($desktopPaginator && method_exists($desktopPaginator, 'total'))
        ? $desktopPaginator->total()
        : 0;
@endphp

@if ($pagination && $pagination->lastPage() > 1)
    <div class="mt-10">
        <div class="md:hidden space-y-3">
            @if ($pagination->onFirstPage())
                <div class="grid grid-cols-1 gap-3">
                    <a href="{{ $pagination->nextPageUrl() }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-[var(--border-soft)] bg-[var(--surface-widget)] px-4 py-3 text-[11px] font-black uppercase tracking-wider text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                        Sonraki Sayfa
                    </a>
                </div>
            @elseif ($pagination->hasMorePages())
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ $pagination->previousPageUrl() }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-[var(--border-soft)] bg-[var(--surface-widget)] px-4 py-3 text-[11px] font-black uppercase tracking-wider text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                        Önceki Sayfa
                    </a>
                    <a href="{{ $pagination->nextPageUrl() }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-[var(--border-soft)] bg-[var(--surface-widget)] px-4 py-3 text-[11px] font-black uppercase tracking-wider text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                        Sonraki Sayfa
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-3">
                    <a href="{{ $pagination->previousPageUrl() }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-[var(--border-soft)] bg-[var(--surface-widget)] px-4 py-3 text-[11px] font-black uppercase tracking-wider text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                        Önceki Sayfa
                    </a>
                </div>
            @endif
        </div>

        <div class="hidden md:block">
            <div class="rounded-2xl border border-[var(--border-soft)] bg-[var(--surface-widget)] px-4 py-3">
                <div class="flex items-center justify-between gap-4">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)]">
                        {{ $from }}-{{ $to }} / {{ $total }} maç
                    </p>

                    <nav class="flex items-center gap-1" aria-label="Maçlar sayfalama">
                        @if ($desktopPaginator)
                            @if ($desktopPaginator->onFirstPage())
                                @if ($desktopPaginator->hasMorePages())
                                    <a href="{{ $desktopPaginator->nextPageUrl() }}"
                                       class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-[var(--border-soft)] px-3 text-xs font-black uppercase tracking-wider text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                                        İleri
                                    </a>
                                @endif
                            @elseif ($desktopPaginator->hasMorePages())
                                <a href="{{ $desktopPaginator->previousPageUrl() }}"
                                   class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-[var(--border-soft)] px-3 text-xs font-black uppercase tracking-wider text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                                    Geri
                                </a>

                                @foreach ($desktopLinks as $link)
                                    @php
                                        $pageLabel = trim(strip_tags((string) data_get($link, 'label', '')));
                                        $pageUrl = data_get($link, 'url');
                                        $isActive = (bool) data_get($link, 'active', false);
                                    @endphp
                                    @if ($isActive)
                                        <span class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-[var(--accent-premium)] bg-[var(--surface-base)] px-3 text-xs font-black text-[var(--accent-premium)]">
                                            {{ $pageLabel }}
                                        </span>
                                    @elseif ($pageUrl)
                                        <a href="{{ $pageUrl }}"
                                           class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-[var(--border-soft)] px-3 text-xs font-black text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                                            {{ $pageLabel }}
                                        </a>
                                    @endif
                                @endforeach

                                <a href="{{ $desktopPaginator->nextPageUrl() }}"
                                   class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-[var(--border-soft)] px-3 text-xs font-black uppercase tracking-wider text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                                    İleri
                                </a>
                            @else
                                <a href="{{ $desktopPaginator->previousPageUrl() }}"
                                   class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-[var(--border-soft)] px-3 text-xs font-black uppercase tracking-wider text-[var(--text-primary)] transition hover:border-[var(--accent-premium)] hover:text-[var(--accent-premium)]">
                                    Geri
                                </a>
                            @endif
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endif

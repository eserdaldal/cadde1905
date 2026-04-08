{{--
    PARTIAL: stat-card.blade.php
    Mini istatistik kartı. Landing ve stats sayfasında kullanılır.
--}}

@props([
    'icon'       => '⚽',
    'title'      => 'İstatistik',
    'value'      => '—',
    'playerName' => 'Turnuva başlamadı',
    'highlight'  => false,
])

<div class="wc-card {{ $highlight ? 'wc-card--highlight' : '' }} p-5">
    <div class="flex items-center gap-2 mb-4">
        <span class="text-xl shadow-lg">{{ $icon }}</span>
        <h4 class="text-[10px] font-black text-[var(--text-muted)] uppercase tracking-widest">{{ $title }}</h4>
    </div>
    <div class="text-3xl font-black text-white leading-none tabular-nums">{{ $value }}</div>
    <div class="mt-3 text-xs font-bold text-[var(--text-secondary)] border-l-2 border-[var(--accent-premium)]/40 pl-2">
        {{ $playerName }}
    </div>
</div>

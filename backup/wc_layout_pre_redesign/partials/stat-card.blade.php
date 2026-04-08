{{--
    PARTIAL: stat-card.blade.php
    Mini istatistik kartı. Landing ve stats sayfasında kullanılır.
--}}

@props([
    'icon'       => '⚽',
    'title'      => 'İstatistik',
    'value'      => '—',
    'playerName' => 'Turnuva başlamadı',
])

<div class="block p-4 bg-white/5 border border-white/10 rounded-xl">
    <div class="flex items-center gap-2 mb-3">
        <span class="text-[#D4AF37]">{{ $icon }}</span>
        <h4 class="text-xs font-medium text-white/60 uppercase tracking-wider">{{ $title }}</h4>
    </div>
    <div class="text-xl font-bold text-white">{{ $value }}</div>
    <div class="mt-1 text-sm text-white/60">{{ $playerName }}</div>
</div>

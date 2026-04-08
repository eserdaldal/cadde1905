{{--
    PARTIAL: stadium-card.blade.php
    Tekil stadyum kartı. Stadyumlar ve landing sayfasında kullanılır.
--}}

@props(['stadium' => null])

@if (!empty($stadium) && is_object($stadium))
    <a href="{{ route('worldcup.stadiums.show', $stadium->slug) }}"
       class="block p-4 bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10 overflow-hidden">

        <div class="flex items-center justify-center aspect-video bg-white/[0.03] -mx-4 -mt-4 mb-3">
            <span class="text-4xl opacity-20">🏟️</span>
        </div>

        <h3 class="text-sm font-semibold text-white">{{ $stadium->name }}</h3>
        <div class="flex items-center gap-2 mt-1.5 text-xs text-white/60">
            <span>{{ $stadium->city }}, {{ $stadium->country }}</span>
            <span>·</span>
            <span>{{ number_format($stadium->capacity) }} kişilik</span>
        </div>
    </a>

@elseif (!empty($stadium) && is_array($stadium))
    <a href="#"
       class="block p-4 bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10 overflow-hidden">

        <div class="flex items-center justify-center aspect-video bg-white/[0.03] -mx-4 -mt-4 mb-3">
            <span class="text-4xl opacity-20">🏟️</span>
        </div>

        <h3 class="text-sm font-semibold text-white">{{ $stadium['name'] ?? 'Stadyum' }}</h3>
        <div class="flex items-center gap-2 mt-1.5 text-xs text-white/60">
            <span>{{ $stadium['city'] ?? 'Şehir' }}, {{ $stadium['country'] ?? 'Ülke' }}</span>
            <span>·</span>
            <span>{{ isset($stadium['capacity']) ? number_format($stadium['capacity']) : '—' }} kişilik</span>
        </div>
    </a>

@else
    <a href="#"
       class="block p-4 bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10 overflow-hidden">

        <div class="flex items-center justify-center aspect-video bg-white/[0.03] -mx-4 -mt-4 mb-3">
            <span class="text-4xl opacity-20">🏟️</span>
        </div>

        <h3 class="text-sm font-semibold text-white">Stadyum Adı</h3>
        <div class="flex items-center gap-2 mt-1.5 text-xs text-white/60">
            <span>Şehir, Ülke</span>
            <span>·</span>
            <span>— kişilik</span>
        </div>
    </a>
@endif

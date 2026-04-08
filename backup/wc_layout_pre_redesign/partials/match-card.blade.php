{{--
    PARTIAL: match-card.blade.php
    Tekil maç kartı. Maç listesi ve landing page'de kullanılır.
--}}

@props(['match' => null])

@if (!empty($match))
    <a href="{{ route('worldcup.matches.show', $match->id) }}"
       class="block p-4 bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10">

        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 uppercase tracking-wider">
                {{ $match->round ?? 'Grup' }}
            </span>
            <span class="text-xs text-gray-500">
                {{ $match->date_label ?? '' }}
            </span>
        </div>

        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-2 flex-1 min-w-0">
                <div class="flex items-center justify-center w-8 h-8 bg-white/10 rounded-full flex-shrink-0 overflow-hidden">
                    @if ($match->homeTeam?->flag_url)
                        <img src="{{ $match->homeTeam->flag_url }}" alt="" class="w-full h-full object-cover">
                    @else
                        <span>🏳️</span>
                    @endif
                </div>
                <span class="text-sm font-medium text-white truncate">
                    {{ $match->homeTeam?->name ?? 'Ev Sahibi' }}
                </span>
            </div>

            <div class="flex items-center gap-2 px-3 py-1 bg-white/5 rounded-lg flex-shrink-0">
                <span class="text-lg font-bold text-white tabular-nums">{{ $match->home_score ?? '–' }}</span>
                <span class="text-xs text-gray-600">:</span>
                <span class="text-lg font-bold text-white tabular-nums">{{ $match->away_score ?? '–' }}</span>
            </div>

            <div class="flex items-center gap-2 flex-1 min-w-0 justify-end">
                <span class="text-sm font-medium text-white truncate text-right">
                    {{ $match->awayTeam?->name ?? 'Deplasman' }}
                </span>
                <div class="flex items-center justify-center w-8 h-8 bg-white/10 rounded-full flex-shrink-0 overflow-hidden">
                    @if ($match->awayTeam?->flag_url)
                        <img src="{{ $match->awayTeam->flag_url }}" alt="" class="w-full h-full object-cover">
                    @else
                        <span>🏳️</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-3 text-xs text-gray-500 text-center">
            @if ($match->stadium?->name)
                {{ $match->stadium->name }}{{ $match->stadium->city ? ', ' . $match->stadium->city : '' }}
            @else
                Stadyum henüz açıklanmadı
            @endif
        </div>
    </a>
@else
    <a href="#"
       class="block p-4 bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10">

        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 uppercase tracking-wider">Grup A · Maç Günü 1</span>
            <span class="text-xs text-gray-500">12 Haz, 21:00</span>
        </div>

        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-2 flex-1 min-w-0">
                <div class="flex items-center justify-center w-8 h-8 text-lg bg-white/10 rounded-full flex-shrink-0">🇹🇷</div>
                <span class="text-sm font-medium text-white truncate">Türkiye</span>
            </div>
            <div class="flex items-center gap-2 px-3 py-1 bg-white/5 rounded-lg flex-shrink-0">
                <span class="text-lg font-bold text-white tabular-nums">–</span>
                <span class="text-xs text-gray-600">:</span>
                <span class="text-lg font-bold text-white tabular-nums">–</span>
            </div>
            <div class="flex items-center gap-2 flex-1 min-w-0 justify-end">
                <span class="text-sm font-medium text-white truncate text-right">Brezilya</span>
                <div class="flex items-center justify-center w-8 h-8 text-lg bg-white/10 rounded-full flex-shrink-0">🇧🇷</div>
            </div>
        </div>

        <div class="mt-3 text-xs text-gray-500 text-center">MetLife Stadium, New Jersey</div>
    </a>
@endif

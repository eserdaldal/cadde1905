{{--
    PARTIAL: player-card.blade.php
    Galatasaraylı oyuncu kartı. Dünya Kupası temalı.
--}}

@props(['player' => null])

@if ($player)
    <a href="{{ route('worldcup.aslanlar.show', $player->slug ?? '#') }}"
       class="wc-card wc-card--interactive block group relative p-4">

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-[var(--accent-premium)]/10 border border-[var(--accent-premium)]/20">
                <span class="text-[10px] font-bold text-[var(--accent-premium)]">GS #{{ $player->gs_squad_number ?? '—' }}</span>
            </div>
            <div class="text-xl opacity-80 group-hover:opacity-100 transition-opacity">
                {{ $player->nationalTeam->flag_emoji ?? '🏳️' }}
            </div>
        </div>

        <div class="text-center pb-2">
            <h3 class="text-white font-bold text-base truncate">{{ $player->name ?? 'Oyuncu' }}</h3>
            <p class="text-[var(--text-secondary)] text-[10px] uppercase tracking-widest mt-1">
                {{ $player->nationalTeam->name ?? 'Milli Takım' }}
            </p>
        </div>

        <div class="mt-4 flex items-center justify-center gap-2">
             <span class="text-[10px] text-[var(--text-muted)] font-medium px-2 py-0.5 rounded-md bg-white/5 uppercase">
                {{ $player->position ?? 'Mevki' }}
            </span>
        </div>
    </a>
@else
    <div class="wc-card block group relative p-6 text-center">
        <span class="text-gray-600">Veri bekleniyor</span>
    </div>
@endif

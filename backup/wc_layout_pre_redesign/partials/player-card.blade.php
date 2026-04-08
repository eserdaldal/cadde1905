{{--
    PARTIAL: player-card.blade.php
    Kupadaki Aslanlar oyuncu kartı.
--}}

@props(['player' => null])

@if (!empty($player) && is_object($player))
    <a href="{{ route('worldcup.aslanlar.show', $player->slug) }}"
       class="block p-4 bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10 relative overflow-hidden">

        <div class="flex items-center justify-center aspect-[3/4] bg-white/[0.03]">
            <span class="text-6xl opacity-30">🦁</span>
        </div>

        <div class="mt-3">
            <h3 class="text-sm font-semibold text-white">{{ $player->name }}</h3>
            <p class="mt-1 text-xs text-white/60">{{ $player->position }}</p>

            <div class="flex items-center gap-2 mt-3">
                <div class="w-5 h-5 bg-white/10 rounded-full overflow-hidden flex-shrink-0">
                    @if (isset($player->nationalTeam->flag_url) && $player->nationalTeam->flag_url)
                        <img src="{{ $player->nationalTeam->flag_url }}" alt="" class="w-full h-full object-cover">
                    @else
                        <span class="text-[10px] flex items-center justify-center h-full">🏳️</span>
                    @endif
                </div>
                <span class="text-xs text-white/60">{{ $player->nationalTeam->name ?? '' }}</span>
            </div>
        </div>

        <div class="absolute top-3 right-3 px-2 py-0.5 text-[10px] font-bold text-[#D4AF37] bg-[#D4AF37]/20 border border-[#D4AF37]/30 rounded-full">
            GS #{{ $player->gs_squad_number ?? '?' }}
        </div>
    </a>

@else
    <a href="#"
       class="block p-4 bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10 relative overflow-hidden">

        <div class="flex items-center justify-center aspect-[3/4] bg-white/[0.03]">
            <span class="text-6xl opacity-30">🦁</span>
        </div>

        <div class="mt-3">
            <h3 class="text-sm font-semibold text-white">Oyuncu Adı</h3>
            <p class="mt-1 text-xs text-white/60">Pozisyon</p>

            <div class="flex items-center gap-2 mt-3">
                <span class="text-lg">🇹🇷</span>
                <span class="text-xs text-white/60">Milli Takım</span>
            </div>
        </div>

        <div class="absolute top-3 right-3 px-2 py-0.5 text-[10px] font-bold text-[#D4AF37] bg-[#D4AF37]/20 border border-[#D4AF37]/30 rounded-full">
            GS #—
        </div>
    </a>
@endif

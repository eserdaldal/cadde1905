{{--
    PARTIAL: team-card.blade.php
    Tekil takım kartı. Takımlar listesinde kullanılır.
--}}

@props(['team' => null])

@if (!empty($team) && is_object($team))
    <a href="{{ route('worldcup.teams.show', $team->slug) }}"
       class="block p-4 text-center bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10">

        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-3 bg-white/10 rounded-full overflow-hidden border-2 border-white/5 flex-shrink-0">
            @if ($team->flag_url)
                <img src="{{ $team->flag_url }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
            @else
                <span class="text-3xl">🏳️</span>
            @endif
        </div>

        <h3 class="text-sm font-semibold text-white">{{ $team->name }}</h3>

        <div class="flex items-center justify-center gap-3 mt-2 text-xs text-white/60">
            <span>Grup {{ $team->group->name ?? '?' }}</span>
            <span>·</span>
            <span>FIFA #{{ $team->fifa_ranking ?? '–' }}</span>
        </div>

        <div class="mt-2 text-xs text-white/40">{{ $team->confederation ?? '' }}</div>
    </a>

@elseif (!empty($team) && is_array($team))
    <a href="#"
       class="block p-4 text-center bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10">

        <div class="text-4xl mb-3">{{ $team['flag'] ?? '🏳️' }}</div>

        <h3 class="text-sm font-semibold text-white">{{ $team['name'] ?? 'Takım' }}</h3>

        <div class="flex items-center justify-center gap-2 mt-2 text-xs text-white/60">
            <span>Grup {{ $team['group'] ?? '?' }}</span>
            <span>·</span>
            <span>#{{ $team['rank'] ?? '–' }}</span>
        </div>

        <div class="mt-1 text-[10px] text-white/40 uppercase tracking-wider">{{ $team['conf'] ?? '' }}</div>
    </a>

@else
    <a href="#"
       class="block p-4 text-center bg-white/5 border border-white/10 rounded-xl transition hover:bg-white/10">

        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-3 text-3xl bg-white/10 rounded-full">🏳️</div>

        <h3 class="text-sm font-semibold text-white">Takım Adı</h3>

        <div class="flex items-center justify-center gap-3 mt-2 text-xs text-white/60">
            <span>Grup A</span>
            <span>·</span>
            <span>FIFA #—</span>
        </div>

        <div class="mt-2 text-xs text-white/40">UEFA</div>
    </a>
@endif

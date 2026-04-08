@php
    $isFinal = ($roundKey === 'final');
    $isLive = in_array($match->status, ['LIVE', 'IN_PLAY']);
    $isFinished = ($match->status === 'FT');
    
    $homeWinner = $isFinished && $match->winner_team_id === $match->home_team_id;
    $awayWinner = $isFinished && $match->winner_team_id === $match->away_team_id;
    $matchUrl = !empty($match->id) ? route('worldcup.matches.show', $match->id) : null;
@endphp

<div class="wc-match-card wc-entry-animate {{ $isFinal ? 'is-final' : '' }}" data-match-id="{{ $match->id }}">
    <div class="flex items-center justify-between mb-3 text-[10px] uppercase tracking-wider">
        <span class="text-muted">{{ $match->kickoff_label }}</span>
        <div class="flex items-center gap-1.5">
            @if($isLive)
                <span class="relative flex h-1.5 w-1.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-red-500"></span>
                </span>
                <span class="text-red-500 font-bold">CANLI</span>
            @elseif($isFinished)
                <span class="text-muted">BİTTİ</span>
            @else
                <span class="text-muted">BEKLİYOR</span>
            @endif
        </div>
    </div>

    <div class="space-y-2.5">
        {{-- Home Team --}}
        <div class="wc-team-row {{ $homeWinner ? 'is-winner' : '' }}">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-6 h-6 bg-white/5 rounded-full overflow-hidden flex-shrink-0 ring-1 ring-white/10 flex items-center justify-center">
                    @if($match->homeTeam?->flag_url)
                        <img src="{{ $match->homeTeam->flag_url }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-[10px]">🏳️</span>
                    @endif
                </div>
                <span class="text-sm truncate {{ $match->homeTeam?->is_placeholder ? 'text-muted italic' : '' }}">
                    {{ $match->homeTeam?->name }}
                </span>
            </div>
            <span class="text-sm font-black tabular-nums">{{ $match->home_score ?? '-' }}</span>
        </div>

        {{-- Away Team --}}
        <div class="wc-team-row {{ $awayWinner ? 'is-winner' : '' }}">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-6 h-6 bg-white/5 rounded-full overflow-hidden flex-shrink-0 ring-1 ring-white/10 flex items-center justify-center">
                    @if($match->awayTeam?->flag_url)
                        <img src="{{ $match->awayTeam->flag_url }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-[10px]">🏳️</span>
                    @endif
                </div>
                <span class="text-sm truncate {{ $match->awayTeam?->is_placeholder ? 'text-muted italic' : '' }}">
                    {{ $match->awayTeam?->name }}
                </span>
            </div>
            <span class="text-sm font-black tabular-nums">{{ $match->away_score ?? '-' }}</span>
        </div>
    </div>

    @if($match->stadium?->name)
        <div class="mt-3 pt-2.5 border-t border-white/[0.03] text-[9px] text-muted text-center flex items-center justify-center gap-1">
             <svg class="w-2.5 h-2.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
             {{ $match->stadium->name }}
        </div>
    @endif

    @if ($matchUrl)
        <a href="{{ $matchUrl }}" class="absolute inset-0 z-10"></a>
    @endif
</div>

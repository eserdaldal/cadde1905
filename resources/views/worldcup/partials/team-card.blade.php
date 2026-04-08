{{--
    PARTIAL: team-card.blade.php
    Tekil takım kartı. Takımlar listesinde kullanılır.
--}}

@props(['team' => null])

@if (!empty($team) && is_object($team))
    @php
        $teamConf = strtoupper(trim($team->confederation ?? 'UEFA'));
        $groupName = $team->group?->name ?? ($team->group ?? '');
        $displayGroup = $groupName ? (str_contains($groupName, 'Grup') ? $groupName : 'Grup ' . $groupName) : 'Grup ?';
        $flagUrl = data_get($team, 'flag_url');
        $flagEmoji = data_get($team, 'flag_emoji') ?? '🏳️';
        $ranking = $team->fifa_ranking ?? '—';
        $coachName = $team->coach_name_api ?? null;
    @endphp
    <a href="{{ route('worldcup.teams.show', $team->slug) }}"
       class="wc-card wc-card--interactive flex flex-col items-center gap-2 p-2.5 text-center wc-team-card">

        <div class="wc-team-flag wc-team-flag--circle">
            @if ($flagUrl)
                <img src="{{ $flagUrl }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
            @else
                <span class="text-2xl opacity-80">{{ $flagEmoji }}</span>
            @endif
        </div>

        <div>
            <h3 class="text-base font-black text-white leading-tight">{{ $team->name }}</h3>
            @if ($coachName)
                <div class="mt-1 text-[10px] font-semibold text-[var(--text-muted)]">Teknik Direktör: {{ $coachName }}</div>
            @endif
        </div>
    </a>

@elseif (!empty($team) && is_array($team))
    <a href="#" class="wc-card wc-card--interactive flex flex-col items-center gap-2 p-2.5 text-center wc-team-card">
        <div class="wc-team-flag wc-team-flag--circle">
            <span class="text-2xl opacity-80">{{ $team['flag'] ?? '🏳️' }}</span>
        </div>
        <div>
            <h3 class="text-base font-black text-white leading-tight">{{ $team['name'] ?? 'Takım' }}</h3>
        </div>
    </a>

@else
    <div class="wc-card p-6 opacity-40">
        <div class="w-full aspect-[16/9] rounded-2xl bg-white/5 border border-white/10"></div>
        <div class="mt-4 h-4 w-3/4 bg-white/5 rounded-full"></div>
    </div>
@endif

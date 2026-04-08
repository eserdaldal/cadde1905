{{--
    PARTIAL: group-table-mini.blade.php
    Landing page için kompakt grup özeti.
    Sadece index.blade.php içinde kullanılır.
--}}

@props(['groupLetter' => '—'])

<div class="wc-card overflow-hidden">
    <div class="px-4 py-2 border-b border-[var(--wc-table-border)] bg-[var(--wc-table-header-bg)]">
        <h3 class="text-[var(--wc-table-text-bold)] font-black text-[13px] tracking-tight">{{ str_contains($groupLetter, 'Grup') ? $groupLetter : 'Grup ' . $groupLetter }}</h3>
    </div>

    <table class="w-full text-[10px]">
        <thead>
            <tr class="text-[var(--text-muted)] border-b border-[var(--wc-table-border)] font-extrabold uppercase tracking-tighter">
                <th class="text-left py-2 px-3">Takım</th>
                <th class="text-center py-2 px-1 w-7">O</th>
                <th class="text-center py-2 px-1 w-8">Av</th>
                <th class="text-center py-2 px-1 w-8 text-[var(--text-primary)]">P</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($standings ?? [] as $t => $s)
                @php
                    $qual = $s->team?->qualification ?? null;
                    $qualStatus = $qual?->status ?? null;
                    
                    $rowClass = match($qualStatus) {
                        'qualified_direct' => 'bg-[var(--wc-status-q-bg)] border-l-2 border-l-[var(--wc-status-q-border)]',
                        'qualified_best_third' => 'bg-[var(--wc-status-best-bg)] border-l-2 border-l-[var(--wc-status-best-border)]',
                        'eliminated_third' => 'bg-[var(--wc-status-elim-bg)] border-l-2 border-l-[var(--wc-status-elim-border)]',
                        'eliminated' => 'opacity-50 grayscale',
                        default => $t < 2 ? 'bg-[var(--wc-status-q-bg)]/60 border-l-2 border-l-[var(--wc-status-q-border)]/40' : 'border-l-2 border-l-transparent'
                    };
                @endphp
                <tr class="border-b border-[var(--wc-table-border)] last:border-0 transition-colors hover:bg-[var(--wc-table-hover)] {{ $rowClass }}">
                    <td class="py-2 px-3">
                        <div class="inline-flex items-center gap-1.5 min-w-0">
                            <div class="w-4 h-4 rounded-full overflow-hidden flex-shrink-0 bg-[var(--wc-table-header-bg)] border border-[var(--wc-table-border)] flex items-center justify-center">
                                @if ($s->team?->flag_url)
                                    <img src="{{ $s->team?->flag_url }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <span class="text-[8px]">🏳️</span>
                                @endif
                            </div>
                            <span class="truncate font-bold text-[var(--wc-table-text-bold)]">{{ $s->team?->name_override ?: $s->team?->name_api ?: 'Takım' }}</span>
                        </div>
                    </td>
                    <td class="text-center tabular-nums font-bold">{{ $s->played ?? 0 }}</td>
                    <td class="text-center tabular-nums text-[var(--text-secondary)]">{{ (($s->goals_for ?? 0) - ($s->goals_against ?? 0)) > 0 ? '+'.(($s->goals_for ?? 0) - ($s->goals_against ?? 0)) : (($s->goals_for ?? 0) - ($s->goals_against ?? 0)) }}</td>
                    <td class="text-center text-[var(--wc-table-text-bold)] font-black tabular-nums">{{ $s->points ?? 0 }}</td>
                </tr>
            @empty
                @for ($t = 0; $t < 4; $t++)
                    <tr class="border-b border-[var(--wc-table-border)] last:border-0 {{ $t < 2 ? 'bg-[var(--wc-status-q-bg)]/60 border-l-2 border-l-[var(--wc-status-q-border)]/40' : 'border-l-2 border-l-transparent' }}">
                        <td class="py-2 px-3 text-[var(--text-muted)] italic font-medium">Bekleniyor...</td>
                        <td class="text-center text-[var(--text-primary)]/10">—</td>
                        <td class="text-center text-[var(--text-primary)]/10">—</td>
                        <td class="text-center text-[var(--text-primary)]/10">—</td>
                    </tr>
                @endfor
            @endforelse
        </tbody>
    </table>
</div>
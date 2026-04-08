{{--
    PARTIAL: group-table.blade.php
    Tekil grup puan tablosu. groups/index.blade.php ve landing page'de kullanılır.
--}}

@props(['group' => null, 'groupLetter' => '—', 'compact' => false])

@if (!empty($group) && is_object($group))
    <div class="wc-card overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-[var(--wc-table-border)] bg-[var(--wc-table-header-bg)]">
            <h3 class="text-sm font-black text-[var(--wc-table-text-bold)]">Grup {{ $group->name }}</h3>
             @if($group->standings && count($group->standings) > 0)
                <span class="text-[10px] text-[var(--accent-premium)] font-black uppercase tracking-widest">CANLI</span>
             @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-[11px]">
                <thead>
                    <tr class="text-[var(--text-muted)] border-b border-[var(--wc-table-border)] font-extrabold uppercase tracking-tighter">
                        <th class="p-3 text-left">Takım</th>
                        <th class="p-3 w-8 text-center">O</th>
                        <th class="p-3 w-8 text-center">G</th>
                        <th class="p-3 w-8 text-center">B</th>
                        <th class="p-3 w-8 text-center">M</th>
                        <th class="p-3 w-8 text-center">Av</th>
                        <th class="p-3 w-10 text-center text-[var(--text-primary)]">P</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group->standings as $i => $standing)
                        @php
                            $qual = $standing->team?->qualification ?? null;
                            $qualStatus = $qual?->status ?? null;
                            
                            $rowClass = match($qualStatus) {
                                'qualified_direct' => 'bg-[var(--wc-status-q-bg)] border-l-4 border-l-[var(--wc-status-q-border)]',
                                'qualified_best_third' => 'bg-[var(--wc-status-best-bg)] border-l-4 border-l-[var(--wc-status-best-border)]',
                                'eliminated_third' => 'bg-[var(--wc-status-elim-bg)] border-l-4 border-l-[var(--wc-status-elim-border)]',
                                'eliminated' => 'opacity-50 grayscale',
                                default => $i < 2 ? 'bg-[var(--wc-status-q-bg)]/60 border-l-4 border-l-[var(--wc-status-q-border)]/40' : 'border-l-4 border-l-transparent'
                            };

                            $statusShort = match($qualStatus) {
                                'qualified_direct' => 'Q',
                                'qualified_best_third' => 'q',
                                'eliminated_third' => 'e',
                                'eliminated' => 'x',
                                default => ''
                            };
                        @endphp
                        <tr class="border-b border-[var(--wc-table-border)] last:border-0 transition-colors hover:bg-[var(--wc-table-hover)] {{ $rowClass }}">
                            <td class="p-3">
                                 <div class="flex items-center gap-2">
                                    <a href="{{ route('worldcup.teams.show', $standing->team?->slug) }}"
                                        class="flex items-center gap-2 text-[var(--wc-table-text-bold)] font-bold transition hover:text-[var(--accent-premium)]">
                                         <div class="w-5 h-5 bg-[var(--wc-table-header-bg)] rounded-full overflow-hidden flex-shrink-0 border border-[var(--wc-table-border)] flex items-center justify-center">
                                             @if ($standing->team?->flag_url)
                                                 <img src="{{ $standing->team?->flag_url }}" alt="" class="w-full h-full object-cover">
                                             @else
                                                 <span class="text-[10px]">🏳️</span>
                                             @endif
                                         </div>
                                         <span class="truncate">{{ $standing->team?->name }}</span>
                                     </a>
                                     @if($qualStatus && $qualStatus !== 'eliminated')
                                         <span class="px-1 text-[8px] font-black rounded uppercase 
                                            {{ $qualStatus === 'qualified_direct' ? 'bg-[#1D6F42] text-white' : 'bg-[#D4AF37] text-black' }}"
                                            title="{{ $qual->label ?? '' }}">
                                            {{ $statusShort }}
                                         </span>
                                     @endif
                                 </div>
                            </td>
                            <td class="text-center font-bold tabular-nums">{{ $standing->played }}</td>
                            <td class="text-center tabular-nums">{{ $standing->won }}</td>
                            <td class="text-center tabular-nums">{{ $standing->drawn }}</td>
                            <td class="text-center tabular-nums">{{ $standing->lost }}</td>
                            <td class="text-center tabular-nums text-[var(--text-secondary)]">{{ $standing->goal_diff > 0 ? '+'.$standing->goal_diff : $standing->goal_diff }}</td>
                            <td class="text-center font-black text-[var(--wc-table-text-bold)] tabular-nums text-sm">{{ $standing->points }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@else
    {{-- PLACEHOLDER MOD (MOCK DATA) --}}
    <div class="wc-card overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-[var(--wc-table-border)] bg-[var(--wc-table-header-bg)]">
            <h3 class="text-sm font-black text-[var(--wc-table-text-bold)]">Grup {{ $groupLetter }}</h3>
            <span class="text-[10px] text-[var(--text-muted)] font-bold uppercase tracking-widest">Maç Günü 0/3</span>
        </div>

        <table class="w-full text-[11px]">
            <thead>
                <tr class="text-[var(--text-muted)] border-b border-[var(--wc-table-border)] font-extrabold uppercase tracking-tighter">
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Takım</th>
                    <th class="p-3 w-8 text-center text-[var(--text-primary)]">P</th>
                </tr>
            </thead>
            <tbody>
                @for ($t = 0; $t < 4; $t++)
                    <tr class="border-b border-[var(--wc-table-border)] last:border-0 transition-colors hover:bg-[var(--wc-table-hover)]
                               {{ $t < 2 ? 'bg-[var(--wc-status-q-bg)]/60 border-l-4 border-l-[var(--wc-status-q-border)]/40' : 'border-l-4 border-l-transparent' }}">
                        <td class="p-3 text-[10px] font-bold text-[var(--text-muted)]">{{ $t + 1 }}</td>
                        <td class="p-3">
                            <div class="flex items-center gap-2 text-[var(--wc-table-text-bold)] font-bold opacity-60">
                                <span class="text-base">🏳️</span>
                                <span>Takım {{ $t + 1 }}</span>
                            </div>
                        </td>
                        <td class="text-center font-black text-[var(--wc-table-text-bold)] text-sm">0</td>
                    </tr>
                @endfor
            </tbody>
        </table>

        @if (!$compact)
            <div class="px-4 py-4 border-t border-[var(--wc-table-border)] bg-[var(--wc-table-footer-bg)]">
                <h4 class="mb-3 text-[9px] font-black text-[var(--text-muted)] uppercase tracking-widest">Grup Fikstürü</h4>
                <div class="space-y-2">
                    @for ($m = 0; $m < 3; $m++)
                        <div class="flex items-center justify-between text-[10px] font-bold">
                            <span class="text-[var(--text-secondary)]">🏳️ Takım {{ $m * 2 + 1 }}</span>
                            <span class="px-3 py-0.5 rounded bg-[var(--wc-table-header-bg)] text-[var(--text-muted)] tabular-nums">vs</span>
                            <span class="text-[var(--text-secondary)] text-right">Takım {{ $m * 2 + 2 }} 🏳️</span>
                        </div>
                    @endfor
                </div>
            </div>
        @endif
    </div>
@endif

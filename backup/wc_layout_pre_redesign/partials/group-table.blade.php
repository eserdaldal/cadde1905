{{--
    PARTIAL: group-table.blade.php
    Tekil grup puan tablosu. groups/index.blade.php ve landing page'de kullanılır.
--}}

@props(['group' => null, 'groupLetter' => '—', 'compact' => false])

@if (!empty($group) && is_object($group))
    <div class="block p-4 bg-white/5 border border-white/10 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between -mx-4 -mt-4 px-4 py-3 mb-3 border-b border-white/10 bg-white/[0.03]">
            <h3 class="text-sm font-bold text-white">Grup {{ $group->name }}</h3>
        </div>

        <table class="w-full text-xs">
            <thead>
                <tr class="text-gray-500 border-b border-white/5">
                    <th class="p-2 px-3 text-left font-medium">Takım</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">O</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">G</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">B</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">M</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">Av</th>
                    <th class="p-2 px-2 w-8 text-center font-medium">P</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group->standings as $i => $standing)
                    @php
                        $qual = $standing->team?->qualification ?? null;
                        $qualStatus = $qual?->status ?? null;
                        
                        $rowClass = match($qualStatus) {
                            'qualified_direct' => 'bg-[#1D6F42]/10 border-l-2 border-l-[#1D6F42]',
                            'qualified_best_third' => 'bg-[#D4AF37]/10 border-l-2 border-l-[#D4AF37]',
                            'eliminated_third' => 'bg-[#8D1B3D]/10 border-l-2 border-l-[#8D1B3D]/50',
                            'eliminated' => 'opacity-70',
                            default => $i < 2 ? 'bg-[#1D6F42]/5 border-l-2 border-l-[#1D6F42]/30' : ''
                        };

                        $statusShort = match($qualStatus) {
                            'qualified_direct' => 'Q',
                            'qualified_best_third' => 'q',
                            'eliminated_third' => 'e',
                            'eliminated' => 'x',
                            default => ''
                        };
                    @endphp
                    <tr class="border-b border-white/5 last:border-0 {{ $rowClass }}">
                        <td class="p-2 px-3">
                             <div class="flex items-center justify-between gap-2">
                                <a href="{{ route('worldcup.teams.show', $standing->team?->slug) }}"
                                    class="flex items-center gap-2 text-white transition hover:text-[#D4AF37]">
                                     <div class="w-5 h-5 bg-white/10 rounded-full overflow-hidden flex-shrink-0">
                                         @if ($standing->team?->flag_url)
                                             <img src="{{ $standing->team?->flag_url }}" alt="" class="w-full h-full object-cover">
                                         @else
                                             <span class="text-[10px] flex items-center justify-center h-full">🏳️</span>
                                         @endif
                                     </div>
                                     <span class="font-medium truncate">{{ $standing->team?->name }}</span>
                                 </a>
                                 @if($qualStatus && $qualStatus !== 'eliminated')
                                     <span class="px-1 text-[9px] font-bold rounded uppercase 
                                        {{ $qualStatus === 'qualified_direct' ? 'bg-[#1D6F42] text-white' : 'bg-[#D4AF37] text-black' }}"
                                        title="{{ $qual->label ?? '' }}">
                                        {{ $statusShort }}
                                     </span>
                                 @endif
                             </div>
                        </td>
                        <td class="text-center text-gray-400 font-mono">{{ $standing->played }}</td>
                        <td class="text-center text-gray-400 font-mono">{{ $standing->won }}</td>
                        <td class="text-center text-gray-400 font-mono">{{ $standing->drawn }}</td>
                        <td class="text-center text-gray-400 font-mono">{{ $standing->lost }}</td>
                        <td class="text-center text-gray-400 font-mono">{{ $standing->goal_diff > 0 ? '+'.$standing->goal_diff : $standing->goal_diff }}</td>
                        <td class="text-center font-bold text-white font-mono">{{ $standing->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@else
    {{-- PLACEHOLDER MOD --}}
    <div class="block bg-white/5 border border-white/10 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-white/10 bg-white/[0.03]">
            <h3 class="text-sm font-bold text-white">Grup {{ $groupLetter }}</h3>
            <span class="text-xs text-white/40">Maç Günü 0/3</span>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-xs text-gray-500 border-b border-white/5">
                    <th class="p-2 px-4 w-8 text-left font-medium">#</th>
                    <th class="p-2 text-left font-medium">Takım</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">O</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">G</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">B</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">M</th>
                    <th class="p-2 px-1 w-10 text-center font-medium">A</th>
                    <th class="p-2 px-1 w-10 text-center font-medium">Y</th>
                    <th class="p-2 px-1 w-8 text-center font-medium">Av</th>
                    <th class="p-2 px-2 w-10 text-center font-medium">P</th>
                </tr>
            </thead>
            <tbody>
                @for ($t = 0; $t < 4; $t++)
                    <tr class="border-b border-white/5 last:border-0 transition hover:bg-white/[0.03]
                               {{ $t < 2 ? 'border-l-2 border-l-[#1D6F42]' : 'border-l-2 border-l-transparent' }}">
                        <td class="p-2 px-4 text-xs text-gray-500">{{ $t + 1 }}</td>
                        <td class="p-2">
                            <a href="#" class="flex items-center gap-2 text-white transition hover:text-[#D4AF37]">
                                <span class="text-base">🏳️</span>
                                <span class="text-sm font-medium">Takım {{ $t + 1 }}</span>
                            </a>
                        </td>
                        <td class="text-xs text-center text-gray-400">0</td>
                        <td class="text-xs text-center text-gray-400">0</td>
                        <td class="text-xs text-center text-gray-400">0</td>
                        <td class="text-xs text-center text-gray-400">0</td>
                        <td class="text-xs text-center text-gray-400">0</td>
                        <td class="text-xs text-center text-gray-400">0</td>
                        <td class="text-xs text-center text-gray-400">0</td>
                        <td class="text-sm text-center font-bold text-white">0</td>
                    </tr>
                @endfor
            </tbody>
        </table>

        @if (!$compact)
            <div class="px-4 py-3 border-t border-white/5 bg-white/[0.02]">
                <h4 class="mb-2 text-xs font-medium text-gray-500 uppercase tracking-wider">Grup Maçları</h4>
                <div class="space-y-1.5">
                    @for ($m = 0; $m < 3; $m++)
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-white/60">🏳️ Takım {{ $m * 2 + 1 }}</span>
                            <span class="px-2 text-gray-600 tabular-nums">– : –</span>
                            <span class="text-white/60">Takım {{ $m * 2 + 2 }} 🏳️</span>
                        </div>
                    @endfor
                </div>
            </div>
        @endif
    </div>
@endif

{{--
    PARTIAL: group-table-mini.blade.php
    Landing page için kompakt grup özeti.
    Sadece index.blade.php içinde kullanılır.
--}}

@props(['groupLetter' => '—'])

<div class="bg-white/5 border border-white/10 rounded-xl overflow-hidden">
    <div class="px-4 py-2.5 border-b border-white/10 bg-white/[0.03]">
        <h3 class="text-white font-bold text-sm">Grup {{ $groupLetter }}</h3>
    </div>

    <table class="w-full text-xs">
        <thead>
            <tr class="text-gray-500 border-b border-white/5">
                <th class="text-left py-1.5 px-3 font-medium">Takım</th>
                <th class="text-center py-1.5 px-1 font-medium w-7">O</th>
                <th class="text-center py-1.5 px-1 font-medium w-7">Av</th>
                <th class="text-center py-1.5 px-1 font-medium w-7">P</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($standings ?? [] as $t => $s)
                @php
                    $qual = $s->team?->qualification ?? null;
                    $qualStatus = $qual?->status ?? null;
                    
                    $rowClass = match($qualStatus) {
                        'qualified_direct' => 'bg-[#1D6F42]/10 border-l-2 border-l-[#1D6F42]',
                        'qualified_best_third' => 'bg-[#D4AF37]/10 border-l-2 border-l-[#D4AF37]',
                        'eliminated_third' => 'bg-[#8D1B3D]/10 border-l-2 border-l-[#8D1B3D]/50',
                        'eliminated' => 'opacity-70',
                        default => $t < 2 ? 'bg-[#1D6F42]/5 border-l-2 border-l-[#1D6F42]/30' : ''
                    };
                @endphp
                <tr class="border-b border-white/5 last:border-0 {{ $rowClass }}">
                    <td class="py-1.5 px-3 text-white/80">
                        <div class="inline-flex items-center gap-1.5 min-w-0">
                            <div class="w-4 h-4 rounded-full overflow-hidden flex-shrink-0 bg-white/10">
                                @if ($s->team?->flag_url)
                                    <img src="{{ $s->team?->flag_url }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <span class="text-[8px] flex items-center justify-center h-full">🏳️</span>
                                @endif
                            </div>
                            <span class="truncate">{{ $s->team?->name_override ?: $s->team?->name_api ?: 'Takım' }}</span>
                        </div>
                    </td>
                    <td class="text-center text-gray-500 tabular-nums">{{ $s->played ?? 0 }}</td>
                    <td class="text-center text-gray-500 tabular-nums font-mono">{{ (($s->goals_for ?? 0) - ($s->goals_against ?? 0)) > 0 ? '+'.(($s->goals_for ?? 0) - ($s->goals_against ?? 0)) : (($s->goals_for ?? 0) - ($s->goals_against ?? 0)) }}</td>
                    <td class="text-center text-white font-bold tabular-nums">{{ $s->points ?? 0 }}</td>
                </tr>
            @empty
                @for ($t = 0; $t < 4; $t++)
                    <tr class="border-b border-white/5 last:border-0 {{ $t < 2 ? 'bg-[#1D6F42]/5' : '' }}">
                        <td class="py-1.5 px-3 text-white/80 opacity-40 italic">Bekleniyor...</td>
                        <td class="text-center text-gray-700">—</td>
                        <td class="text-center text-gray-700">—</td>
                        <td class="text-center text-gray-700">—</td>
                    </tr>
                @endfor
            @endforelse
        </tbody>
    </table>
</div>
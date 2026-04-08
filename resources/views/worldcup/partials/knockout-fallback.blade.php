<div class="wc-bracket-fallback">
    <div class="text-center py-16 mb-12">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-white/5 rounded-full mb-6 ring-1 ring-white/10">
            <span class="text-3xl">🏆</span>
        </div>
        <h3 class="text-white font-bold text-2xl mb-3">Eleme Turu Eşleşmeleri</h3>
        <div class="wc-bracket-fallback p-8 text-center bg-white/[0.02] rounded-2xl border border-white/5 wc-entry-animate">
        <p class="text-sm text-muted">
            Eleme turu, grup aşaması tamamlandıktan sonra açıklanacaktır.
        </p>
    </div>

    {{-- Skeleton Bracket Structure --}}
    <div class="wc-bracket-container opacity-40 grayscale pointer-events-none overflow-hidden h-[400px]">
        <div class="wc-bracket blur-[2px]">
            @php
                $skeletonRounds = [
                    ['label' => 'Son 16', 'count' => 8],
                    ['label' => 'Çeyrek Final', 'count' => 4],
                    ['label' => 'Yarı Final', 'count' => 2],
                    ['label' => 'Final', 'count' => 1],
                ];
            @endphp

            @foreach ($skeletonRounds as $round)
                <div class="wc-round">
                    <div class="wc-round-header text-[10px]">{{ $round['label'] }}</div>
                    <div class="flex flex-col justify-around flex-grow gap-8">
                        @for ($i = 0; $i < $round['count']; $i++)
                            <div class="wc-match-card border-dashed">
                                <div class="h-10"></div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

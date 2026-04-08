@php
    $rounds = $knockoutData['rounds'] ?? [];
    $isEmpty = empty($rounds) || ($knockoutHealth && $knockoutHealth['status'] === \App\Services\WorldCup\DataHealth\WorldCupDataHealthService::STATUS_EMPTY_FROM_API);
@endphp

<section id="knockout-matches" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-white font-bold text-xl">Eleme Turu</h2>
        @if($knockoutHealth && $knockoutHealth['status'] === \App\Services\WorldCup\DataHealth\WorldCupDataHealthService::STATUS_STALE)
             <span class="text-[10px] text-yellow-500/80 uppercase tracking-widest bg-yellow-500/5 px-3 py-1 rounded-full border border-yellow-500/10">
                Güncelleniyor...
            </span>
        @else
            <span class="text-xs text-gray-500 uppercase tracking-widest bg-white/5 px-3 py-1 rounded-full border border-white/10">
                Knockout Stage
            </span>
        @endif
    </div>

    @if ($isEmpty)
        @include('worldcup.partials.knockout-fallback')
    @else
        @include('worldcup.partials.knockout-bracket', ['knockoutData' => $knockoutData])
    @endif
</section>

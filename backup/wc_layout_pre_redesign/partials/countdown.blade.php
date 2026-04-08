{{--
    ══════════════════════════════════════════════════════
    PARTIAL: countdown.blade.php
    Geri sayım bileşeni — Landing page hero bölümünde kullanılır.
    Turnuva başlangıç tarihi: Dinamik
    Alpine.js opsiyoneldir. Olmadan da statik fallback çalışır.
    ══════════════════════════════════════════════════════
--}}

@php
    $countdownTarget = $countdownTarget ?? null;
@endphp

<div class="flex items-center justify-center gap-3 sm:gap-5"
     x-data="countdown()"
     x-init="start()">

    @foreach (['Gün', 'Saat', 'Dakika', 'Saniye'] as $i => $label)
        <div class="flex flex-col items-center">
            <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-lg
                        w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center">
                <span class="text-white font-bold text-2xl sm:text-3xl tabular-nums"
                      x-text="units[{{ $i }}]?.value">00</span>
            </div>
            <span class="text-gray-400 text-xs mt-1.5 uppercase tracking-wider"
                  x-text="units[{{ $i }}]?.label">{{ $label }}</span>
        </div>
    @endforeach

</div>

@once
@push('scripts')
<script>
    function countdown() {
        return {
            units: [
                { label: 'Gün', value: 0 },
                { label: 'Saat', value: 0 },
                { label: 'Dakika', value: 0 },
                { label: 'Saniye', value: 0 },
            ],
            start() {
                const targetRaw = @json($countdownTarget);
                if (!targetRaw) {
                    return;
                }
                const target = new Date(targetRaw).getTime();
                if (Number.isNaN(target)) {
                    return;
                }
                const update = () => {
                    const diff = Math.max(0, target - Date.now());
                    this.units[0].value = String(Math.floor(diff / 86400000)).padStart(2, '0');
                    this.units[1].value = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                    this.units[2].value = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                    this.units[3].value = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
                };
                update();
                setInterval(update, 1000);
            }
        };
    }
</script>
@endpush
@endonce

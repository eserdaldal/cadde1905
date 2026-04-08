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

<div class="wc-hero-countdown"
     x-data="wcCountdown()"
     x-init="start()">

    <div class="wc-hero-countdown__panel flex flex-wrap items-center justify-center gap-4 px-6 py-4 rounded-3xl bg-black/40 border border-white/10 backdrop-blur-md shadow-2xl">
        @foreach (['Gün', 'Saat', 'Dakika', 'Saniye'] as $i => $label)
            <div class="wc-hero-countdown__item">
                <div class="wc-hero-countdown__value"
                     x-text="units[{{ $i }}]?.value">00</div>
                <div class="wc-hero-countdown__label"
                     x-text="units[{{ $i }}]?.label">{{ $label }}</div>
            </div>
            @if (! $loop->last)
                <div class="wc-hero-countdown__sep" aria-hidden="true"></div>
            @endif
        @endforeach
    </div>

</div>

@once
@push('scripts')
<script>
    function wcCountdown() {
        return {
            units: [
                { label: 'Gün', value: '00' },
                { label: 'Saat', value: '00' },
                { label: 'Dakika', value: '00' },
                { label: 'Saniye', value: '00' },
            ],
            start() {
                const targetRaw = @json($countdownTarget);
                if (!targetRaw) return;
                const target = new Date(targetRaw).getTime();
                if (Number.isNaN(target)) return;
                
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

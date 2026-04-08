@php
    $baseUrl = url()->current();

    $current = [
        'arama' => request()->query('arama', ''),
        'kullanim_durumu' => request()->query('kullanim_durumu', ''),
        'icerik_turu' => request()->query('icerik_turu', ''),
        'kullanim_tipi' => request()->query('kullanim_tipi', ''),
        'medya_turu' => request()->query('medya_turu', ''),
    ];

    $buildUrl = function (array $overrides = []) use ($baseUrl, $current) {
        $params = array_merge($current, $overrides);
        $params = array_filter($params, fn($value) => filled($value));

        return empty($params) ? $baseUrl : $baseUrl . '?' . http_build_query($params);
    };

    $options = [
        'kullanim_durumu' => [
            '' => 'Tümü',
            'kullanilmayan' => 'Kullanılmayan',
            'kullanilan' => 'Kullanılan',
            'paylasimli' => 'Paylaşımlı',
        ],
        'icerik_turu' => [
            '' => 'Tümü',
            'history_event' => 'Tarih Olayı',
            'news' => 'Haber',
        ],
        'kullanim_tipi' => [
            '' => 'Tümü',
            'cover' => 'Kapak',
            'gallery' => 'Galeri',
            'video' => 'Video',
        ],
        'medya_turu' => [
            '' => 'Tümü',
            'image' => 'Görsel',
            'embed' => 'Gömülü Video',
            'video' => 'Video',
        ],
    ];

    $activeItems = [];
    $mappings = [
        'kullanim_durumu' => [
            'kullanilmayan' => 'Kullanılmayan',
            'kullanilan' => 'Kullanılan',
            'paylasimli' => 'Paylaşımlı',
        ],
        'icerik_turu' => [
            'history_event' => 'Tarih Olayı',
            'news' => 'Haber',
        ],
        'kullanim_tipi' => [
            'cover' => 'Kapak',
            'gallery' => 'Galeri',
            'video' => 'Video',
        ],
        'medya_turu' => [
            'image' => 'Görsel',
            'embed' => 'Gömülü Video',
            'video' => 'Video',
        ],
    ];

    foreach ($mappings as $key => $labels) {
        $val = $current[$key];
        if (filled($val)) {
            $activeItems[] = [
                'label' => $labels[$val] ?? $val,
                'url' => $buildUrl([$key => null]),
            ];
        }
    }

    if (filled($current['arama'])) {
        $activeItems[] = [
            'label' => 'Arama: ' . $current['arama'],
            'url' => $buildUrl(['arama' => null]),
        ];
    }

    $labelStyle = 'text-[10px] font-black uppercase tracking-[0.2em] text-white/20';
    $buttonBase = 'inline-flex min-h-[44px] items-center rounded-xl border border-white/[0.08] bg-white/[0.03] px-4 py-2 text-[12px] font-bold text-white/80 transition-all hover:border-white/25 hover:bg-white/10 hover:text-white shadow-sm';
    $inputBase = 'flex min-h-[44px] items-center rounded-xl border border-white/[0.08] bg-black/40 focus-within:border-primary-500/40 focus-within:bg-black/60 focus-within:ring-4 focus-within:ring-primary-500/10 transition-all outline-none shadow-inner';
    $activeItemChip = 'inline-flex items-center gap-2 rounded-full border border-white/[0.08] bg-white/[0.04] px-3 py-1 text-[10px] font-black text-white/70 transition hover:bg-white/[0.08] hover:text-white';
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const details = document.querySelectorAll('details.filter-dropdown');

        details.forEach(targetDetail => {
            targetDetail.addEventListener('toggle', () => {
                if (targetDetail.open) {
                    details.forEach(detail => {
                        if (detail !== targetDetail) {
                            detail.open = false;
                        }
                    });
                }
            });
        });

        document.addEventListener('click', function (event) {
            details.forEach(detail => {
                if (!detail.contains(event.target)) {
                    detail.open = false;
                }
            });
        });
    });
</script>

<div class="relative z-[40] mb-8 p-1 border-b border-white/[0.04] pb-8">
    <div class="flex flex-col gap-6">
        <div class="flex flex-wrap items-center gap-6">
            <div class="{{ $labelStyle }}">
                Filtreler
            </div>

            <div class="flex flex-grow flex-wrap items-center gap-4">
                <form action="{{ $baseUrl }}" method="GET" class="relative min-w-[280px]">
                    @foreach(request()->except(['arama', 'page']) as $key => $value)
                        @if(!is_array($value))
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach

                    <div class="{{ $inputBase }}">
                        <div class="pl-4 pr-1 text-white/20 transition-colors focus-within:text-primary-500">
                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <input type="text" name="arama" value="{{ $current['arama'] }}"
                            placeholder="Ad veya ID ile ara..."
                            class="w-full bg-transparent border-none py-2.5 px-3 text-[13px] font-semibold text-white placeholder-white/20 focus:outline-none focus:ring-0">
                    </div>
                </form>

                <div class="flex flex-wrap items-center gap-3">
                    @foreach(['kullanim_durumu', 'icerik_turu', 'kullanim_tipi', 'medya_turu'] as $key)
                        @php
                            $labels = [
                                'kullanim_durumu' => 'Kullanım',
                                'icerik_turu' => 'İçerik',
                                'kullanim_tipi' => 'Tip',
                                'medya_turu' => 'Medya'
                            ];
                        @endphp
                        <details class="relative filter-dropdown">
                            <summary class="{{ $buttonBase }} cursor-pointer list-none select-none group">
                                <div class="flex flex-col items-start leading-tight">
                                    <span
                                        class="text-[9px] font-black uppercase tracking-wider text-white/25 mb-0.5 group-hover:text-white/40">{{ $labels[$key] }}</span>
                                    <span
                                        class="truncate max-w-[100px]">{{ $options[$key][$current[$key]] ?? 'Tümü' }}</span>
                                </div>
                                <svg class="ml-3 h-3.5 w-3.5 opacity-20 transition-transform group-open:rotate-180"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>

                            <div
                                class="absolute left-0 z-[100] mt-3 min-w-[240px] rounded-2xl border border-white/15 bg-[#0f1117] p-2 shadow-[0_20px_50px_rgba(0,0,0,0.5)] backdrop-blur-xl">
                                <div class="flex flex-col gap-1">
                                    @foreach ($options[$key] as $val => $label)
                                        <a href="{{ $buildUrl([$key => $val ?: null, 'page' => null]) }}"
                                            class="rounded-lg px-3 py-2 text-[13px] font-semibold text-white/70 transition hover:bg-white/5 hover:text-white {{ $current[$key] === $val ? 'bg-primary-600/10 text-primary-400' : '' }}">
                                            {{ $label }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center pl-4 border-l border-white/5">
                <a href="{{ $baseUrl }}"
                    class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-white/35 transition hover:text-red-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Sıfırla</span>
                </a>
            </div>
        </div>

        @if (!empty($activeItems))
            <div class="flex flex-wrap items-center gap-4 border-t border-white/[0.03] pt-4">
                <div class="{{ $labelStyle }}">
                    Aktif
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    @foreach ($activeItems as $item)
                        <a href="{{ $item['url'] }}" class="{{ $activeItemChip }}">
                            <span>{{ $item['label'] }}</span>
                            <svg class="h-3 w-3 opacity-40 transition-opacity hover:opacity-100" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
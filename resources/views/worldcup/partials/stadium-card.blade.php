{{--
    PARTIAL: stadium-card.blade.php
    Tekil stadyum kartı. Stadyumlar ve landing sayfasında kullanılır.
--}}

@props(['stadium' => null])

@php
    use Illuminate\Support\Facades\Storage;

    $isObj = !empty($stadium) && is_object($stadium);
    $isArr = !empty($stadium) && is_array($stadium);

    $name = $isObj
        ? ($stadium->name_override ?? $stadium->name_api ?? $stadium->name ?? 'Bekleniyor...')
        : ($isArr
            ? ($stadium['name_override'] ?? $stadium['name_api'] ?? $stadium['name'] ?? 'Bekleniyor...')
            : 'Bekleniyor...');

    $city = $isObj
        ? ($stadium->city_api ?? $stadium->city ?? null)
        : ($isArr
            ? ($stadium['city_api'] ?? $stadium['city'] ?? null)
            : null);

    $country = $isObj
        ? ($stadium->country_api ?? $stadium->country ?? null)
        : ($isArr
            ? ($stadium['country_api'] ?? $stadium['country'] ?? null)
            : null);

    $locationParts = array_filter([trim((string) $city), trim((string) $country)]);
    $location = !empty($locationParts) ? implode(', ', $locationParts) : 'Şehir bilgisi bekleniyor';

    $capacityRaw = $isObj
        ? ($stadium->capacity_override ?? $stadium->capacity ?? null)
        : ($isArr
            ? ($stadium['capacity_override'] ?? $stadium['capacity'] ?? null)
            : null);

    $capacity = (is_numeric($capacityRaw) && (int) $capacityRaw > 0)
        ? number_format($capacityRaw)
        : '—';

    $imageUrl = $isObj
        ? (data_get($stadium, 'image_url')
            ?? data_get($stadium, 'hero_image')
            ?? ((is_array(data_get($stadium, 'gallery')) && count(data_get($stadium, 'gallery')) > 0) ? data_get($stadium, 'gallery.0') : null))
        : ($isArr
            ? (($stadium['image_url'] ?? null)
                ?? ($stadium['hero_image'] ?? null)
                ?? ((isset($stadium['gallery']) && is_array($stadium['gallery']) && count($stadium['gallery']) > 0) ? $stadium['gallery'][0] : null))
            : null);

    if ($imageUrl && !str_starts_with($imageUrl, 'http') && !str_starts_with($imageUrl, '/storage')) {
        $imageUrl = str_starts_with($imageUrl, 'storage/')
            ? asset($imageUrl)
            : Storage::url($imageUrl);
    }

    if ($imageUrl) {
        $webp = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $imageUrl);

        if ($webp !== $imageUrl) {
            $storageRelativePath = ltrim(parse_url($webp, PHP_URL_PATH) ?? '', '/');
            $storageRelativePath = preg_replace('#^storage/#', '', $storageRelativePath ?? '');
            $webpFullPath = storage_path('app/public/' . $storageRelativePath);

            if ($storageRelativePath && file_exists($webpFullPath)) {
                $imageUrl = $webp;
            }
        }
    }

    $slug = $isObj
        ? ($stadium->slug ?? null)
        : ($isArr ? ($stadium['slug'] ?? null) : null);

    $linkUrl = !empty($slug) ? route('worldcup.stadiums.show', $slug) : '#';

    $initial = mb_substr($name, 0, 1, 'UTF-8');
@endphp

<a href="{{ $linkUrl }}"
   class="wc-match-card block group p-0 overflow-hidden hover:border-[var(--accent-premium)] transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-[var(--accent-premium)]/10">

    <div class="aspect-[16/10] relative overflow-hidden bg-[var(--surface-widget)] {{ !$imageUrl ? 'wc-stadium-surface' : '' }}">
        @if($imageUrl)
            <img
                src="{{ $imageUrl }}"
                alt="{{ $name }}"
                loading="lazy"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-black/5"></div>
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-[radial-gradient(circle_at_top_right,rgba(255,215,64,0.20),transparent_35%)]"></div>

            <div class="absolute left-5 right-5 bottom-4">
                <div class="space-y-2">
                    <h3 class="text-white text-xl font-black leading-tight drop-shadow-lg">
                        {{ $name }}
                    </h3>

                    <div class="flex items-center gap-1.5 text-[11px] font-bold text-white/85">
                        <span class="text-[var(--accent-premium)]">📍</span>
                        <span>{{ $location }}</span>
                    </div>
                </div>
            </div>
        @else
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="flex flex-col items-center gap-2 text-center text-[var(--text-secondary)] opacity-80 px-4">
                    <div class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--text-muted)]">Görsel Hazırlanıyor</div>
                    <div class="w-12 h-12 rounded-2xl bg-[var(--surface-widget)] border border-[var(--border-soft)] flex items-center justify-center text-lg font-black text-[var(--accent-premium)]">
                        {{ $initial }}
                    </div>
                    <div class="text-[11px] font-bold max-w-[180px]">{{ $name }}</div>
                </div>
            </div>
        @endif

        <div class="absolute top-4 left-4">
            <div class="px-2.5 py-1 rounded-md bg-[var(--accent-gold)] backdrop-blur-md border border-[var(--accent-gold)] text-[9px] font-black uppercase tracking-widest text-[#0c0c0c] shadow-lg shadow-[var(--accent-gold)]/20">
                Arena
            </div>
        </div>
    </div>

    <div class="p-5">
        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
                <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)]">
                    Stadyum Kartı
                </div>
                <div class="mt-2 text-sm font-bold text-[var(--text-secondary)] line-clamp-2">
                    {{ $location }}
                </div>
            </div>

            <div class="text-right flex-shrink-0">
                <div class="text-[var(--text-primary)] font-black text-sm tabular-nums">
                    {{ $capacity }}
                </div>
                <div class="text-[9px] font-black uppercase tracking-widest text-[var(--text-muted)] mt-1">
                    Kapasite
                </div>
            </div>
        </div>

        <div class="mt-5 pt-4 border-t border-[var(--border-soft)] flex items-center justify-between">
            <span class="text-[10px] font-black uppercase tracking-tighter text-[var(--text-muted)] group-hover:text-[var(--text-secondary)] transition-colors">Detayları Gör</span>
            <span class="text-[var(--accent-premium)] opacity-0 group-hover:opacity-100 transform translate-x-[-10px] group-hover:translate-x-0 transition-all duration-300">→</span>
        </div>
    </div>
</a>

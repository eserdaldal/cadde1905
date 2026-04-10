{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — FIFA Dünya Kupası — STADYUM DETAY
    Route: /dunya-kupasi/stadyumlar/{stadium:slug}
    Data-aware layout:
    - boş veri varsa blok gizlenir
    - üst bilgi kartları yerine inline info row kullanılır
    - sağ kolon sadece veri varsa görünür
    ══════════════════════════════════════════════════════════════
--}}

@extends('layouts.worldcup')

@php
    use Illuminate\Support\Facades\Storage;

    $stadium = $stadium ?? null;
    $relatedMatches = $relatedMatches ?? [];
    $activeTournament = $activeTournament ?? null;
    $theme = 'event-light';

    // Önce override / api alanlarını kullan, sonra güvenli fallback uygula.
    $stadiumName = $stadium?->name_override
        ?? $stadium?->name_api
        ?? $stadium?->name
        ?? 'Stadyum';

    $stadiumCity = $stadium?->city_api
        ?? $stadium?->city
        ?? null;

    $stadiumCountry = $stadium?->country_api
        ?? $stadium?->country
        ?? null;

    $stadiumCapacity = $stadium?->capacity ?: null;

    $stadiumDescription = $stadium?->description_editorial
        ?? $stadium?->description
        ?? null;

    $stadiumAddress = $stadium?->address ?: null;
    $stadiumOpenedYear = $stadium?->opened_year ?: null;
    $stadiumSurfaceType = $stadium?->surface_type ?: null;
    $stadiumGallery = is_array($stadium?->gallery) ? $stadium->gallery : [];

    $heroImage = $stadium?->hero_image ?: null;
    if (! $heroImage && ! empty($stadiumGallery)) {
        $heroImage = $stadiumGallery[0] ?? null;
    }

    if ($heroImage && ! str_starts_with($heroImage, 'http') && ! str_starts_with($heroImage, '/storage')) {
        $heroImage = str_starts_with($heroImage, 'storage/')
            ? asset($heroImage)
            : Storage::url($heroImage);
    }

    $seatingPlanImage = $stadium?->seating_plan_image ?: null;
    if ($seatingPlanImage && ! str_starts_with($seatingPlanImage, 'http') && ! str_starts_with($seatingPlanImage, '/storage')) {
        $seatingPlanImage = str_starts_with($seatingPlanImage, 'storage/')
            ? asset($seatingPlanImage)
            : Storage::url($seatingPlanImage);
    }

    $pageYear = $activeTournament?->year;
    $pageTitle = $activeTournament?->name ?? 'Dünya Kupası';
    $pageTitleWithYear = $pageYear ? ($pageTitle . ' ' . $pageYear) : $pageTitle;

    $metaTitle = $stadium?->meta_title ?: ($stadiumName . ' — ' . $pageTitleWithYear . ' — CADDE1905');
    $metaDescription = $stadium?->meta_description ?: ($stadiumName . ' stadyumu bilgileri, maç takvimi ve detaylar.');

    $showInlineInfo = filled($stadiumCity) || filled($stadiumCountry) || filled($stadiumCapacity);

    $showSidebarDetails = filled($stadiumName)
        || filled($stadiumCity)
        || filled($stadiumCountry)
        || filled($stadiumCapacity)
        || filled($stadiumAddress)
        || filled($stadiumOpenedYear)
        || filled($stadiumSurfaceType)
        || filled($activeTournament?->name);

    $showSidebar = $showSidebarDetails || filled($seatingPlanImage);

    $mainColumnClass = $showSidebar ? 'lg:col-span-8' : 'lg:col-span-12';
    $gridClass = $showSidebar ? 'lg:grid-cols-12' : 'lg:grid-cols-1';

    $galleryImages = collect($stadiumGallery)
        ->filter()
        ->map(function ($img) {
            if (str_starts_with($img, 'http') || str_starts_with($img, '/storage')) {
                return $img;
            }

            return str_starts_with($img, 'storage/')
                ? asset($img)
                : Storage::url($img);
        })
        ->values()
        ->all();
@endphp

@section('title', $metaTitle)

@section('worldcup-content')
    <div class="event-layout contents">
        {{-- HERO / BAŞLIK --}}
        @if ($heroImage)
            <section class="relative overflow-hidden pt-10 pb-14 border-b border-[var(--border-default)]">
                <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-[var(--surface-base)] to-[var(--surface-base)]"></div>

                <div class="wc-container relative">
                    <div class="relative overflow-hidden rounded-3xl border border-[var(--border-soft)] bg-[var(--surface-widget)] shadow-2xl">
                        <div class="aspect-[21/9] max-h-[420px]">
                            <img
                                src="{{ $heroImage }}"
                                alt="{{ $stadiumName }}"
                                class="w-full h-full object-cover"
                            >
                        </div>

                        <div class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black/85 via-black/35 to-transparent"></div>

                        <div class="absolute left-8 right-8 bottom-8 sm:left-10 sm:right-10 sm:bottom-10">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[var(--accent-premium)]/20 backdrop-blur-md border border-[var(--accent-premium)]/30 mb-4">
                                <span class="text-[10px] font-black text-[var(--accent-premium)] uppercase tracking-widest">Resmi Arena</span>
                            </div>

                            <h1 class="text-white font-black text-4xl sm:text-5xl lg:text-6xl leading-none drop-shadow-2xl">
                                {{ $stadiumName }}
                            </h1>

                            @if ($showInlineInfo)
                                <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2 text-white/85 text-sm sm:text-base font-bold">
                                    @if ($stadiumCity)
                                        <div class="flex items-center gap-2">
                                            <span>📍</span>
                                            <span>{{ $stadiumCity }}</span>
                                        </div>
                                    @endif

                                    @if ($stadiumCountry)
                                        <div class="flex items-center gap-2">
                                            <span>🌍</span>
                                            <span>{{ $stadiumCountry }}</span>
                                        </div>
                                    @endif

                                    @if ($stadiumCapacity)
                                        <div class="flex items-center gap-2">
                                            <span>👥</span>
                                            <span>{{ number_format((int) $stadiumCapacity, 0, ',', '.') }} kapasite</span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @else
            <section class="border-b border-[var(--border-default)] pt-10 pb-16">
                <div class="wc-container">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[var(--accent-premium)]/20 border border-[var(--accent-premium)]/30 mb-5">
                        <span class="text-[10px] font-black text-[var(--accent-premium)] uppercase tracking-widest">Resmi Arena</span>
                    </div>

                    <h1 class="text-[var(--text-primary)] font-black text-4xl sm:text-5xl lg:text-6xl leading-none">
                        {{ $stadiumName }}
                    </h1>

                    @if ($showInlineInfo)
                        <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3 text-[var(--text-secondary)] text-sm font-bold">
                            @if ($stadiumCity)
                                <div class="flex items-center gap-2">
                                    <span>📍</span>
                                    <span>{{ $stadiumCity }}</span>
                                </div>
                            @endif

                            @if ($stadiumCountry)
                                <div class="flex items-center gap-2">
                                    <span>🌍</span>
                                    <span>{{ $stadiumCountry }}</span>
                                </div>
                            @endif

                            @if ($stadiumCapacity)
                                <div class="flex items-center gap-2">
                                    <span>👥</span>
                                    <span>{{ number_format((int) $stadiumCapacity, 0, ',', '.') }} kapasite</span>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </section>
        @endif

        {{-- ANA İÇERİK --}}
        <div class="wc-container pb-28 lg:pb-40 mb-10" style="padding-top: clamp(2.5rem, 4.5vw, 4rem);">
            <div class="grid grid-cols-1 {{ $gridClass }} gap-10 lg:gap-12 items-start">
                {{-- SOL KOLON --}}
                <div class="{{ $mainColumnClass }} space-y-14">
                    @if ($stadiumDescription)
                        <section class="max-w-4xl">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="w-1.5 h-8 bg-[var(--accent-premium)] rounded-full"></span>
                                <h2 class="text-2xl font-black text-[var(--text-primary)]">Stadyum Hakkında</h2>
                            </div>

                            <div class="prose max-w-none text-[var(--text-secondary)] leading-8 text-[17px]">
                                {!! $stadiumDescription !!}
                            </div>
                        </section>
                    @endif

                    <section class="max-w-3xl">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div class="flex items-center gap-3">
                                <span class="w-1.5 h-8 bg-[var(--accent-premium)] rounded-full"></span>
                                <h2 class="text-2xl font-black text-[var(--text-primary)]">Maç Takvimi</h2>
                            </div>

                            <span class="px-3 py-1 rounded-full bg-[var(--surface-widget)] border border-[var(--border-soft)] text-[10px] font-black text-[var(--text-muted)] uppercase tracking-widest whitespace-nowrap">
                                {{ count($relatedMatches) }} Karşılaşma
                            </span>
                        </div>

                        @if (empty($relatedMatches))
                            @include('worldcup.partials.wc-empty-state', [
                                'title' => 'Maç Bulunmuyor',
                                'description' => 'Bu stadyumda oynanacak maçlar açıklandığında burada listelenecektir.',
                            ])
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                @foreach ($relatedMatches as $match)
                                    @include('worldcup.partials.match-card', ['match' => $match])
                                @endforeach
                            </div>
                        @endif
                    </section>

                    @if (! empty($galleryImages))
                        <section class="max-w-4xl">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="w-1.5 h-8 bg-[var(--accent-premium)] rounded-full"></span>
                                <h2 class="text-2xl font-black text-[var(--text-primary)]">Galeri</h2>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach ($galleryImages as $img)
                                    <div class="aspect-[4/3] rounded-2xl overflow-hidden border border-[var(--border-soft)] bg-[var(--surface-widget)] shadow-lg">
                                        <img
                                            src="{{ $img }}"
                                            alt="{{ $stadiumName }}"
                                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                {{-- SAĞ KOLON --}}
                @if ($showSidebar)
                    <aside class="lg:col-span-4 space-y-12 lg:sticky lg:top-[160px] self-start pb-10">
                        @if ($showSidebarDetails)
                            <section class="space-y-6">
                                <div class="flex items-center gap-3">
                                    <span class="w-1.5 h-8 bg-[var(--accent-premium)] rounded-full"></span>
                                    <h2 class="text-2xl font-black text-[var(--text-primary)]">Stat Detayları</h2>
                                </div>

                                <div class="wc-card p-6 md:p-7 bg-[var(--surface-widget)]/75 backdrop-blur-md border border-[var(--border-soft)] shadow-xl">
                                    <div class="space-y-5">
                                        <div class="pb-4 border-b border-[var(--border-soft)]">
                                            <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] mb-2">Resmi Ad</div>
                                            <div class="text-sm font-bold text-[var(--text-primary)] leading-6 break-words">
                                                {{ $stadiumName }}
                                            </div>
                                        </div>

                                        @if ($stadiumCity)
                                            <div class="pb-4 border-b border-[var(--border-soft)]">
                                                <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] mb-2">Şehir</div>
                                                <div class="text-sm font-bold text-[var(--text-primary)]">
                                                    {{ $stadiumCity }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($stadiumCountry)
                                            <div class="pb-4 border-b border-[var(--border-soft)]">
                                                <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] mb-2">Ülke</div>
                                                <div class="text-sm font-bold text-[var(--text-primary)]">
                                                    {{ $stadiumCountry }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($stadiumCapacity)
                                            <div class="pb-4 border-b border-[var(--border-soft)]">
                                                <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] mb-2">Kapasite</div>
                                                <div class="text-sm font-bold text-[var(--text-primary)]">
                                                    {{ number_format((int) $stadiumCapacity, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($stadiumAddress)
                                            <div class="pb-4 border-b border-[var(--border-soft)]">
                                                <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] mb-2">Adres</div>
                                                <div class="text-sm font-bold text-[var(--text-primary)] leading-6 break-words">
                                                    {{ $stadiumAddress }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($stadiumSurfaceType)
                                            <div class="pb-4 border-b border-[var(--border-soft)]">
                                                <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] mb-2">Zemin Tipi</div>
                                                <div class="text-sm font-bold text-[var(--text-primary)]">
                                                    {{ $stadiumSurfaceType }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($stadiumOpenedYear)
                                            <div class="pb-4 border-b border-[var(--border-soft)]">
                                                <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] mb-2">Açılış Yılı</div>
                                                <div class="text-sm font-bold text-[var(--text-primary)]">
                                                    {{ $stadiumOpenedYear }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($activeTournament?->name)
                                            <div>
                                                <div class="text-[10px] font-black uppercase tracking-widest text-[var(--text-muted)] mb-2">Turnuva</div>
                                                <div class="text-sm font-bold text-[var(--accent-premium)]">
                                                    {{ $activeTournament?->name }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </section>
                        @endif

                        @if ($seatingPlanImage)
                            <section class="space-y-6">
                                <div class="flex items-center gap-3">
                                    <span class="w-1.5 h-8 bg-[var(--text-muted)] opacity-50 rounded-full"></span>
                                    <h2 class="text-2xl font-black text-[var(--text-primary)]">Oturma Planı</h2>
                                </div>

                                <div class="wc-card p-5 md:p-6 border border-[var(--accent-premium)]/20 shadow-xl overflow-hidden">
                                    <div class="rounded-2xl overflow-hidden border border-[var(--border-soft)] bg-[var(--surface-widget)]">
                                        <img
                                            src="{{ $seatingPlanImage }}"
                                            alt="Oturma Planı"
                                            class="w-full h-auto object-cover"
                                        >
                                    </div>
                                </div>
                            </section>
                        @endif
                    </aside>
                @endif
            </div>
        </div>
    </div>
@endsection
{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — ENGELSİZ ASLANLAR
    Tek sayfalık, bilgi ve içerik odaklı özel alan.
    Sık güncellenen maç/fikstür merkezi değildir.
    ══════════════════════════════════════════════════════════════
--}}

@extends('layouts.app')

@section('title', 'Engelsiz Aslanlar — CADDE1905')

@section('content')

    <div class="engelsiz-section">
        <main class="min-h-screen">
        {{-- HERO --}}
        <section class="relative overflow-hidden border-b border-white/10">
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--ea-primary)]/35 via-[#111111]/55 to-black/55"></div>

            <div class="absolute inset-0">
                <img
                    src="{{ asset('images/engelsiz-aslanlar/img-1.webp') }}"
                    alt="Engelsiz Aslanlar"
                    class="h-full w-full object-cover opacity-25"
                >
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24">
                <div class="max-w-3xl">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-black/30 px-4 py-1.5 text-xs font-medium tracking-wider text-white/80 uppercase backdrop-blur-sm">
                        <span class="text-[var(--ea-accent)]">★</span>
                        Özel Alan
                    </span>

                    <h1 class="mt-6 text-5xl sm:text-6xl lg:text-7xl font-black leading-tight text-white">
                        Engelsiz Aslanlar
                    </h1>

                    <p class="mt-6 max-w-2xl text-base sm:text-lg leading-7 text-white/75">
                        Engelsiz Aslanlar, yalnızca sportif sonuçlarla değil; emek, temsil,
                        aidiyet ve görünürlükle de anlam kazanan özel bir alandır. Bu sayfa,
                        hızlı tüketilen bir akış değil; kalıcı bir saygı ve hafıza alanı olarak
                        kurgulanmıştır.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="#tarihce"
                           class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-[#111] transition hover:opacity-90">
                            Tarihçe
                        </a>
                        <a href="#icerikler"
                           class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                            Seçilmiş İçerikler
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- GİRİŞ METNİ --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-8">
                    <h2 class="text-white text-3xl font-bold">Neden ayrı bir alan?</h2>
                    <p class="mt-4 text-white/70 leading-7">
                        Engelsiz Aslanlar, kulübün yalnızca sahadaki rekabetini değil, sporun
                        kapsayıcı ve dönüştürücü gücünü de görünür kılar. Bu nedenle bu alan,
                        gündelik içerik akışından ayrılan; daha sakin, daha kalıcı ve daha
                        saygılı bir editoryal dille ele alınır.
                    </p>
                    <p class="mt-4 text-white/70 leading-7">
                        Burada amaç yoğun veri takibi yapmak değil; branşın değerini, hafızasını,
                        öne çıkan anlarını ve seçilmiş içeriklerini bir arada sunmaktır.
                    </p>
                </div>

                <div class="lg:col-span-4">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
                        <h3 class="text-white font-semibold text-sm uppercase tracking-wider">
                            Sayfa yaklaşımı
                        </h3>
                        <ul class="mt-4 space-y-3 text-sm text-white/70">
                            <li>• Bilgi ve içerik odaklı</li>
                            <li>• Az ama seçilmiş güncelleme</li>
                            <li>• Kalıcı arşiv hissi</li>
                            <li>• Saygılı ve sade ton</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- ÖNE ÇIKAN BAŞLIKLAR --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-14">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-white text-3xl font-bold">Öne Çıkan Başlıklar</h2>
            </div>

            @php
                $featureCards = [
                    [
                        'title' => 'Tarihçe',
                        'text'  => 'Branşın gelişim çizgisi, kulüp içindeki yeri ve geçmişten bugüne taşıdığı anlam.',
                        'icon'  => '⌛',
                        'featured' => true,
                    ],
                    [
                        'title' => 'Öne Çıkan Başarılar',
                        'text'  => 'Kupalar, eşikler, unutulmayan sezonlar ve hafızada yer eden sportif başarılar.',
                        'icon'  => '🏆',
                        'featured' => false,
                    ],
                    [
                        'title' => 'Unutulmayan İsimler',
                        'text'  => 'Takıma iz bırakan figürler, emek veren isimler ve temsil gücü yüksek hikâyeler.',
                        'icon'  => '★',
                        'featured' => false,
                    ],
                    [
                        'title' => 'Seçilmiş İçerikler',
                        'text'  => 'Sürekli akan bir haber hattı değil; özenle seçilmiş, kalıcı değeri olan içerikler.',
                        'icon'  => '✦',
                        'featured' => false,
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                @foreach ($featureCards as $card)
                    <article class="rounded-2xl border {{ $card['featured'] ? 'border-[var(--ea-accent)]/40 bg-gradient-to-br from-[var(--ea-primary)]/20 to-white/5' : 'border-white/10 bg-white/5' }} p-6 transition hover:bg-white/10">
                        <div class="text-[var(--ea-accent)] text-2xl">{{ $card['icon'] }}</div>
                        <h3 class="mt-4 text-white text-lg font-semibold">{{ $card['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-white/65">{{ $card['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- TARİHÇE --}}
        <section id="tarihce" class="border-y border-white/10 bg-white/[0.02]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7">
                        <h2 class="text-white text-3xl font-bold">Tarihçe ve Arka Plan</h2>
                        <p class="mt-4 text-white/70 leading-7">
                            Engelsiz Aslanlar başlığı altında yer alan bu alan, yalnızca bir branş
                            anlatısı değil; kulübün kapsayıcı spor kültürünün de bir parçasıdır.
                            Buradaki yaklaşım, gündelik hız yerine kalıcı değeri olan bilgileri
                            düzenli ve sade bir yapı içinde sunmaktır.
                        </p>
                        <p class="mt-4 text-white/70 leading-7">
                            İlerleyen aşamalarda bu bölüm daha ayrıntılı tarihçe metinleri,
                            belirli dönem kırılmaları ve kulüp hafızasına katkı sunan içeriklerle
                            zenginleştirilebilir.
                        </p>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                            <img
                                src="{{ asset('images/engelsiz-aslanlar/img-2.webp') }}"
                                alt="Engelsiz Aslanlar tarihçe görseli"
                                class="h-[320px] w-full object-cover"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- BAŞARILAR --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <h2 class="text-white text-3xl font-bold mb-6">Öne Çıkan Başarılar</h2>

            @php
                $achievements = [
                    ['title' => 'Simgesel Eşik', 'desc' => 'Branşın görünürlüğünü artıran ve kulüp hafızasında yer eden önemli bir dönem.'],
                    ['title' => 'Dikkat Çeken Sezon', 'desc' => 'Sonuçtan bağımsız biçimde emek, devamlılık ve temsil açısından öne çıkan süreç.'],
                    ['title' => 'Kurumsal Değer', 'desc' => 'Sahanın ötesine geçen, kulübün kapsayıcılık yaklaşımını görünür kılan bir alan.'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($achievements as $item)
                    <article class="rounded-2xl border border-white/10 bg-white/5 p-6">
                        <h3 class="text-white font-semibold">{{ $item['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-white/65">{{ $item['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- UNUTULMAYAN İSİMLER --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-14">
            <h2 class="text-white text-3xl font-bold mb-6">Unutulmayan İsimler</h2>

            @php
                $people = [
                    ['name' => 'İsim 1', 'role' => 'Sporcu / Temsil figürü', 'text' => 'Takımın ve alanın görünürlüğüne katkı sunan önemli bir figür.', 'image' => 'img-5.webp'],
                    ['name' => 'İsim 2', 'role' => 'Emek veren isim', 'text' => 'Süreklilik, aidiyet ve temsil açısından hatırlanan özel katkılar.', 'image' => 'img-6.webp'],
                    ['name' => 'İsim 3', 'role' => 'Kulüp hafızasında yer eden figür', 'text' => 'Yalnızca sonuçlarla değil, taşıdığı anlamla öne çıkan bir profil.', 'image' => 'img-7.webp'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($people as $person)
                    <article class="overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                        <img
                            src="{{ asset('images/engelsiz-aslanlar/' . $person['image']) }}"
                            alt="{{ $person['name'] }}"
                            class="h-56 w-full object-cover"
                        >
                        <div class="p-6">
                            <h3 class="text-white font-semibold">{{ $person['name'] }}</h3>
                            <p class="mt-1 text-sm text-white/50">{{ $person['role'] }}</p>
                            <p class="mt-3 text-sm leading-6 text-white/65">{{ $person['text'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- SEÇİLMİŞ İÇERİKLER --}}
        <section id="icerikler" class="border-y border-white/10 bg-white/[0.02]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-white text-3xl font-bold">Seçilmiş İçerikler</h2>
                </div>

                @php
                    $contentCards = [
                        [
                            'title' => 'Özel İçerik Başlığı 1',
                            'text' => 'Bu alan, hızlı haber akışından ziyade kalıcı değeri olan seçilmiş içerikler için ayrılmıştır.',
                            'image' => 'img-2.webp',
                        ],
                        [
                            'title' => 'Özel İçerik Başlığı 2',
                            'text' => 'İleride kulüp arşivi, söyleşi, özel dosya veya anı odaklı içeriklerle zenginleştirilebilir.',
                            'image' => 'img-3.webp',
                        ],
                        [
                            'title' => 'Özel İçerik Başlığı 3',
                            'text' => 'Sık güncellenen bir merkez değil; dikkatle seçilmiş ve saklanmak istenen içeriklerin alanı.',
                            'image' => 'img-4.webp',
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    @foreach ($contentCards as $content)
                        <article class="overflow-hidden rounded-2xl border border-white/10 bg-white/5 transition hover:bg-white/10">
                            <img
                                src="{{ asset('images/engelsiz-aslanlar/' . $content['image']) }}"
                                alt="{{ $content['title'] }}"
                                class="aspect-[16/10] w-full object-cover"
                            >
                            <div class="p-6">
                                <h3 class="text-white font-semibold">{{ $content['title'] }}</h3>
                                <p class="mt-3 text-sm leading-6 text-white/65">{{ $content['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- DEĞER ALANI --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <h2 class="text-white text-3xl font-bold mb-6">Değer ve Yaklaşım</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
                    <h3 class="text-white font-semibold">Görünürlük</h3>
                    <p class="mt-3 text-sm leading-6 text-white/65">
                        Bu alan, yalnızca sonuçların değil; emeğin, mücadelenin ve temsilin
                        görünür olmasını amaçlar.
                    </p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
                    <h3 class="text-white font-semibold">Aidiyet</h3>
                    <p class="mt-3 text-sm leading-6 text-white/65">
                        Kulüp kültürü içinde bu başlık, ana akışın dışında değil; onun doğal
                        ve değerli bir parçası olarak ele alınır.
                    </p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
                    <h3 class="text-white font-semibold">Kalıcılık</h3>
                    <p class="mt-3 text-sm leading-6 text-white/65">
                        Buradaki içerik yaklaşımı gündelik hızdan çok, hafıza oluşturan ve
                        uzun süre anlamını koruyan bir dile dayanır.
                    </p>
                </div>
            </div>
        </section>

        {{-- KAPANIŞ --}}
        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="rounded-2xl border border-white/10 bg-gradient-to-r from-[var(--ea-primary)]/10 via-white/5 to-[var(--ea-accent)]/10 p-8 sm:p-10 text-center">
                <h2 class="text-white text-3xl font-bold">Bir sayfa değil, bir duruş alanı</h2>
                <p class="mt-4 text-white/70 leading-7 max-w-3xl mx-auto">
                    Engelsiz Aslanlar, yalnızca spor başlığı olarak değil; kulübün değerleri,
                    kapsayıcılık anlayışı ve ortak hafızası içinde anlam kazanan özel bir alandır.
                </p>
            </div>
        </section>
        </main>
    </div>

@endsection

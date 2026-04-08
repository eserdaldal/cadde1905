@extends('layouts.app')

@section('title', ($pageTitle ?? 'Tarihi Maç') . ' - Cadde1905')

@php
    \Carbon\Carbon::setLocale('tr');
    
    // IMAGE LOGIC
    $mainImage = method_exists($historicalMatch, 'coverImageUrl')
        ? $historicalMatch->coverImageUrl()
        : null;
    $mainImage = !empty($mainImage)
        ? $mainImage
        : asset('images/placeholders/miras-placeholder.webp');

    // READING TIME
    $wordCount = str_word_count(strip_tags((string)$historicalMatch->content));
    $readingTime = max(1, ceil($wordCount / 200));

    // SCORE & OPPONENT
    $scoreHome = $historicalMatch->score_for ?? '-';
    $scoreAway = $historicalMatch->score_against ?? '-';
    $scoreLine = $scoreHome . ' - ' . $scoreAway;
    $opponent = $historicalMatch->opponent ?: 'Bilinmeyen Rakip';

    // MEDIA
    $galleryItems = $historicalMatch->galleryMedia()->orderByPivot('sort_order')->get();
    $videoItem = $historicalMatch->videoMedia()->orderByPivot('sort_order')->first();
    $allGalleryImages = $galleryItems
        ->map(fn ($media) => $media->url ?: ($media->path ? asset('storage/' . ltrim($media->path, '/')) : null))
        ->filter()
        ->values();

    $matchVideoEmbedUrl = null;
    if ($videoItem && ! empty($videoItem->embed_url)) {
        $url = trim((string) $videoItem->embed_url);
        if (str_contains($url, 'youtu.be')) {
            $id = explode('/', parse_url($url, PHP_URL_PATH))[1] ?? null;
            if ($id) $matchVideoEmbedUrl = "https://www.youtube.com/embed/$id";
        } elseif (str_contains($url, 'youtube.com/watch')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $q);
            if (isset($q['v'])) $matchVideoEmbedUrl = "https://www.youtube.com/embed/{$q['v']}";
        } else {
            $matchVideoEmbedUrl = $url;
        }
    }
@endphp


@section('page-header')
<nav class="mb-6 flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] opacity-40 px-6 lg:px-0 max-w-[840px] mx-auto">
    <a href="{{ route('miras.index') }}">Miras</a> <span>/</span>
    <a href="{{ route('miras.matches.index') }}">Tarihi Maçlar</a> <span>/</span>
    <span class="text-red-600">{{ $historicalMatch->competition ?: 'Maç' }}</span>
</nav>
@endsection

@section('content')
<div class="ui-detail-page ui-detail-page--match">
    <div id="ui-detail-progress">
        <div id="ui-detail-progress-fill"></div>
    </div>

    <header class="ui-detail-hero">
        <div class="ui-detail-hero-media"><img src="{{ $mainImage }}" alt="{{ $historicalMatch->title }}"></div>
        <div class="ui-detail-hero-overlay"></div>
        <div class="ui-detail-content">
            <div class="mb-5">
                <span class="px-3 py-1 text-white text-[9px] font-black tracking-widest uppercase rounded accent-bg">
                    {{ $historicalMatch->competition ?: 'ÖZEL MAÇ' }}
                </span>
            </div>

            <h1 class="ui-detail-title">
                {{ $historicalMatch->title }}
            </h1>

            <div class="ui-detail-meta">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-[2px] bg-red-600"></span>
                    @if ($historicalMatch->match_date)
                        {{ \Illuminate\Support\Carbon::parse($historicalMatch->match_date)->translatedFormat('d F Y') }}
                    @endif
                </div>
                <span>{{ $readingTime }} dk okuma</span>
            </div>
        </div>
    </header>

    <main class="ui-detail-layout px-6 lg:px-0">
        @if(!empty($historicalMatch->summary))
            <div class="ui-detail-lead">
                {{ $historicalMatch->summary }}
            </div>
        @endif

        <div class="ui-detail-facts">
            <div class="ui-detail-fact-card">
                <span class="ui-detail-fact-label">Rakip</span>
                <span class="ui-detail-fact-value">{{ $opponent }}</span>
            </div>
            <div class="ui-detail-fact-card">
                <span class="ui-detail-fact-label">Skor</span>
                <span class="ui-detail-fact-value">{{ $scoreLine }}</span>
            </div>
            <div class="ui-detail-fact-card">
                <span class="ui-detail-fact-label">Durum</span>
                <span class="ui-detail-fact-value text-red-500">{{ strtoupper($historicalMatch->result ?: 'TAMAMLANDI') }}</span>
            </div>
        </div>

        @if(!empty($historicalMatch->content))
            <x-rich-content class="ui-detail-body" :html="$historicalMatch->content" />
        @else
            <article class="ui-detail-body">
                <div class="p-16 text-center border border-zinc-800 rounded-3xl bg-zinc-900/10 italic opacity-50">
                    Bu tarihi karşılaşma için henüz bir anlatı metni girilmedi.
                </div>
            </article>
        @endif

        @if($matchVideoEmbedUrl)
            <div class="ui-detail-media rounded-3xl overflow-hidden shadow-2xl bg-black aspect-video">
                <iframe src="{{ $matchVideoEmbedUrl }}" class="w-full h-full border-0" allowfullscreen></iframe>
            </div>
        @endif

        @if($galleryItems->isNotEmpty())
            <div class="ui-detail-media">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-2xl font-black m-0">MAÇ GALERİSİ</h2>
                    <span class="text-[10px] font-black opacity-40">{{ $galleryItems->count() }} GÖRSEL</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($galleryItems as $index => $media)
                        @php
                            $thumbUrl = $media->url ?: ($media->path ? asset('storage/' . ltrim($media->path, '/')) : null);
                        @endphp
                        @if($thumbUrl)
                            <div class="rounded-xl overflow-hidden aspect-video cursor-zoom-in group" onclick="openGSLightbox({{ $index }})">
                                <img src="{{ $thumbUrl }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <div class="ui-detail-page-end mt-24 pt-10 border-t border-zinc-800 flex justify-center pb-20">
            <a href="{{ route('timeline.index') }}" class="px-12 py-5 bg-zinc-900 border border-zinc-800 text-white rounded-full font-black text-xs uppercase tracking-[0.3em] hover:bg-red-700 hover:border-red-700 transition duration-300 shadow-2xl">
                ← TARİHSEL AKIŞA DÖN
            </a>
        </div>
    </main>
</div>

@if($galleryItems->isNotEmpty())
<div id="gs-lightbox" onclick="closeGSLightbox(event)">
    <div class="absolute top-8 right-8 text-white text-5xl cursor-pointer">×</div>
    <img id="gs-lightbox-img" src="" class="max-w-[90%] max-h-[85%] rounded-lg shadow-2xl transition duration-300 opacity-0 scale-95">
</div>
@endif

<script>
    (function() {
        const fill = document.getElementById('ui-detail-progress-fill');
        window.addEventListener('scroll', () => {
            const h = document.documentElement.scrollHeight - window.innerHeight;
            const p = (window.pageYOffset / h) * 100;
            // INLINE_OK: dynamic progress width
            if(fill) fill.style.width = p + '%';
        });

        const imgs = @json($allGalleryImages);
        if (imgs.length) {
            const box = document.getElementById('gs-lightbox');
            const bimg = document.getElementById('gs-lightbox-img');

            window.openGSLightbox = (i) => {
                bimg.src = imgs[i];
                // INLINE_OK: dynamic lightbox visibility
                box.style.display = 'flex';
                setTimeout(() => { bimg.classList.remove('opacity-0','scale-95'); bimg.classList.add('opacity-100','scale-100'); }, 50);
            };
            window.closeGSLightbox = (e) => {
                if(e && e.target !== box && e.target.innerText !== '×') return;
                // INLINE_OK: dynamic lightbox visibility
                box.style.display = 'none';
            };
        }
    })();
</script>
@endsection

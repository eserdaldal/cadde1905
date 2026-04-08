@extends('layouts.app')

@section('title', ($pageTitle ?? $legend->name) . ' - Cadde1905')

@php
    \Carbon\Carbon::setLocale('tr');
    
    // IMAGE LOGIC
    $mainImage = $legend->hasCoverImage() 
        ? $legend->coverImageUrl() 
        : asset('images/placeholders/miras-placeholder.webp');

    // READING TIME
    $wordContent = (string)($legend->summary . ' ' . $legend->content);
    $wordCount = str_word_count(strip_tags($wordContent));
    $readingTime = max(1, ceil($wordCount / 200));

    // MEDIA
    $galleryItems = $legend->galleryMedia()->orderByPivot('sort_order')->get();
    $videoItem = $legend->videoMedia()->orderByPivot('sort_order')->first();
    $allGalleryImages = $galleryItems
        ->map(fn ($media) => $media->url ?: ($media->path ? asset('storage/' . ltrim($media->path, '/')) : null))
        ->filter()
        ->values();

    $legendVideoEmbedUrl = null;
    if ($videoItem && ! empty($videoItem->embed_url)) {
        $url = trim((string) $videoItem->embed_url);
        if (str_contains($url, 'youtu.be')) {
            $id = explode('/', parse_url($url, PHP_URL_PATH))[1] ?? null;
            if ($id) $legendVideoEmbedUrl = "https://www.youtube.com/embed/$id";
        } elseif (str_contains($url, 'youtube.com/watch')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $q);
            if (isset($q['v'])) $legendVideoEmbedUrl = "https://www.youtube.com/embed/{$q['v']}";
        } else {
            $legendVideoEmbedUrl = $url;
        }
    }
@endphp


@section('page-header')
<nav class="mb-6 flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] opacity-40 px-6 lg:px-0 max-w-[840px] mx-auto">
    <a href="{{ route('miras.index') }}">Miras</a> <span>/</span>
    <a href="{{ route('miras.legends.index') }}">Efsaneler</a> <span>/</span>
    <span class="text-red-600">Profil</span>
</nav>
@endsection

@section('content')
<div class="ui-detail-page ui-detail-page--legend">
    <div id="ui-detail-progress">
        <div id="ui-detail-progress-fill"></div>
    </div>

    <header class="ui-detail-hero">
        <div class="ui-detail-hero-media"><img src="{{ $mainImage }}" alt="{{ $legend->name }}"></div>
        <div class="ui-detail-hero-overlay"></div>
        <div class="ui-detail-content">
            <div class="mb-5">
                <span class="px-3 py-1 text-white text-[9px] font-black tracking-widest uppercase rounded accent-bg">
                    KULÜP EFSANESİ
                </span>
            </div>
            <h1 class="ui-detail-title">
                {{ $legend->name }}
            </h1>
            <div class="ui-detail-meta">
                @if(!empty($legend->title)) <span class="text-red-500">{{ $legend->title }}</span> @endif
                @if(!empty($legend->era_start_year))
                    <span>{{ $legend->era_start_year }} - {{ $legend->era_end_year ?: '?' }} DÖNEMİ</span>
                @endif
                <span class="dot"></span>
                <span>{{ $readingTime }} DK YOLCULUK</span>
            </div>
        </div>
    </header>

    <main class="ui-detail-layout px-6 lg:px-0">
        @if(!empty($legend->summary))
            <div class="ui-detail-lead">
                {{ $legend->summary }}
            </div>
        @endif

        @if(!empty($legend->content))
            <x-rich-content class="ui-detail-body" :html="$legend->content" />
        @else
            <article class="ui-detail-body">
                <div class="p-16 text-center border border-zinc-800 rounded-3xl bg-zinc-900/10 italic opacity-50">
                    Efsanemizin biyografisi hazırlanıyor.
                </div>
            </article>
        @endif

        @if($legendVideoEmbedUrl)
            <div class="ui-detail-media rounded-3xl overflow-hidden shadow-2xl bg-black aspect-video">
                <iframe src="{{ $legendVideoEmbedUrl }}" class="w-full h-full border-0" allowfullscreen></iframe>
            </div>
        @endif

        @if($galleryItems->isNotEmpty())
            <div class="ui-detail-media">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-2xl font-black m-0">EFSANE GALERİSİ</h2>
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
            <a href="{{ route('miras.legends.index') }}" class="px-12 py-5 bg-zinc-900 border border-zinc-800 text-white rounded-full font-black text-xs uppercase tracking-[0.3em] hover:bg-red-700 hover:border-red-700 transition duration-300 shadow-2xl">
                ← TÜM EFSANELER
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

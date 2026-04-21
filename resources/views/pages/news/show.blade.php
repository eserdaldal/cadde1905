@extends('layouts.app')

@section('title', $item->title . ' - Haberler')
@section('description', $item->summary ? Str::limit(strip_tags($item->summary), 150) : Str::limit(strip_tags($item->content), 150))

@php
    \Carbon\Carbon::setLocale('tr');
    $newsPlaceholder = asset('images/placeholders/news-placeholder.webp');


    $mainImage = $item->coverImageUrl();
    $categoryName = $item->category->name ?? 'Genel';
    
    // READING TIME
    $wordCount = str_word_count(strip_tags((string)$item->content));
    $readingTime = max(1, ceil($wordCount / 200));

    // Gallery
    $galleryMedia = collect();
    $allGalleryImages = [];
    if (method_exists($item, 'galleryMedia')) {
        $allMedia = $item->galleryMedia()->orderBy('mediaables.sort_order')->get();
        $galleryMedia = $allMedia->reject(fn($m) => asset('storage/'.ltrim($m->path,'/')) === $mainImage);
        foreach($galleryMedia as $media) $allGalleryImages[] = asset('storage/'.ltrim($media->path,'/'));
    }

    $videoEmbedUrl = function ($newsItem) {
        if (! $newsItem || ! method_exists($newsItem, 'videoMedia')) return null;
        $video = $newsItem->videoMedia()->orderBy('mediaables.sort_order')->first();
        if (! $video || empty($video->embed_url)) return null;
        $url = trim((string) $video->embed_url);
        if (str_contains($url, 'youtu.be')) {
             $id = explode('/', parse_url($url, PHP_URL_PATH))[1] ?? null;
             if($id) return "https://www.youtube.com/embed/$id";
        }
        if (str_contains($url, 'youtube.com/watch')) {
             parse_str(parse_url($url, PHP_URL_QUERY), $q);
             if(isset($q['v'])) return "https://www.youtube.com/embed/{$q['v']}";
        }
        return $url;
    };
    $newsVideoEmbedUrl = $videoEmbedUrl($item);
@endphp


@section('page-header')
<nav class="mb-6 mx-auto max-w-[820px] px-6 lg:px-0 flex items-center gap-2 text-[10px] font-black uppercase tracking-widest opacity-40">
    <a href="{{ route('home') }}">Anasayfa</a> <span>/</span>
    <a href="{{ route('news.index') }}">Haberler</a> <span>/</span>
    <span class="accent-text">{{ $categoryName }}</span>
</nav>
@endsection

@section('content')
<div class="ui-detail-page">
    <div id="progress-container">
        <div id="progress-fill"></div>
    </div>

    {{-- HERO CONTRACT --}}
    <header class="ui-detail-hero">
        <div class="ui-detail-hero-media"><img src="{{ $mainImage }}" alt="{{ $item->title }}"></div>
        <div class="ui-detail-hero-overlay"></div>
        <div class="ui-detail-content">
            <div class="mb-5">
                <span class="px-3 py-1 text-white text-[9px] font-black tracking-widest uppercase rounded accent-bg">
                    {{ $categoryName }}
                </span>
            </div>
            <h1 class="ui-detail-title">
                {{ $item->title }}
            </h1>
            @if($item->tags?->count())
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($item->tags as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}"
                           class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full border border-white/10 bg-white/5 text-white/80 hover:text-white hover:bg-white/10 transition">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            <div class="ui-detail-meta">
                <span>{{ $item->published_at ? $item->published_at->translatedFormat('d F Y') : '-' }}</span>
                <span class="dot"></span>
                <span>{{ $readingTime }} dk okuma</span>
            </div>
        </div>
    </header>

    {{-- BODY CONTRACT --}}
    <main class="ui-detail-layout px-6 lg:px-0">
        @if($item->summary)
            <div class="ui-detail-lead">
                {!! $item->summary !!}
            </div>
        @endif

        <x-rich-content class="ui-detail-body" :html="$item->content" />

        @if($newsVideoEmbedUrl)
            <div class="ui-detail-media rounded-3xl overflow-hidden shadow-2xl bg-black aspect-video">
                <iframe src="{{ $newsVideoEmbedUrl }}" class="w-full h-full border-0" allowfullscreen></iframe>
            </div>
        @endif

        @if($galleryMedia->count() > 0)
            <div class="ui-detail-media">
                <h2 class="text-2xl font-black mb-10 ui-section-title">GALERİ</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($galleryMedia as $index => $media)
                        <div class="rounded-xl overflow-hidden aspect-video cursor-zoom-in group" onclick="openGSLightbox({{ $index }})">
                            <img src="{{ asset('storage/' . ltrim($media->path, '/')) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        
        @if(isset($relatedNews) && $relatedNews->count())
            <section class="ui-detail-related">
                <h2>İLGİNİZİ ÇEKEBİLİR</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedNews as $related)
                    <a href="{{ route('news.show', $related->slug) }}" class="group block ui-card">
                        <div class="aspect-video rounded-xl overflow-hidden mb-4">
                            <img 
                                src="{{ $related->coverThumbUrl() }}" 
                                srcset="{{ $related->coverSrcset() }}"
                                sizes="(min-width: 1200px) 380px, (min-width: 768px) 33vw, 100vw"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            >
                        </div>
                        <h4 class="ui-card-title text-lg font-bold group-hover:text-red-500 transition">{{ $related->title }}</h4>
                    </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    {{-- LIGHTBOX --}}
    <div id="gs-lightbox" onclick="closeGSLightbox(event)">
        <button type="button" class="absolute top-6 right-6 text-white text-4xl w-12 h-12 flex items-center justify-center rounded-full bg-black/60 hover:bg-black/80 transition" onclick="closeGSLightbox(event)" aria-label="Galeriyi kapat">×</button>
        <button type="button" class="absolute left-6 top-1/2 -translate-y-1/2 text-white text-3xl w-12 h-12 flex items-center justify-center rounded-full bg-black/50 hover:bg-black/80 transition" onclick="prevGSLightbox(event)" aria-label="Önceki">‹</button>
        <button type="button" class="absolute right-6 top-1/2 -translate-y-1/2 text-white text-3xl w-12 h-12 flex items-center justify-center rounded-full bg-black/50 hover:bg-black/80 transition" onclick="nextGSLightbox(event)" aria-label="Sonraki">›</button>
        <img id="gs-lightbox-img" src="" class="max-w-[90%] max-h-[85%] rounded-lg shadow-2xl transition duration-300 opacity-0 scale-95">
    </div>
</div>

<script>
    (function() {
        // Progress
        const fill = document.getElementById('progress-fill');
        window.addEventListener('scroll', () => {
            const h = document.documentElement.scrollHeight - window.innerHeight;
            const p = (window.pageYOffset / h) * 100;
            // INLINE_OK: dynamic progress width
            if(fill) fill.style.width = p + '%';
        });

        // Lightbox
        const imgs = @json($allGalleryImages);
        let curr = 0;
        const box = document.getElementById('gs-lightbox');
        const bimg = document.getElementById('gs-lightbox-img');

        window.openGSLightbox = (i) => {
            curr = i; bimg.src = imgs[curr];
            // INLINE_OK: dynamic lightbox visibility
            box.style.display = 'flex';
            setTimeout(() => { bimg.classList.remove('opacity-0','scale-95'); bimg.classList.add('opacity-100','scale-100'); }, 50);
        };
        window.closeGSLightbox = (e) => {
            if(e && e.target !== box && e.target.innerText !== '×') return;
            // INLINE_OK: dynamic lightbox visibility
            box.style.display = 'none';
        };
        window.nextGSLightbox = (e) => {
            if (e) e.stopPropagation();
            if (!imgs.length) return;
            curr = (curr + 1) % imgs.length;
            bimg.src = imgs[curr];
        };
        window.prevGSLightbox = (e) => {
            if (e) e.stopPropagation();
            if (!imgs.length) return;
            curr = (curr - 1 + imgs.length) % imgs.length;
            bimg.src = imgs[curr];
        };
    })();
</script>
@endsection

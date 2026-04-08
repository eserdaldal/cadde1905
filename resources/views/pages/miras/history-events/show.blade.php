@extends('layouts.app')

@section('title', ($pageTitle ?? 'Miras') . ' - Cadde1905')

@php
    \Carbon\Carbon::setLocale('tr');
    $primaryCover = $historyEvent->primaryCover()->first();
    $galleryItems = $historyEvent->galleryMedia()->orderByPivot('sort_order')->get();
    $videoItems = $historyEvent->videoMedia()->orderByPivot('sort_order')->get();

    // Word Count & Reading Time
    $wordCount = str_word_count(strip_tags((string)$historyEvent->content));
    $readingTime = max(1, ceil($wordCount / 200));

    $mainImage = $primaryCover ? $primaryCover->url : asset('images/placeholders/miras-placeholder.webp');
    $allGalleryImages = $galleryItems->map->url;
@endphp


@section('page-header')
<nav class="mb-6 flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] opacity-40 px-6 lg:px-0 max-w-[840px] mx-auto">
    <a href="{{ route('miras.index') }}">Miras</a> <span>/</span>
    <span class="text-red-600">{{ $typeLabel }}</span>
</nav>
@endsection

@section('content')
<div class="ui-detail-page">
    <div id="ui-detail-progress">
        <div id="ui-detail-progress-fill"></div>
    </div>

    {{-- HERO CONTRACT --}}
    <header class="ui-detail-hero">
        <div class="ui-detail-hero-media"><img src="{{ $mainImage }}" alt="{{ $historyEvent->title }}"></div>
        <div class="ui-detail-hero-overlay"></div>
        <div class="ui-detail-content">
            <div class="mb-5">
                <span class="px-3 py-1 text-white text-[9px] font-black tracking-widest uppercase rounded accent-bg">
                    {{ $typeLabel }}
                </span>
            </div>
            <h1 class="ui-detail-title">
                {{ $historyEvent->title }}
            </h1>
            <div class="ui-detail-meta">
                @if ($historyEvent->event_date)
                    <span>{{ \Illuminate\Support\Carbon::parse($historyEvent->event_date)->translatedFormat('d F Y') }}</span>
                @else
                    <span>{{ $historyEvent->year }} ARŞİVİ</span>
                @endif
                <span class="dot"></span>
                <span>{{ $readingTime }} DK YOLCULUK</span>
            </div>
        </div>
    </header>

    {{-- BODY CONTRACT --}}
    <main class="ui-detail-layout px-6 lg:px-0">
        @if(!empty($historyEvent->excerpt))
            <div class="ui-detail-lead">
                {{ $historyEvent->excerpt }}
            </div>
        @endif

        @if(!empty($historyEvent->content))
            <x-rich-content class="ui-detail-body" :html="$historyEvent->content" />
        @else
            <article class="ui-detail-body">
                <div class="p-12 text-center border border-zinc-800 rounded-3xl bg-zinc-900/30 italic opacity-50">
                    Sarı ve Kırmızıya adanmış bu tarihsel anlatı için henüz detay metni girilmedi.
                </div>
            </article>
        @endif

        @if($galleryItems->isNotEmpty())
            <div class="ui-detail-media">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-2xl font-black m-0">TARİHSEL GALERİ</h2>
                    <span class="text-[10px] font-black opacity-40">{{ $galleryItems->count() }} GÖRSEL</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($galleryItems as $index => $media)
                        <div class="rounded-xl overflow-hidden aspect-video cursor-zoom-in group" onclick="openGSLightbox({{ $index }})">
                            <img src="{{ $media->url }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($videoItems->isNotEmpty())
            <div class="ui-detail-media">
                <h2 class="text-2xl font-black mb-12">VİDEO ARŞİVİ</h2>
                @foreach ($videoItems as $media)
                    @php
                        $embedSrc = null;
                        if ($media->media_kind === 'embed' && !empty($media->embed_url)) {
                            if (str_contains($media->embed_url, 'youtube.com')) {
                                parse_str(parse_url($media->embed_url, PHP_URL_QUERY), $vars);
                                if(isset($vars['v'])) $embedSrc = "https://www.youtube.com/embed/".$vars['v'];
                            } elseif (str_contains($media->embed_url, 'youtu.be')) {
                                $id = explode('/', parse_url($media->embed_url, PHP_URL_PATH))[1] ?? null;
                                if($id) $embedSrc = "https://www.youtube.com/embed/$id";
                            }
                        }
                    @endphp
                    @if($embedSrc)
                        <div class="mb-12 rounded-3xl overflow-hidden bg-black aspect-video shadow-2xl">
                            <iframe src="{{ $embedSrc }}" class="w-full h-full border-0" allowfullscreen></iframe>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="mt-24 pt-10 border-t border-zinc-800 flex justify-center pb-20">
            <a href="{{ route('timeline.index') }}" class="px-12 py-5 bg-zinc-900 border border-zinc-800 text-white rounded-full font-black text-xs uppercase tracking-[0.3em] hover:bg-red-700 hover:border-red-700 transition duration-300">
                ← KRONOLOJİYE DÖN
            </a>
        </div>
    </main>
</div>

{{-- LIGHTBOX --}}
<div id="gs-lightbox" onclick="closeGSLightbox(event)">
    <div class="absolute top-8 right-8 text-white text-5xl cursor-pointer">×</div>
    <img id="gs-lightbox-img" src="" class="max-w-[90%] max-h-[85%] rounded-lg shadow-2xl transition duration-300 opacity-0 scale-95">
</div>

<script>
    (function() {
        // Progress
        const fill = document.getElementById('ui-detail-progress-fill');
        window.addEventListener('scroll', () => {
            const h = document.documentElement.scrollHeight - window.innerHeight;
            const p = (window.pageYOffset / h) * 100;
            // INLINE_OK: dynamic progress width
            if(fill) fill.style.width = p + '%';
        });

        // Lightbox
        const imgs = @json($allGalleryImages);
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
        }
    })();
</script>
@endsection

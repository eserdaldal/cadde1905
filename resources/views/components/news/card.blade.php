{{-- components/news/card.blade.php — Tek Haber Kartı Bileşeni --}}
@props(['item' => null])

<a class="news-card ui-card" href="{{ route('news.show', ['slug' => $item?->slug ?? '#']) }}">
    <div class="nc-img">
        <img
            src="{{ $item?->coverThumbUrl() ?? asset('images/placeholders/news-placeholder.webp') }}"
            srcset="{{ $item?->coverSrcset() }}"
            sizes="(min-width: 1300px) 400px, (min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
            alt="{{ $item?->title ?? 'Haber' }}"
            loading="lazy"
            onerror="this.onerror=null;this.src='{{ asset('images/placeholders/news-placeholder.webp') }}';"
            style="width: 100%; height: 100%; object-fit: cover; display: block;"
        >

        @if($item?->category?->name ?? 'Haber')
            <span class="nc-cat ct-futbol">{{ $item?->category?->name ?? 'Haber' }}</span>
        @endif
    </div>

    <div class="nc-body">
        <p class="nc-title ui-card-title">{{ $item?->title ?? 'Başlık' }}</p>

        <div class="nc-meta ui-card-meta">
            <span>{{ optional($item?->published_at)->format('d.m.Y') ?? '' }}</span>
        </div>
    </div>
</a>

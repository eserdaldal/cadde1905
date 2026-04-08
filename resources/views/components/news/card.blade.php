{{-- components/news/card.blade.php — Tek Haber Kartı Bileşeni --}}
@props(['item' => null])

<a class="news-card ui-card" href="{{ route('news.show', ['slug' => $item?->slug ?? '#']) }}">
    <div class="nc-img">
        <div class="ip ip-1">📰</div>

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

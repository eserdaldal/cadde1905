@props([
  'items' => collect(),
])

<div class="news-grid">
  @forelse($items as $item)
    <a class="news-card ui-card" href="{{ route('news.show', ['slug' => $item->slug]) }}">
      <div class="nc-img">
        <img
            src="{{ $item->coverThumbUrl() }}"
            srcset="{{ $item->coverSrcset() }}"
            sizes="(min-width: 1300px) 400px, (min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
            alt="{{ $item->title }}"
            loading="lazy"
            onerror="this.onerror=null;this.src='{{ asset('images/placeholders/news-placeholder.webp') }}';"
            style="width: 100%; height: 100%; object-fit: cover; display: block;"
        >
        <span class="nc-cat ct-futbol">{{ $item->category->name ?? 'Haber' }}</span>
      </div>
      <div class="nc-body">
        <p class="nc-title ui-card-title">{{ $item->title }}</p>
        <div class="nc-meta ui-card-meta">
          <span>{{ optional($item->published_at)->format('d M') }}</span>
          <span>♥ {{ $item->like_count ?? 0 }}</span>
        </div>
      </div>
    </a>
  @empty
    <div class="news-card ui-card">
      <div class="nc-body">
        <p class="nc-title ui-card-title">Henüz haber yok</p>
      </div>
    </div>
  @endforelse
</div>

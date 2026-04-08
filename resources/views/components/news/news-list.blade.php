@props(['paginator' => null])

<div class="news-grid">
@forelse(($paginator?->items() ?? []) as $item)

  <a class="news-card ui-card" href="{{ route('news.show', ['slug' => $item?->slug]) }}">
    <div class="nc-body">

      <p class="nc-title ui-card-title">
        {{ $item?->title ?? 'Başlık' }}
      </p>

      <div class="nc-meta ui-card-meta">
        <span>{{ optional($item?->published_at)->format('d.m.Y') }}</span>
      </div>

    </div>
  </a>

@empty

  <div class="news-card ui-card">
    <div class="nc-body">
      <p class="nc-title ui-card-title">Henüz yayınlanmış içerik yok</p>
    </div>
  </div>

@endforelse
</div>

@if($paginator)
  <div class="news-pagination">
    {{ $paginator->links() }}
  </div>
@endif

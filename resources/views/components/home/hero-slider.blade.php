@props([
  'items' => collect(),
])

<div class="hero-news ui-hero" data-hero-slider>
  {{-- Basit progressive yaklaşım: JS yoksa ilk item görünür --}}
  @if($items->first())
    <a href="{{ route('news.show', ['slug' => $items->first()->slug]) }}" class="hero-news ui-hero" style="text-decoration:none;">
      <div class="hero-img">
        <div class="hero-img-overlay"></div>
        <div class="hero-img-label">Öne Çıkan</div>
      </div>
      <div class="hero-content">
        <div class="news-meta ui-hero-meta">
          <span class="cat">{{ $items->first()->category->name ?? 'Haber' }}</span>
          <span>{{ optional($items->first()->published_at)->format('d M Y') }}</span>
        </div>
        <h1 class="hero-title ui-hero-title">{{ $items->first()->title }}</h1>
        <p class="hero-excerpt">{{ $items->first()->excerpt ?? '' }}</p>
        <span class="read-more">Devamını Oku →</span>
      </div>
    </a>
  @else
    <div class="hero-news ui-hero">
      <div class="hero-content">
        <h2 class="hero-title ui-hero-title">Henüz yayınlanmış içerik yok</h2>
        <p class="hero-excerpt">İlk içerikler yayınlandığında burada görünecek.</p>
      </div>
    </div>
  @endif
</div>

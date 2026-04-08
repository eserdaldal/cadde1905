@props(['categories' => []])

<div class="widget">
  <div class="wid-hd"><span class="wid-title">Kategoriler</span></div>

  <div class="cat-list">
    @if(empty($categories))
      <a href="#" class="cat-item active"><span>📰 Tümü</span><span class="cat-count">—</span></a>
      <a href="#" class="cat-item"><span>⚽ Futbol</span><span class="cat-count">—</span></a>
      <a href="#" class="cat-item"><span>📊 Analiz</span><span class="cat-count">—</span></a>
      <a href="#" class="cat-item"><span>📖 Miras</span><span class="cat-count">—</span></a>
    @else
      @foreach($categories as $c)
        <a href="#" class="cat-item">
          <span>{{ $c['label'] ?? $c['name'] ?? 'Kategori' }}</span>
          <span class="cat-count">{{ $c['count'] ?? 0 }}</span>
        </a>
      @endforeach
    @endif
  </div>
</div>
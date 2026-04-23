@php
    $items = is_array($items ?? null) ? $items : [];
@endphp

@if(!empty($items))
<div class="widget widget-popular-content">
  <div class="wid-hd">
    <span class="wid-title">{{ $title ?? 'Popüler İçerikler' }}</span>
  </div>

  <div class="popular-list">
    @foreach($items as $item)
      @php
        $imagePath = $item['image_path'] ?? null;
        $imageUrl = null;

        if (is_string($imagePath) && $imagePath !== '') {
          $imageUrl = (str_starts_with($imagePath, 'http') || str_starts_with($imagePath, '/'))
            ? $imagePath
            : asset('storage/' . ltrim($imagePath, '/'));
        }
      @endphp

      <a href="{{ route('news.show', $item['slug']) }}" class="popular-item">
        @if($imageUrl)
          <div class="popular-thumb-wrap">
            <img src="{{ $imageUrl }}" alt="{{ $item['title'] ?? 'Haber' }}" class="popular-thumb" loading="lazy">
          </div>
        @endif

        <div class="popular-body">
          <div class="popular-title">{{ $item['title'] ?? '' }}</div>

          @if(!empty($item['published_at']))
            <div class="popular-date">
              {{ \Illuminate\Support\Carbon::parse($item['published_at'])->format('d.m.Y') }}
            </div>
          @endif
        </div>
      </a>
    @endforeach
  </div>
</div>

@endif

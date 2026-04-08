@if(!empty($item) && !empty($item['url']) && !empty($item['title']))
<div class="widget widget-on-this-day">
  <div class="wid-hd">
    <span class="wid-title">{{ $title ?? 'Tarihten Bir An' }}</span>
  </div>

  <a href="{{ $item['url'] }}" class="today-link">
    <div class="today-body">
      @if(!empty($item['year']))
        <div class="t-year">{{ $item['year'] }}</div>
      @endif

      <div class="t-title">{{ $item['title'] }}</div>

      @if(!empty($item['excerpt']))
        <div class="t-desc">{{ $item['excerpt'] }}</div>
      @endif
    </div>
  </a>
</div>

@endif

@if (($status ?? 'inactive') === 'ok' && !empty($data['cta_url']) && !empty($data['title']))
<div class="widget campaign-widget widget-dynamic-campaign">
  <div class="wid-hd">
    <span class="wid-title">{{ $data['subtitle'] ?? 'Özel Kampanya' }}</span>
  </div>

  <div class="campaign-body">
    <h3 class="campaign-title">{{ $data['title'] }}</h3>

    @if (!empty($data['description']))
      <p class="campaign-description">{{ $data['description'] }}</p>
    @endif

    <a href="{{ $data['cta_url'] }}" class="campaign-cta">
      {{ $data['cta_label'] ?? 'Detaylara Git' }} →
    </a>
  </div>
</div>
@endif

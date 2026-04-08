<div class="wc-empty-state {{ $class ?? '' }}">
    <div class="wc-empty-state__inner relative z-10">
        @if(isset($icon))
            <div class="wc-empty-state__icon">
                {!! $icon !!}
            </div>
        @else
            <div class="wc-empty-state__icon opacity-20">🔍</div>
        @endif
        <h3 class="wc-empty-state__title">{{ $title }}</h3>
        <p class="wc-empty-state__text italic">{{ $description ?? 'Turnuva hazırlıkları sürüyor, veriler yakında burada paylaşılacaktır.' }}</p>
        
        @if(isset($action))
            <div class="wc-empty-state__action mt-8">
                {!! $action !!}
            </div>
        @endif
    </div>
</div>

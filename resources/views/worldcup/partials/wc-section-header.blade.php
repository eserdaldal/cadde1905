<div class="wc-section-header {{ $class ?? '' }}">
    <div>
        <h2 class="wc-section-header__title">{{ $title }}</h2>
        @if(isset($subtitle))
            <p class="wc-section-header__subtitle">{{ $subtitle }}</p>
        @endif
    </div>
    @if(isset($action))
        <div class="wc-section-header__action">
            {!! $action !!}
        </div>
    @endif
</div>

@php
    $rendered = app(\App\Services\RichContent\RichContentRenderer::class)->render($html ?? '');
@endphp

<div {{ $attributes->class(['rich-content']) }}>
    {!! $rendered !!}
</div>

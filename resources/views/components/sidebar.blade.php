@props(['categories' => []])

@php
$widgets = app(\App\Services\Widgets\SidebarRuntimeService::class)->getVisibleWidgets();
@endphp

<div class="sidebar flex flex-col gap-6">
  @foreach($widgets as $widget)
    <x-dynamic-component :component="$widget['component']" />
  @endforeach
</div>

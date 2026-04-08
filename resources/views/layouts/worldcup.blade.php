@extends('layouts.app')

@once
    @push('scripts')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
@endonce

@section('content')
@php
    $theme = $theme ?? 'dark';
@endphp

<div class="wc-layout event-layout" data-theme="{{ $theme }}">
    @include('worldcup.partials.wc-top-nav')

    <main>
        @yield('worldcup-content')
    </main>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Efsanelerimiz - Cadde1905')


@section('content')
<section style="max-width:1280px; margin:0 auto; padding:40px 20px;">

    {{-- Hero --}}
    <div class="legends-hero">
        <nav class="breadcrumb">
            <a href="{{ route('miras.index') }}">Miras</a>
            <span>/</span>
            <span style="color:var(--red);">Öyküler</span>
        </nav>
        <h1>Efsa<span>ne</span>lerimiz</h1>
        <p>Sarı ve Kırmızıya adanmış hayatlar. Galatasaray'ı Galatasaray yapan kahramanların arşivi.</p>
    </div>

    @if ($items->count() === 0)
        <div class="empty-state">
            <p>Bu sayfada henüz bir efsane öyküsü bulunamadı.</p>
        </div>
    @else
        <div class="legends-grid">
            @foreach ($items as $item)
                <a href="{{ route('miras.legends.show', ['slug' => $item->slug]) }}" class="legend-card">

                    @if ($item->hasCoverImage())
                        <img class="card-img" src="{{ $item->coverImageUrl() }}" alt="{{ $item->name }}">
                    @else
                        <div class="card-no-img">
                            <span>{{ mb_strtoupper(mb_substr($item->name, 0, 2)) }}</span>
                        </div>
                    @endif

                    <div class="card-overlay"></div>

                    <div class="card-body">
                        <div class="card-era">
                            @if(!empty($item->era_start_year))
                                {{ $item->era_start_year }} — {{ $item->era_end_year ?: '...' }}
                            @else
                                EFSANE
                            @endif
                        </div>
                        <div class="card-name">{{ $item->name }}</div>
                        @if(!empty($item->title))
                            <div class="card-title-role">{{ $item->title }}</div>
                        @endif
                        <div class="card-cta">
                            <span>Öyküyü Oku</span>
                            <span>→</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div style="margin-top:60px;">
            {{ $items->links() }}
        </div>
    @endif

</section>
@endsection
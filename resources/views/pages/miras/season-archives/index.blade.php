@extends('layouts.app')

@section('title', 'Sezon Arşivleri - Cadde1905')


@section('content')
<section style="max-width:1280px; margin:0 auto; padding:40px 20px;">

    <div class="seasons-hero">
        <nav class="breadcrumb">
            <a href="{{ route('miras.index') }}">Miras</a>
            <span>/</span>
            <span style="color:var(--yellow);">Kronikler</span>
        </nav>
        <h1>Sezon Arşivleri</h1>
        <p>Galatasaray'ın on yıllara yayılan şanlı mücadelesi. Her sezon bir hikaye, her maç bir hatıra. Tarihimizin tüm dönüm noktaları bu arşivde.</p>
    </div>

    @if ($items->count() === 0)
        <div class="empty-state">
            <p>Bu arşivde henüz bir sezon kaydı bulunamadı.</p>
        </div>
    @else
        <div class="seasons-grid">
            @foreach ($items as $item)
                <a href="{{ route('miras.seasons.show', ['slug' => $item->slug]) }}" class="season-card">

                    <div class="sc-head">
                        <span class="sc-label">{{ $item->season_label }}</span>
                        <span class="sc-dot"></span>
                    </div>
                    <div class="sc-title">{{ $item->title }}</div>

                    <div class="sc-img">
                        @if ($item->hasCoverImage())
                            <img src="{{ $item->coverImageUrl() }}" alt="{{ $item->title }}">
                        @else
                            <div class="sc-no-img"><span>GS</span></div>
                        @endif
                    </div>

                    <div class="sc-foot">
                        @if($item->manager_name)
                            <div class="sc-manager">TD: {{ $item->manager_name }}</div>
                        @endif
                        <div class="sc-cta">
                            <span>Arşivi Aç</span>
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
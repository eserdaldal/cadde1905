@extends('layouts.app')

@section('title', 'Tarihi Maçlar - Cadde1905')


@section('content')
<section style="max-width:1280px; margin:0 auto; padding:40px 20px;">

    <div class="matches-hero">
        <nav class="breadcrumb">
            <a href="{{ route('miras.index') }}">Miras</a>
            <span>/</span>
            <span style="color:var(--red);">Klasikler</span>
        </nav>
        <h1>Tarihi Maçlar</h1>
        <p>Galatasaray tarihinin dönüm noktası olan karşılaşmalar, geri dönüşler ve unutulmaz zaferler. Her maç bir destan, her skor bir ders.</p>
    </div>

    @if ($items->count() === 0)
        <div class="empty-state">
            <p>Arşivde henüz bir klasik maç bulunamadı.</p>
        </div>
    @else
        <div class="matches-grid">
            @foreach ($items as $item)
                <a href="{{ route('miras.matches.show', ['slug' => $item->slug]) }}" class="match-card">

                    <div class="mc-img">
                        @php $coverUrl = method_exists($item, 'coverImageUrl') ? $item->coverImageUrl() : null; @endphp
                        @if (!empty($coverUrl))
                            <img src="{{ $coverUrl }}" alt="{{ $item->title }}">
                        @else
                            <div class="mc-no-img"><span>⚽</span></div>
                        @endif
                        <div class="mc-grad"></div>
                        <span class="mc-competition">{{ $item->competition ?: 'ÖZEL MAÇ' }}</span>
                        <div class="mc-score">{{ $item->score_for ?? '-' }} – {{ $item->score_against ?? '-' }}</div>
                    </div>

                    <div class="mc-body">
                        <div class="mc-date">
                            @if ($item->match_date)
                                {{ \Illuminate\Support\Carbon::parse($item->match_date)->translatedFormat('d F Y') }}
                            @else
                                TARİH BELİRTİLMEDİ
                            @endif
                        </div>
                        <div class="mc-title">{{ $item->title }}</div>
                        @if(!empty($item->opponent))
                            <div class="mc-opponent">Rakip: {{ $item->opponent }}</div>
                        @endif
                        <div class="mc-cta">
                            <span>Maçı İncele</span>
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

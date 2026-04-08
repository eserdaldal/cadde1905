@extends('layouts.app')

@section('title', 'Başarılarımız - Cadde1905')


@section('content')
<section style="max-width:1280px; margin:0 auto; padding:40px 20px;">

    <div class="trophies-hero">
        <nav class="breadcrumb">
            <a href="{{ route('miras.index') }}">Miras</a>
            <span>/</span>
            <span style="color:var(--yellow);">Gurur Tablosu</span>
        </nav>
        <h1>Başarılarımız</h1>
        <p>Müzemizdeki her kupa bir alın terinin, bir inanmışlığın ve büyük bir tutkunun eseridir. Galatasaray tarihinin en parlak sayfaları.</p>
    </div>

    @if ($items->count() === 0)
        <div class="empty-state">
            <p>Bu müzede henüz sergilenen bir başarı bulunamadı.</p>
        </div>
    @else
        <div class="trophies-grid">
            @foreach ($items as $item)
                <a href="{{ route('miras.trophies.show', ['slug' => $item->slug]) }}" class="trophy-card">

                    <div class="tc-img-wrap">
                        @if ($item->hasCoverImage())
                            <img src="{{ $item->coverImageUrl() }}" alt="{{ $item->name }}">
                        @else
                            <div class="tc-placeholder"><span>🏆</span></div>
                        @endif
                        <span class="tc-badge">{{ $item->branch ?: 'FUTBOL' }}</span>
                    </div>

                    <div class="tc-body">
                        <div class="tc-meta">
                            <span class="tc-branch">{{ $item->branch ?: 'FUTBOL' }}</span>
                            @if($item->trophy_scope)
                                <span class="tc-scope">· {{ $item->trophy_scope }}</span>
                            @endif
                        </div>
                        <div class="tc-name">{{ $item->name }}</div>
                        @if(!empty($item->excerpt))
                            <p class="tc-excerpt">{{ $item->excerpt }}</p>
                        @endif
                        <div class="tc-cta">
                            <span>Hikayeyi Oku</span>
                            <span class="tc-arrow">→</span>
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
@extends('layouts.app')

@section('title', ($pageTitle ?? 'Miras') . ' - Cadde1905')


@section('content')
<div class="he-page" data-type="{{ $type }}" style="max-width:1280px; margin:0 auto; padding:40px 20px;">

    {{-- Hero --}}
    <div class="he-hero">
        <nav class="breadcrumb">
            <a href="{{ route('miras.index') }}">Miras</a>
            <span>/</span>
            <span class="bc-type">{{ $pageTitle }}</span>
        </nav>
        <h1>{{ $pageTitle }}</h1>
        <p>{{ $pageDescription }}</p>
    </div>

    @if ($items->count() === 0)
        <div class="he-empty">
            <p>Bu kategoride henüz bir kayıt bulunamadı.</p>
        </div>
    @else
        <div class="he-grid">
            @foreach ($items as $item)
                @php
                    $routeName = match ($type) {
                        'moment'      => 'miras.moments.show',
                        'era'         => 'miras.eras.show',
                        'squad'       => 'miras.squads.show',
                        'achievement' => 'miras.achievements.show',
                        'milestone'   => 'miras.milestones.show',
                        default       => null,
                    };
                    $detailUrl = $routeName ? route($routeName, ['slug' => $item->slug]) : '#';
                @endphp

                <a href="{{ $detailUrl }}" class="he-card">

                    <div class="hc-meta">
                        <span class="hc-date">
                            @if ($item->event_date)
                                {{ \Illuminate\Support\Carbon::parse($item->event_date)->format('d.m.Y') }}
                            @elseif ($item->year)
                                {{ $item->year }}
                            @else
                                TARİH BELİRTİLMEDİ
                            @endif
                        </span>
                        <span class="hc-dot"></span>
                    </div>

                    <div class="hc-title">{{ $item->title }}</div>

                    <p class="hc-desc">
                        {{ $item->excerpt ?: ($item->description ?: 'Bu içeriğin detaylarını incelemek için tıklayın.') }}
                    </p>

                    <div class="hc-cta">
                        <span class="hc-cta-label">Detayları Oku</span>
                        <span class="hc-cta-arrow">→</span>
                    </div>

                </a>
            @endforeach
        </div>

        <div style="margin-top:60px;">
            {{ $items->links() }}
        </div>
    @endif

</div>
@endsection
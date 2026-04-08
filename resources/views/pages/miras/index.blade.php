@extends('layouts.app')


@section('content')

{{-- 1. HERO (SİNEMATİK) --}}
<div class="miras-hero">
    <div class="miras-hero-content">
        <h1 class="miras-hero-title">Kulüp Mirası</h1>
        <p class="miras-hero-desc">{{ $pageDescription ?? 'Galatasaray tarihinin dönüm noktaları, unutulmaz zaferleri, efsaneleri ve onurla taşınan mirası bu alanda birleşiyor. Geçmişin ağırlığı, geleceğin ışığı.' }}</p>
    </div>
</div>

{{-- 2. EFSANELER (PRESTİJLİ) --}}
<div class="miras-section miras-section--achievements">
    <div class="miras-section-hd">
        <h2 class="miras-sec-title">Efsanelerimiz</h2>
        <a href="{{ route('miras.legends.index') }}" class="miras-sec-link">Saygı Kuşağına Git &rarr;</a>
    </div>
    
    <div class="m-grid" style="grid-template-columns: 1fr;">
        @if(isset($featuredLegend) && $featuredLegend)
            <a href="{{ route('miras.legends.show', $featuredLegend->slug) }}" class="card-legend">
                <div class="m-card-title">{{ $featuredLegend->name }}</div>
                <div class="m-card-meta">Dönem: {{ $featuredLegend->era_start_year }} - {{ $featuredLegend->era_end_year ?? 'Sonsuz' }}</div>
                @if($featuredLegend->role)
                <div class="m-card-role">{{ $featuredLegend->role }}</div>
                @endif
            </a>
        @else
            <div class="card-fallback">
                <div class="fallback-title font-bold text-[var(--text)]">Efsaneler Galerisi</div>
                <div class="text-sm mt-2">Şanlı tarihimizin isimleri çok yakında...</div>
            </div>
        @endif
    </div>
</div>

{{-- 3. BÜYÜK ZAFERLER VE KUPALAR (ALTIN VURGU) --}}
<div class="miras-section miras-section--seasons">
    <div class="miras-section-hd">
        <h2 class="miras-sec-title">Büyük Zaferler ve Kupalar</h2>
        <a href="{{ route('miras.achievements.index') }}" class="miras-sec-link">Müzeyi Keşfet &rarr;</a>
    </div>
    
    <div class="m-grid">
        @if(isset($featuredAchievement) && $featuredAchievement)
            <a href="{{ route('miras.achievements.show', $featuredAchievement->slug) }}" class="card-trophy">
                <div class="m-card-title">{{ $featuredAchievement->title }}</div>
                <div class="m-card-meta">{{ \Carbon\Carbon::parse($featuredAchievement->event_date)->format('d.m.Y') }} &middot; Unutulmaz Başarı</div>
            </a>
        @else
            <div class="card-fallback border-amber-500/20">
                <div class="fallback-title font-bold text-[var(--yellow)]">Tarihi Geceler</div>
                <div class="text-xs mt-2">Avrupa'yı titreten destanlar taranıyor.</div>
            </div>
        @endif

        @if(isset($featuredTrophies) && $featuredTrophies->count() > 0)
            @php $trophy = $featuredTrophies->first(); @endphp
            <a href="{{ route('miras.trophies.show', $trophy->slug) }}" class="card-trophy">
                <div class="m-card-title text-[var(--text)]">{{ $trophy->name }}</div>
                <div class="m-card-meta text-[var(--yellow)]">{{ $trophy->description ?? 'Müzemizin En Parlak Parçalarından' }}</div>
            </a>
        @else
            <div class="card-fallback border-amber-500/20">
                <div class="fallback-title font-bold text-[var(--text)]">Kupa Sergisi</div>
                <div class="fallback-desc text-xs mt-2 text-[var(--yellow)]">Avrupa Kupaları dijital vitrine çıkacak.</div>
            </div>
        @endif
    </div>
</div>

{{-- 4. TARİHİ MAÇLAR (TIMELINE HİSİ) --}}
<div class="miras-section miras-section--timeline">
    <div class="miras-section-hd">
        <h2 class="miras-sec-title">Tarihi Maçlar</h2>
        <a href="{{ route('miras.matches.index') }}" class="miras-sec-link">Maç Merkezi İstihbaratı &rarr;</a>
    </div>
    
    <div>
        @if(isset($featuredMatch) && $featuredMatch)
            <a href="{{ route('miras.matches.show', $featuredMatch->slug) }}" class="match-item">
                <div class="match-date">{{ \Carbon\Carbon::parse($featuredMatch->match_date)->format('Y') }}</div>
                <div class="match-title">
                    {{ $featuredMatch->home_team_name }}
                    <span class="match-score">{{ $featuredMatch->home_score }} - {{ $featuredMatch->away_score }}</span> 
                    {{ $featuredMatch->away_team_name }}
                </div>
                <div class="match-meta">{{ $featuredMatch->competition_name }}</div>
            </a>
        @else
            <div class="card-fallback">
                <div class="fallback-title font-bold mb-2 text-[var(--text)]">Avrupa Serüvenleri</div>
                <div>Maç kayıtları bekleniyor...</div>
            </div>
        @endif
    </div>
</div>

{{-- 5. SEZON DOSYALARI (CİDDİ ARŞİV) --}}
<div class="miras-section">
    <div class="miras-section-hd">
        <h2 class="miras-sec-title">Sezon Dosyaları</h2>
        <a href="{{ route('miras.seasons.index') }}" class="miras-sec-link">Açık Arşiv &rarr;</a>
    </div>
    
    <div class="m-grid" style="grid-template-columns: 1fr;">
        @if(isset($featuredSeason) && $featuredSeason)
            <a href="{{ route('miras.seasons.show', $featuredSeason->slug) }}" class="card-season">
                <div class="m-card-title">{{ $featuredSeason->title }}</div>
                <div class="m-card-meta">Dönem: {{ $featuredSeason->start_year }}-{{ $featuredSeason->end_year }} &middot; Teknik Heyet: {{ $featuredSeason->manager_name ?? 'Bilinmiyor' }}</div>
            </a>
        @else
            <div class="card-fallback rounded">
                <div class="fallback-title font-mono font-bold text-[var(--text)]">KLASÖR LİSTESİ BOŞ</div>
                <div class="text-xs mt-2">Geçmiş sezon dosyaları indeksleniyor...</div>
            </div>
        @endif
    </div>
</div>

{{-- 6. KRONOLOJİ (ZAMAN TÜNELİ) --}}
<div class="miras-section">
    <div class="miras-section-hd">
        <h2 class="miras-sec-title">Kronoloji Önizlemesi</h2>
    </div>
    
    <div>
        @if(isset($featuredMoments) && $featuredMoments->count() > 0)
            @foreach($featuredMoments as $moment)
            <a href="{{ route('miras.moments.show', $moment->slug) }}" class="timeline-item">
                <div class="tm-year text-[var(--red)] font-black">{{ $moment->year }}</div>
                <div class="tm-title">{{ $moment->title }}</div>
                <span class="tm-meta text-[var(--muted)] text-xs">Olay Tarihi: {{ \Carbon\Carbon::parse($moment->event_date)->format('d.m.Y') }}</span>
            </a>
            @endforeach
        @else
            <div class="timeline-item">
                <div class="tm-year text-[var(--red)] font-black">1905</div>
                <div class="tm-title">Temeller Atıldı</div>
                <span class="tm-meta">Tarihe Not</span>
            </div>
            <div class="timeline-item">
                <div class="tm-year text-[var(--red)] font-black">2000</div>
                <div class="tm-title">Avrupa Dağlandı</div>
                <span class="tm-meta">Kupa Beyi</span>
            </div>
        @endif
        
        <div class="text-center mt-8">
            <a href="{{ route('timeline.index') }}" class="timeline-cta-btn">Tüm Zaman Tüneli &rarr;</a>
        </div>
    </div>
</div>

@endsection

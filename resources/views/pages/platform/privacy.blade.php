@extends('layouts.app')

@section('title', 'Gizlilik Politikası — CADDE1905')

@section('content')
<div class="platform-page platform-page--narrow">
    <div class="platform-backline">
        <a href="{{ route('platform.index') }}" class="platform-backlink">← Platforma dön</a>
    </div>

    <section class="platform-hero platform-hero--inner mb-6">
        <div class="platform-hero-content">
            <p class="platform-kicker">Yasal</p>
            <h1 class="platform-title">Gizlilik Politikası</h1>
            <p class="platform-description">
                Bu sayfa, platformun mevcut veri işleme yaklaşımını ve kullanıcı gizliliğine dair temel çerçeveyi açıklar.
            </p>
        </div>
    </section>

    <div class="space-y-6">
        <section class="platform-content-card">
            <h2 class="platform-section-title">Genel yaklaşım</h2>

            <p>
                CADDE1905 platformu, kullanıcı gizliliğine önem verir. Mevcut aşamada platform,
                kullanıcı hesabı oluşturma veya doğrudan kişisel veri toplama sistemi içermez.
            </p>

            <p>
                Platform kullanımı sırasında yalnızca teknik gereklilikler kapsamında sınırlı veri
                işlenebilir. Buna sunucu logları, güvenlik amaçlı teknik kayıtlar veya temel sistem
                analizleri dahil olabilir.
            </p>
        </section>

        <section class="platform-content-card">
            <h2 class="platform-section-title">Şu an ne yapılmaz?</h2>

            <p>
                Mevcut yapı içinde kullanıcı profili oluşturma, üyelik hesabı açma, kişiselleştirilmiş
                panel sunma veya kullanıcıya ait geniş kapsamlı kişisel veri toplama süreçleri aktif değildir.
            </p>

            <p>
                İlerleyen aşamalarda kullanıcı sistemi devreye alınması durumunda, veri işleme süreçleri
                bu sayfa üzerinden güncellenerek açık şekilde kullanıcıların bilgisine sunulacaktır.
            </p>

            <div class="platform-related">
                <a href="{{ route('platform.terms') }}">Kullanım Şartları</a>
                <a href="{{ route('platform.kvkk') }}">KVKK</a>
                <a href="{{ route('platform.index') }}">Platform</a>
            </div>
        </section>
    </div>
</div>
@endsection

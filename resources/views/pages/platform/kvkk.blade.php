@extends('layouts.app')

@section('title', 'KVKK — CADDE1905')

@section('content')
<div class="platform-page platform-page--narrow">
    <div class="platform-backline">
        <a href="{{ route('platform.index') }}" class="platform-backlink">← Platforma dön</a>
    </div>

    <section class="platform-hero platform-hero--inner mb-6">
        <div class="platform-hero-content">
            <p class="platform-kicker">Yasal</p>
            <h1 class="platform-title">KVKK</h1>
            <p class="platform-description">
                Bu sayfa, 6698 sayılı Kanun kapsamında platformun mevcut veri yaklaşımına ilişkin genel bilgilendirme metnidir.
            </p>
        </div>
    </section>

    <div class="space-y-6">
        <section class="platform-content-card">
            <h2 class="platform-section-title">Mevcut durum</h2>

            <p>
                CADDE1905 platformu, mevcut aşamada kullanıcıdan doğrudan kişisel veri toplayan
                aktif bir üyelik veya hesap sistemi içermez.
            </p>

            <p>
                Bu nedenle platformun mevcut yapısında, geniş kapsamlı kullanıcı verisi işleme
                süreçleri ana hizmet modeli olarak çalışmaz.
            </p>
        </section>

        <section class="platform-content-card">
            <h2 class="platform-section-title">İleride güncellenebilecek alanlar</h2>

            <p>
                Platformun ilerleyen aşamalarında kullanıcı sistemi veya veri işleme süreçleri
                devreye alınması durumunda, 6698 sayılı Kişisel Verilerin Korunması Kanunu
                kapsamında gerekli aydınlatma metinleri bu sayfa üzerinden güncellenecektir.
            </p>

            <p>
                Kişisel verilerin korunmasına ilişkin talepler için:
                <strong>info@cadde1905.com</strong>
            </p>

            <div class="platform-related">
                <a href="{{ route('platform.privacy') }}">Gizlilik Politikası</a>
                <a href="{{ route('platform.terms') }}">Kullanım Şartları</a>
                <a href="{{ route('platform.index') }}">Platform</a>
            </div>
        </section>
    </div>
</div>
@endsection

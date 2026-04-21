@extends('layouts.app')

@section('title', 'Platform — CADDE1905')

@section('content')
<div class="platform-page">
    <section class="platform-hero">
        <div class="platform-hero-content">
            <p class="platform-kicker">Kurumsal Merkez</p>
            <h1 class="platform-title">Platform</h1>
            <p class="platform-description">
                CADDE1905 platform alanı; kurumsal bilgiler, iletişim başlıkları ve yasal dokümanları
                tek merkezde toplayarak daha düzenli, daha açık ve daha güven veren bir yapı sunmak için oluşturuldu.
            </p>
        </div>
    </section>

    <section class="platform-content-card platform-intro-card">
        <h2 class="platform-section-title">Bu alanda ne var?</h2>
        <p>
            Platform sayfası, CADDE1905 içindeki kurumsal ve yasal başlıkları tek bir merkez altında toplar.
            Böylece global menü sade kalırken, kullanıcı ihtiyaç duyduğu temel bilgilere doğrudan ve düzenli
            bir şekilde ulaşabilir.
        </p>
        <p>
            Bu alan; platformun kendisini nasıl tanımladığını, hangi iletişim kanallarını kullandığını ve
            mevcut yayın yapısında hangi yasal çerçeveyi esas aldığını açık biçimde sunmak için tasarlanmıştır.
        </p>
    </section>

    <section class="platform-group platform-group--spaced">
        <div class="platform-group-head">
            <p class="platform-kicker">Kurumsal</p>
            <div class="platform-group-line"></div>
        </div>

        <div class="platform-grid">
            <a href="{{ route('platform.about') }}" class="platform-card">
                <h2 class="platform-card-title">Hakkımızda</h2>
                <p class="platform-card-copy">
                    Platformun amacı, yayın yaklaşımı, bağımsız konumu ve editoryal çerçevesi hakkında temel bilgiler.
                </p>
            </a>

            <a href="{{ route('platform.contact') }}" class="platform-card">
                <h2 class="platform-card-title">İletişim</h2>
                <p class="platform-card-copy">
                    Geri bildirim, öneri, düzeltme talebi ve genel iletişim başlıkları için kullanılan resmi temas alanı.
                </p>
            </a>
        </div>
    </section>

    <section class="platform-group">
        <div class="platform-group-head">
            <p class="platform-kicker">Yasal</p>
            <div class="platform-group-line"></div>
        </div>

        <div class="platform-grid">
            <a href="{{ route('platform.privacy') }}" class="platform-card">
                <h2 class="platform-card-title">Gizlilik Politikası</h2>
                <p class="platform-card-copy">
                    Platformun mevcut veri yaklaşımı, kullanıcı gizliliği ve teknik veri işleme çerçevesi.
                </p>
            </a>

            <a href="{{ route('platform.terms') }}" class="platform-card">
                <h2 class="platform-card-title">Kullanım Şartları</h2>
                <p class="platform-card-copy">
                    Platform kullanımına ilişkin temel kurallar, sorumluluk sınırları ve genel çerçeve.
                </p>
            </a>

            <a href="{{ route('platform.kvkk') }}" class="platform-card">
                <h2 class="platform-card-title">KVKK</h2>
                <p class="platform-card-copy">
                    6698 sayılı Kanun kapsamında mevcut veri yaklaşımına ilişkin genel bilgilendirme metni.
                </p>
            </a>
        </div>
    </section>
</div>
@endsection

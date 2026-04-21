@extends('layouts.app')

@section('title', 'Kullanım Şartları — CADDE1905')

@section('content')
<div class="platform-page platform-page--narrow">
    <div class="platform-backline">
        <a href="{{ route('platform.index') }}" class="platform-backlink">← Platforma dön</a>
    </div>

    <section class="platform-hero platform-hero--inner mb-6">
        <div class="platform-hero-content">
            <p class="platform-kicker">Yasal</p>
            <h1 class="platform-title">Kullanım Şartları</h1>
            <p class="platform-description">
                Bu sayfa, platformun kullanımına ilişkin temel kuralları ve sorumluluk çerçevesini açıklar.
            </p>
        </div>
    </section>

    <div class="space-y-6">
        <section class="platform-content-card">
            <h2 class="platform-section-title">Genel kullanım</h2>

            <p>
                CADDE1905 platformunu kullanan tüm kullanıcılar, bu sayfada belirtilen kullanım
                koşullarını kabul etmiş sayılır.
            </p>

            <p>
                Platformda yayınlanan içerikler bilgilendirme ve içerik sunumu amacı taşır.
                İçeriklerin doğruluğu için özen gösterilmekle birlikte, kesinlik veya garanti
                taahhüdü verilmez.
            </p>

            <p>
                CADDE1905, Galatasaray Spor Kulübü'nün resmi yayını değildir.
            </p>
        </section>

        <section class="platform-content-card">
            <h2 class="platform-section-title">Sorumluluk sınırı</h2>

            <p>
                Platformda yer alan içerikler editoryal çerçevede hazırlanır. Ancak kullanıcılar,
                platformda yer alan bilgileri tek ve kesin kaynak olarak değerlendirmemelidir.
            </p>

            <p>
                Kullanıcılar, platformu hukuka aykırı amaçlarla kullanamaz. Teknik yapıya zarar verme,
                yanıltıcı kullanım veya kötüye kullanım niteliği taşıyan davranışlar kabul edilmez.
            </p>

            <div class="platform-related">
                <a href="{{ route('platform.privacy') }}">Gizlilik Politikası</a>
                <a href="{{ route('platform.kvkk') }}">KVKK</a>
                <a href="{{ route('platform.index') }}">Platform</a>
            </div>
        </section>
    </div>
</div>
@endsection

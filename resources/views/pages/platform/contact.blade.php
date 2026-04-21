@extends('layouts.app')

@section('title', 'İletişim — CADDE1905')

@section('content')
<div class="platform-page platform-page--narrow">
    <div class="platform-backline">
        <a href="{{ route('platform.index') }}" class="platform-backlink">← Platforma dön</a>
    </div>

    <section class="platform-hero platform-hero--inner mb-6">
        <div class="platform-hero-content">
            <p class="platform-kicker">Kurumsal</p>
            <h1 class="platform-title">İletişim</h1>
            <p class="platform-description">
                Platform ile ilgili tüm iletişim başlıkları bu sayfa üzerinden yürütülmektedir.
            </p>
        </div>
    </section>

    <div class="space-y-6">
        <section class="platform-content-card">
            <h2 class="platform-section-title">İletişim</h2>

            <p>
                CADDE1905 platformu ile ilgili tüm geri bildirim, öneri ve iletişim talepleriniz için
                aşağıdaki e-posta adresi üzerinden bizimle iletişime geçebilirsiniz:
            </p>

            <p>
                <strong>info@cadde1905.com</strong>
            </p>

            <p>
                Gönderilen talepler içerik kapsamına göre değerlendirilir ve uygun durumlarda
                geri dönüş sağlanır.
            </p>
        </section>

        <section class="platform-content-card">
            <h2 class="platform-section-title">Hangi konularda yazabilirsiniz?</h2>

            <p>
                İçerik geri bildirimi, teknik sorun bildirimi, düzeltme talebi, genel öneri veya
                iletişim gerektiren diğer başlıklar için bu adres kullanılabilir.
            </p>

            <p>
                Platform, resmi kurum niteliğinde bir destek merkezi değildir; bu nedenle her mesaja
                anlık yanıt verilmesi garanti edilmez. Ancak uygun görülen başlıklarda düzenli dönüş
                sağlanması hedeflenir.
            </p>

            <div class="platform-related">
                <a href="{{ route('platform.about') }}">Hakkımızda</a>
                <a href="{{ route('platform.index') }}">Platform</a>
            </div>
        </section>
    </div>
</div>
@endsection

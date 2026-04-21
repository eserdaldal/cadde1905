@extends('layouts.app')

@section('title', 'Hakkımızda — CADDE1905')

@section('content')
<div class="platform-page platform-page--narrow">
    <div class="platform-backline">
        <a href="{{ route('platform.index') }}" class="platform-backlink">← Platforma dön</a>
    </div>

    <section class="platform-hero platform-hero--inner mb-6">
        <div class="platform-hero-content">
            <p class="platform-kicker">Kurumsal</p>
            <h1 class="platform-title">Hakkımızda</h1>
            <p class="platform-description">
                CADDE1905, Galatasaray'ın tarihini, kültürünü ve anlatısını modern bir dijital yayın yapısı içinde
                düzenli, erişilebilir ve editoryal sorumluluk taşıyan bir platform olarak sunmak için oluşturulmuştur.
            </p>
        </div>
    </section>

    <div class="space-y-6">
        <section class="platform-content-card">
            <h2 class="platform-section-title">Platformun amacı</h2>

            <p>
                CADDE1905; Galatasaray odağında içerik, hafıza ve anlatıyı tek bir yapıda toplama hedefiyle kurulan
                bağımsız bir platformdur. Amaç yalnızca güncel içerik üretmek değil, aynı zamanda kulübün tarihsel
                birikimini, önemli isimlerini, kırılma anlarını ve topluluk hafızasını düzenli biçimde sunmaktır.
            </p>

            <p>
                Platform, güncel yayın ile tarihsel içerik arasında kopukluk kurmak yerine; haber, analiz, arşiv ve
                kültürel bağlamı birbirini destekleyen bir bütün olarak ele alır. Böylece kullanıcı yalnızca yeni
                gelişmeleri değil, o gelişmelerin bağlamını da görebilir.
            </p>
        </section>

        <section class="platform-content-card">
            <h2 class="platform-section-title">Yayın yaklaşımı</h2>

            <p>
                CADDE1905, tıklama odaklı ve yüzeysel içerik anlayışından uzak durmayı hedefler. Öncelik; abartılı
                başlıklar üretmek değil, daha doğru, daha temiz ve daha anlamlı bir yayın standardı kurmaktır.
            </p>

            <p>
                Bu nedenle içerik yaklaşımında; doğruluk, bağlam, dil disiplini ve editoryal denge temel kabul edilir.
                Haber, yorum veya tarihsel içerik fark etmeksizin her metnin anlaşılır, düzenli ve uzun vadede değer
                taşıyan bir yapıda olması amaçlanır.
            </p>

            <p>
                Platform içinde yer alan içerikler zamanla genişleyebilir, güncellenebilir veya yeniden yapılandırılabilir.
                Bu süreç, rastgele büyüme yerine editoryal bütünlük gözetilerek yürütülür.
            </p>
        </section>

        <section class="platform-content-card">
            <h2 class="platform-section-title">Bağımsızlık ve konumlanma</h2>

            <p>
                CADDE1905, Galatasaray Spor Kulübü'nün resmi bir yayını değildir. Platform; kulüp adına konuşan,
                resmi açıklama yapan veya kurumsal temsil iddiası taşıyan bir yapı olarak konumlanmaz.
            </p>

            <p>
                Bununla birlikte, bağımsız olmak düzensiz olmak anlamına gelmez. Platform, içerik üretiminde
                editoryal sorumluluk, kaynak bilinci ve yayın ciddiyetini esas alır. Hedef; resmi olmayan ama
                ciddiyetsiz de olmayan bir yayın çizgisi kurmaktır.
            </p>

            <p>
                CADDE1905'in konumu; taraftar bakışını merkezde tutan, fakat bunu yalnızca duygusal reflekslerle değil,
                içerik kalitesi ve yapı disipliniyle destekleyen bağımsız bir yayın alanı olmaktır.
            </p>
        </section>

        <section class="platform-content-card">
            <h2 class="platform-section-title">Ne yapmak ister?</h2>

            <p>
                Platform uzun vadede yalnızca haber akışı sunan bir alan olarak kalmayı değil; Galatasaray etrafında
                gelişen anlatıyı farklı katmanlarda düzenlemeyi hedefler. Buna güncel haberler, tarihsel içerikler,
                özel dosyalar, arşiv yapıları ve zaman içinde genişleyebilecek topluluk katkıları dahildir.
            </p>

            <p>
                Hedef; günlük akışla sınırlı olmayan, dönüp tekrar bakılabilir bir içerik omurgası oluşturmaktır.
                Böylece CADDE1905, yalnızca “bugün ne oldu?” sorusuna değil, “bu neden önemli?” sorusuna da cevap
                verebilen bir yapıya dönüşür.
            </p>
        </section>

        <section class="platform-content-card">
            <h2 class="platform-section-title">Editoryal çerçeve</h2>

            <p>
                Platformda yer alan içeriklerde temel beklenti; daha temiz bir dil, daha kontrollü bir ton ve daha
                güçlü bir bağlam duygusudur. Bu nedenle sansasyon, hakaret, kışkırtıcı başlıklar veya doğrulanmamış
                iddialar platform yaklaşımının doğal parçası olarak görülmez.
            </p>

            <p>
                İçerik üretim süreci zaman zaman araştırma, taslak hazırlama ve düzenleme katmanlarından geçebilir.
                Ancak nihai hedef her zaman daha düzenli, daha güven veren ve daha uzun ömürlü bir içerik standardı
                oluşturmaktır.
            </p>

            <div class="platform-related">
                <a href="{{ route('platform.contact') }}">İletişim</a>
                <a href="{{ route('platform.privacy') }}">Gizlilik Politikası</a>
                <a href="{{ route('platform.index') }}">Platform</a>
            </div>
        </section>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Engelsiz Aslanlar — CADDE1905')

@section('content')
<div class="engelsiz-page">
    <div class="engelsiz-bg-tracks"></div>

    <div class="engelsiz-stack">

        <section class="engelsiz-hero">
            <div class="engelsiz-hero-media">
                <img
                    src="{{ asset('images/engelsiz-aslanlar/hero/hero-main.webp') }}"
                    alt="Engelsiz Aslanlar"
                >
            </div>

            <div class="engelsiz-hero-overlay"></div>

            <div class="engelsiz-hero-body">
                <div class="engelsiz-kicker">
                    <span class="engelsiz-kicker-dot"></span>
                    Özel Alan
                </div>

                <h1 class="engelsiz-hero-title">
                    <span class="engelsiz-hero-subtitle">Sınır Tanımayan Asalet:</span>
                    <span class="engelsiz-hero-main-title">Engelsiz Aslanlar</span>
                </h1>

                <p class="engelsiz-hero-desc">
                    <strong>"Mücadele, Galatasaray’ın genlerinde; zafer ise vazgeçmeyenlerin ruhundadır."</strong><br>
                    Engelsiz Aslanlar, sadece bir spor branşı değil; 2005 yılından bu yana süregelen, uluslararası arenada "Dünyanın En İyi Takımı" unvanını defalarca tescillemiş bir irade beyanıdır. Parkedeki her tekerlek izi, imkansıza karşı kazanılmış bir teknik nakavttır.
                </p>

                <div class="engelsiz-hero-meta">
                    <span class="engelsiz-hero-meta-item">Tekerlekli Sandalye Basketbol</span>
                    <span class="engelsiz-hero-meta-dot"></span>
                    <span class="engelsiz-hero-meta-item">GSK Teknoloji & Atletizm</span>
                </div>
            </div>
        </section>

        <section class="engelsiz-surface">
            <div class="engelsiz-head">
                <div class="engelsiz-head-kicker">Editoryal Giriş</div>
                <h2 class="engelsiz-head-title">Bir Branştan Fazlası: Küresel Bir Ekol</h2>
            </div>

            <p class="engelsiz-copy">
                Galatasaray Tekerlekli Sandalye Basketbol Takımı, kurulduğu günden bu yana kazandığı 
                <strong class="engelsiz-tech-highlight counter-anim" data-target="5">5</strong> <strong class="engelsiz-tech-highlight highlight-text">Şampiyon Kulüpler Kupası (Champions Cup)</strong> ve 
                <strong class="engelsiz-tech-highlight counter-anim" data-target="4">4</strong> <strong class="engelsiz-tech-highlight highlight-text">Kıtalararası Kupa (Intercontinental Cup)</strong> 
                ile bu branşta dünyanın en başarılı kulüplerinden biri konumundadır.
            </p>

            <p class="engelsiz-copy">
                Bu sayfa, sadece skorer isimlerin değil; yardımlaşmanın, doğru rotasyonun, savunma disiplininin ve sarı-kırmızı formaya duyulan aidiyetin teknik ve ruhani analizidir. Bizim için başarı; engel tanımayan bir sistemin kusursuz işlemesidir.
            </p>
        </section>

        <section class="engelsiz-surface">
            <div class="engelsiz-story">
                <div class="engelsiz-story-media">
                    <img
                        src="{{ asset('images/engelsiz-aslanlar/timeline/timeline-main.webp') }}"
                        alt="Engelsiz Aslanlar - Takım Dinamiği"
                        loading="lazy"
                    >
                </div>

                <div class="engelsiz-story-copy">
                    <div class="engelsiz-head">
                        <div class="engelsiz-head-kicker">Tarihçe</div>
                        <h2 class="engelsiz-head-title">Mücadele Yolculuğu: Zirveye Uzanan Kronoloji</h2>
                    </div>

                    <p class="engelsiz-copy">
                        2005 yılında temelleri atılan şubemiz, kısa sürede Türkiye ligini domine etmekle kalmamış, Avrupa tekerlekli sandalye basketbolunun standartlarını belirlemiştir.
                    </p>

                    <ul class="engelsiz-tech-list">
                        <li>
                            <div class="tech-list-title">Altın Çağ:</div>
                            <div class="tech-list-desc">2007-2014 yılları arasında kazanılan üst üste Avrupa ve Dünya şampiyonlukları, takımın teknik kapasitesini ve sürdürülebilir başarı vizyonunu kanıtlamıştır.</div>
                        </li>
                        <li>
                            <div class="tech-list-title">Teknik Devrim:</div>
                            <div class="tech-list-desc">Takımımız, yüksek tempolu hücum <code class="engelsiz-code">(full-court press)</code> ve hızlı hücum <code class="engelsiz-code">(fast break)</code> doktrinini bu branşta en iyi uygulayan ekiplerden biri olarak literatüre geçmiştir.</div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="engelsiz-surface">
            <div class="engelsiz-head">
                <div class="engelsiz-head-kicker">Kadro Analizi</div>
                <h2 class="engelsiz-head-title">Takımın Omurgası</h2>
            </div>

            <div class="engelsiz-people-grid">
                <article class="engelsiz-person-card">
                    <div class="engelsiz-person-media">
                        <img
                            src="{{ asset('images/engelsiz-aslanlar/people/enes-bulut.webp') }}"
                            alt="Engelsiz Aslanlar - Enes Bulut - Oyun Kurucu"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="engelsiz-person-fallback">EB</div>
                        <div class="engelsiz-person-overlay">
                            <span class="engelsiz-hover-tag">FAVORİ HAMLE: SAHA GÖRÜŞÜ & ASİST</span>
                        </div>
                    </div>

                    <div class="engelsiz-person-body">
                        <h3 class="engelsiz-person-name">Enes Bulut</h3>
                        <div class="engelsiz-person-role">Oyun Kurucu & Kaptan</div>
                        <div class="engelsiz-person-tech">
                            <span class="tech-label">Rol:</span> Saha içi general.<br>
                            <span class="tech-label">Teknik Kapasite:</span> Yüksek oyun zekası (IQ) ve asist yüzdesiyle takımın hücum organizasyonlarını yönetiyor. Savunmada ise rakip oyun kuruculara uyguladığı yoğun baskıyla biliniyor.
                        </div>
                    </div>
                </article>

                <article class="engelsiz-person-card">
                    <div class="engelsiz-person-media">
                        <img
                            src="{{ asset('images/engelsiz-aslanlar/people/lee-manning.webp') }}"
                            alt="Engelsiz Aslanlar - Lee Manning - Pivot"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="engelsiz-person-fallback">LM</div>
                        <div class="engelsiz-person-overlay">
                            <span class="engelsiz-hover-tag">KARİYER ZİRVESİ: POTA ALTI DOMİNASYON</span>
                        </div>
                    </div>

                    <div class="engelsiz-person-body">
                        <h3 class="engelsiz-person-name">Lee Manning</h3>
                        <div class="engelsiz-person-role">Pivot <span class="tech-badge">4.5 Puan</span></div>
                        <div class="engelsiz-person-tech">
                            <span class="tech-label">Rol:</span> Pota altı dominasyonu.<br>
                            <span class="tech-label">Teknik Kapasite:</span> 4.5 klasifikasyon puanıyla sahanın en uzun ve fiziksel oyuncularından biri. Rebound kontrolü ve boyalı alan bitiriciliği ile skor yükünü sırtlıyor.
                        </div>
                    </div>
                </article>

                <article class="engelsiz-person-card">
                    <div class="engelsiz-person-media">
                        <img
                            src="{{ asset('images/engelsiz-aslanlar/people/mete-sari.webp') }}"
                            alt="Engelsiz Aslanlar - Mete Sarı - Guard Forvet"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="engelsiz-person-fallback">MS</div>
                        <div class="engelsiz-person-overlay">
                            <span class="engelsiz-hover-tag">FAVORİ HAMLE: HIZLI GEÇİŞ HÜCUMU</span>
                        </div>
                    </div>

                    <div class="engelsiz-person-body">
                        <h3 class="engelsiz-person-name">Mete Sarı</h3>
                        <div class="engelsiz-person-role">Guard / Forvet</div>
                        <div class="engelsiz-person-tech">
                            <span class="tech-label">Rol:</span> Dinamik skorer.<br>
                            <span class="tech-label">Teknik Kapasite:</span> Perimetreden bulduğu dış şutlarla rakip savunmaların geometrisini bozan, geçiş hücumlarında (transition) hızıyla fark yaratan kilit oyuncu.
                        </div>
                    </div>
                </article>

                <article class="engelsiz-person-card">
                    <div class="engelsiz-person-media">
                        <img
                            src="{{ asset('images/engelsiz-aslanlar/people/sedat-incesu.webp') }}"
                            alt="Engelsiz Aslanlar - Sedat İncesu - Başantrenör"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="engelsiz-person-fallback">Sİ</div>
                        <div class="engelsiz-person-overlay">
                            <span class="engelsiz-hover-tag">VİZYON: TAKTİKSEL ESNEKLİK</span>
                        </div>
                    </div>

                    <div class="engelsiz-person-body">
                        <h3 class="engelsiz-person-name">Sedat İncesu</h3>
                        <div class="engelsiz-person-role">Başantrenör</div>
                        <div class="engelsiz-person-tech">
                            <span class="tech-label">Rol:</span> Strateji ve Vizyon.<br>
                            <span class="tech-label">Teknik Kapasite:</span> Engelsiz Aslanlar projesinin mimarı. Taktiksel esnekliği, oyuncu gelişimi ve kriz anlarındaki saha kenarı yönetimiyle dünya çapında tanınan taktikisyen.
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="engelsiz-surface">
            <div class="engelsiz-head">
                <div class="engelsiz-head-kicker">İçerikler</div>
                <h2 class="engelsiz-head-title">Seçilmiş İçerikler</h2>
            </div>

            <div class="engelsiz-content-grid">
                <article class="engelsiz-content-card">
                    <div class="engelsiz-content-media">
                        <img
                            src="{{ asset('images/engelsiz-aslanlar/content/avrupadaki-yukselis.webp') }}"
                            alt="Engelsiz Aslanlar - Avrupa’da Taktiksel Üstünlük"
                            loading="lazy"
                        >
                    </div>

                    <div class="engelsiz-content-body">
                        <h3 class="engelsiz-content-title">Avrupa’da Taktiksel Üstünlük</h3>
                        <p class="engelsiz-content-desc">
                            Uluslararası Tekerlekli Sandalye Basketbol Federasyonu (IWBF) standartlarında, toplam 14 puan sınırını en verimli şekilde kullanan rotasyon stratejilerimiz ve Avrupa finallerindeki alan savunması analizlerimiz.
                        </p>
                    </div>
                </article>

                <article class="engelsiz-content-card">
                    <div class="engelsiz-content-media">
                        <img
                            src="{{ asset('images/engelsiz-aslanlar/content/sahadan-hayata.webp') }}"
                            alt="Engelsiz Aslanlar - Sahadan Hayata: Rehabilitasyon ve Performans"
                            loading="lazy"
                        >
                    </div>

                    <div class="engelsiz-content-body">
                        <h3 class="engelsiz-content-title">Sahadan Hayata: <br>Rehabilitasyon ve Performans</h3>
                        <p class="engelsiz-content-desc">
                            Tekerlekli sandalye basketbolunun sadece bir rehabilitasyon aracı değil, yüksek performans gerektiren bir elit spor dalı olduğunun teknik kanıtları ve oyuncularımızın antrenman metotları.
                        </p>
                    </div>
                </article>

                <article class="engelsiz-content-card">
                    <div class="engelsiz-content-media">
                        <img
                            src="{{ asset('images/engelsiz-aslanlar/content/engelsiz-sporun-gelisimi.webp') }}"
                            alt="Engelsiz Aslanlar - Engelsiz Sporun Gelişimi ve Altyapı"
                            loading="lazy"
                        >
                    </div>

                    <div class="engelsiz-content-body">
                        <h3 class="engelsiz-content-title">Engelsiz Sporun Gelişimi ve Altyapı</h3>
                        <p class="engelsiz-content-desc">
                            Galatasaray altyapısından yetişen genç yeteneklerin A Takım sistemine entegrasyonu ve Türkiye’deki engelli spor branşlarına sağladığımız teknik danışmanlık vizyonu.
                        </p>
                    </div>
                </article>
            </div>
        </section>

        <div class="engelsiz-divider"></div>

        <section class="engelsiz-surface">
            <div class="engelsiz-head engelsiz-head-center">
                <div class="engelsiz-head-kicker">Kapanış</div>
                <h2 class="engelsiz-head-title">Bir Sayfadan Fazlası: Geleceğin Mirası</h2>
            </div>

            <p class="engelsiz-footer-note">
                Engelsiz Aslanlar’ın hikayesi, bir sezonluk değil, bir ömürlük adanmışlığın ürünüdür. Biz burada sadece basketbol oynamıyoruz; her maçta engelleri yıkan teknik bir devrim gerçekleştiriyoruz. Bu kültüre ortak olmanız, sadece bir takımı desteklemek değil, bir zihniyet değişimine imza atmaktır.
            </p>
        </section>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Counter Animasyonu
        const counters = document.querySelectorAll('.counter-anim');
        const speed = 200; 

        const animateCounters = () => {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;
                if(count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(animateCounters, 15);
                } else {
                    counter.innerText = target;
                }
            });
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    el.innerText = '0';
                    animateCounters();
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        
        counters.forEach(counter => {
            observer.observe(counter);
        });
    });
</script>
@endsection

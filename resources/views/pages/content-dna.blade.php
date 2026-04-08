@extends('layouts.app')

@section('title', 'İçerik Rehberi - Cadde1905 Editöryal Standartlar')


@section('content')
<div class="dna-page">

    {{-- Hero --}}
    <div class="dna-hero">
        <div class="dna-version">İçerik Rehberi · v1.0 · 2026</div>
        <h1>İçerik <span>DNA</span> Sistemi</h1>
        <p>Bu rehber, Cadde1905 platformunda yayınlanan tüm içeriklerin kalite, ton ve yapı standartlarını belirler. Her editör bu kılavuza uygun içerik üretmekle sorumludur.</p>
    </div>

    {{-- 1. Content Types --}}
    <div class="dna-section">
        <div class="dna-section-head">
            <div class="dna-section-num">1</div>
            <div>
                <h2>İçerik Tipleri & Yapı Standartları</h2>
                <p>Her içerik tipinin kendi dili, uzunluğu ve tonu vardır.</p>
            </div>
        </div>
        <div class="dna-section-body">
            <table class="type-table">
                <thead>
                    <tr>
                        <th>Tip</th>
                        <th>Hedef</th>
                        <th>Uzunluk</th>
                        <th>Ton</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="type-badge badge-red">Haber</span></td>
                        <td>Güncel olay aktarımı</td>
                        <td>300–600 kelime</td>
                        <td>Objektif, net, hızlı</td>
                    </tr>
                    <tr>
                        <td><span class="type-badge badge-blue">Analiz</span></td>
                        <td>Teknik/taktik derinlik</td>
                        <td>700–1400 kelime</td>
                        <td>Teknik, akıllı, yapılandırılmış</td>
                    </tr>
                    <tr>
                        <td><span class="type-badge badge-yellow">Miras</span></td>
                        <td>Tarihsel anlatım</td>
                        <td>600–1200 kelime</td>
                        <td>Hikaye anlatımı, sıcak, duygusal</td>
                    </tr>
                    <tr>
                        <td><span class="type-badge badge-red">Efsane Anı</span></td>
                        <td>Kişi odaklı öykü</td>
                        <td>500–900 kelime</td>
                        <td>Biyografik, ağır, prestijli</td>
                    </tr>
                    <tr>
                        <td><span class="type-badge badge-gray">Yorum</span></td>
                        <td>Görüş & perspektif</td>
                        <td>400–800 kelime</td>
                        <td>Taraftar ruhu, tutarlı, argümanlı</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- 2. Yazım Şablonu --}}
    <div class="dna-section">
        <div class="dna-section-head">
            <div class="dna-section-num">2</div>
            <div>
                <h2>Yazım İskeleti (Zorunlu Yapı)</h2>
                <p>Tüm içerikler bu yapıya uygun olarak yazılmalıdır.</p>
            </div>
        </div>
        <div class="dna-section-body">
<div class="dna-code"><span class="highlight">BAŞLIK</span>          → Güçlü, SEO uyumlu, spesifik (boş klişelerden kaçın)

<span class="highlight">GİRİŞ (HOOK)</span>    → İlk 2-3 cümle okuyucuyu yakalar. Soru, çarpıcı fact veya
                  güçlü bir sahneyle başla.

<span class="highlight">GELİŞME</span>         → Hikayeyi veya olayı kronolojik veya tematik olarak sun.
                  Bloklar halinde yaz, kısa tutaralar koy.

<span class="highlight">ALT BAŞLIKLAR</span>   → H2 kullan. Her 200-300 kelimede bir bölüm ayır.

<span class="highlight">SONUÇ</span>           → Okuyucuyu bir şey düşünmeye veya hissetmeye bırak.

<span class="muted">OPSİYONEL:</span>
├─ Alıntı (blockquote) → Önemli bir söz ya da aktarım
├─ İstatistik → sayı, skor, yüzde
└─ Referans → kaynak göster</div>
        </div>
    </div>

    {{-- 3. Ton & Dil --}}
    <div class="dna-section">
        <div class="dna-section-head">
            <div class="dna-section-num">3</div>
            <div>
                <h2>Ton & Dil Kararları</h2>
                <p>Cadde1905'in sesi: Yarı profesyonel + Taraftar ruhu.</p>
            </div>
        </div>
        <div class="dna-section-body">
            <div class="dna-alert alert-info">
                <span class="alert-icon">🎯</span>
                <div>Cadde1905 okuyucusu hem Galatasaray tutkusunu hem de kaliteli okuma deneyimini arar. Biz ikisini birleştiriyoruz: <strong>Duygu + Akıl.</strong></div>
            </div>
            <div class="tone-cards">
                <div class="tone-card">
                    <div class="tone-title">Haber Tonu</div>
                    <div class="tone-value">Objektif & Net</div>
                    <div class="tone-example">"Galatasaray, 3-1'lik galibiyetle liderliğini pekiştirdi."</div>
                </div>
                <div class="tone-card">
                    <div class="tone-title">Miras Tonu</div>
                    <div class="tone-value">Hikaye Anlatımı</div>
                    <div class="tone-example">"O gün Hasan Ali Yücel tribünleri sessizliğe büründü. Herkes nefesini tutmuştu."</div>
                </div>
                <div class="tone-card">
                    <div class="tone-title">Analiz Tonu</div>
                    <div class="tone-value">Teknik & Argümanlı</div>
                    <div class="tone-example">"Defans hattındaki pressing 4. dakikada kırıldı; işte o anın arkasındaki taktik."</div>
                </div>
            </div>
            <ul class="rule-list" style="margin-top:16px;">
                <li><span class="rule-icon">✅</span> Türkçeyi doğru ve zengin kullan. Slang veya internet dili yok.</li>
                <li><span class="rule-icon">✅</span> "Mükemmel", "harika", "muhteşem" gibi boş sıfatlardan kaçın, yerine somut detay ver.</li>
                <li><span class="rule-icon">✅</span> Aktif çatı (aktif fiil) kullan. Pasif cümlelerden kaçın.</li>
                <li><span class="rule-icon">✅</span> Taraftar hissini yitirme ama gerçekçi kal (hata varsa yaz).</li>
                <li><span class="rule-icon">❌</span> Siyasi içerik, nefret söylemi, hakaret kesinlikle yasak.</li>
            </ul>
        </div>
    </div>

    {{-- 4. Başlık Sistemi --}}
    <div class="dna-section">
        <div class="dna-section-head">
            <div class="dna-section-num">4</div>
            <div>
                <h2>Başlık Sistemi</h2>
                <p>Başlık okuyucunun ilk temas noktasıdır. Spesifik, bilgilendirici ve çekici olmalı.</p>
            </div>
        </div>
        <div class="dna-section-body">
            <div class="example-grid">
                <div class="example-block example-wrong">
                    <div class="example-label">✕ Yanlış</div>
                    <div class="example-text">
                        "Galatasaray kazandı"<br><br>
                        "Büyük zafer"<br><br>
                        "Hagi iyiydi"
                    </div>
                </div>
                <div class="example-block example-right">
                    <div class="example-label">✓ Doğru</div>
                    <div class="example-text">
                        "Galatasaray 3-1 Kazandı: Kırılma Anları ve Oyun Planı"<br><br>
                        "Şampiyonlar Ligi'ndeki O Gece: 2000 Yılının En Büyük Sahnesine Bakış"<br><br>
                        "Hagi'nin 10 Numarası: Saha Görüşü Nasıl Takımı Dönüştürdü"
                    </div>
                </div>
            </div>
            <div class="dna-alert alert-warn" style="margin-top:0;">
                <span class="alert-icon">⚡</span>
                <div>Başlık <strong>50–80 karakter</strong> arasında olmalı. Alt başlık (H2) kullanarak içeriği bölümlere ayır.</div>
            </div>
        </div>
    </div>

    {{-- 5. Hook Sistemi --}}
    <div class="dna-section">
        <div class="dna-section-head">
            <div class="dna-section-num">5</div>
            <div>
                <h2>Hook Sistemi (İlk Paragraf)</h2>
                <p>İlk 2-3 cümle okuyucuyu içeri çekmelidir. Devam etmesini sağla.</p>
            </div>
        </div>
        <div class="dna-section-body">
            <ul class="rule-list">
                <li><span class="rule-icon">🎯</span> <strong>Sahne ile başla:</strong> "1999 yılının mayıs gecesi, Galatasaray dünyanın en büyük sahnesine çıktı..."</li>
                <li><span class="rule-icon">🔢</span> <strong>Şaşırtıcı bir sayı ile:</strong> "4.200 gol. İşte Galatasaray'ın Süper Lig'deki toplam gol sayısı..."</li>
                <li><span class="rule-icon">❓</span> <strong>Soru ile:</strong> "Bir takımın hangi andaki kararı on yıl sonra da konuşuluyor olabilir?"</li>
                <li><span class="rule-icon">💬</span> <strong>Alıntı ile:</strong> "Şampiyon olmak için her şeyi verdik" demişti. 25 yıl sonra o söz hâlâ geçerli.</li>
            </ul>
        </div>
    </div>

    {{-- 6. SEO --}}
    <div class="dna-section">
        <div class="dna-section-head">
            <div class="dna-section-num">6</div>
            <div>
                <h2>SEO & Erişilebilirlik</h2>
                <p>Her içerik arama motorlarında görünür ve erişilebilir olmalı.</p>
            </div>
        </div>
        <div class="dna-section-body">
            <div class="seo-grid">
                <div class="seo-item">
                    <div class="seo-label">Başlık (H1)</div>
                    <div class="seo-rule">Her sayfada tek H1. Ana keyword içermeli. 50-65 karakter ideal.</div>
                </div>
                <div class="seo-item">
                    <div class="seo-label">Alt Başlıklar (H2)</div>
                    <div class="seo-rule">Her büyük paragraf grubu için H2. İkincil keyword'ları dahil et.</div>
                </div>
                <div class="seo-item">
                    <div class="seo-label">Meta Açıklama</div>
                    <div class="seo-rule">120-160 karakter. Sürükleyici, keyword içeren özet.</div>
                </div>
                <div class="seo-item">
                    <div class="seo-label">Görsel Alt Metin</div>
                    <div class="seo-rule">Tüm fotoğraflara açıklayıcı alt metin ekle. "Galatasaray UEFA Kupası maçı 2000"</div>
                </div>
                <div class="seo-item">
                    <div class="seo-label">İç Bağlantılar</div>
                    <div class="seo-rule">İlgili Miras veya Haber sayfalarına bağlantı ver.</div>
                </div>
                <div class="seo-item">
                    <div class="seo-label">Anahtar Kelimeler</div>
                    <div class="seo-rule">Doğal yerleşim. Yapay tekrar yok. Yoğunluk %1-2.</div>
                </div>
            </div>
        </div>
    </div>

    {{-- 7. Editöryal Kontrol --}}
    <div class="dna-section">
        <div class="dna-section-head">
            <div class="dna-section-num">7</div>
            <div>
                <h2>Editöryal Kalite Kuralları</h2>
                <p>Yayınlanabilir içerik için geçmesi gereken kontrol listesi.</p>
            </div>
        </div>
        <div class="dna-section-body">
            <ul class="rule-list">
                <li><span class="rule-icon">✅</span> Başlık spesifik ve bilgilendirici mi?</li>
                <li><span class="rule-icon">✅</span> İlk paragraf okuyucuyu çekiyor mu?</li>
                <li><span class="rule-icon">✅</span> İçerik tip standardına (uzunluk, ton) uygun mu?</li>
                <li><span class="rule-icon">✅</span> Yazım ve noktalama hataları kontrol edildi mi?</li>
                <li><span class="rule-icon">✅</span> Görseller var mı ve alt metin ekli mi?</li>
                <li><span class="rule-icon">✅</span> Kaynak veya referans gerekiyorsa belirtildi mi?</li>
                <li><span class="rule-icon">❌</span> Spam, tekrar içerik veya düşük kaliteli metin? → REDDEDİLİR</li>
                <li><span class="rule-icon">❌</span> Kaynak göstermeden kopyalama? → REDDEDİLİR</li>
                <li><span class="rule-icon">❌</span> Siyasi içerik, hakaret, nefret söylemi? → REDDEDİLİR</li>
            </ul>
        </div>
    </div>

</div>
@endsection

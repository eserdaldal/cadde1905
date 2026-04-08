--------------------------------
# ⚠️ LEGACY AGENT FILE (FROZEN)

This file is part of the pre-SSOT agent system.

CURRENT STATE:
- NOT authoritative
- NOT a source of truth
- MUST NOT define routes, DB, theme, or system behavior

SOURCE OF TRUTH:
C:\laragon\www\Docs\PROJECT_LOG\SSOT_INDEX.md

INSTRUCTION:
- Do NOT rely on this file for system decisions
- Use SSOT modules instead

STATUS:
FROZEN / LEGACY

--------------------------------
# CADDE1905 — Çalışma Protokolü

**Aktivasyon:** Always On — Her prompt'ta aktif

---

## Yeni Oturumda Zorunlu Okuma Sırası

Her yeni Antigravity oturumu başladığında veya yeni görev alındığında şu sırayla oku:

1. `Docs\PROJECT_LOG\KODLAMA_GOREVLERI.md` → Aktif görevi belirle
2. `Docs\PROJECT_LOG\DECISIONS.md` → Alınan kararları öğren
3. `Docs\REFERENCE\09_Kultur_Jargon_Referansi.md` → Tablo/model adları, enum — **her zaman oku**
4. Görevin alanına göre aşağıdaki REFERENCE haritasından ilgili dosyaları oku

İlk kez başlarken ek olarak oku:
- `Docs\CADDE1905_Proje_Tanitim.html`
- `Docs\cadde1905-anasayfa.html`

---

## REFERENCE Dosya Haritası

`Docs\REFERENCE\` klasöründe 14 strateji dokümanı bulunur.
**Hangi görevde hangi dosyayı okuyacağını bu harita belirler.**

| Dosya | İçerik | Ne Zaman Oku |
|-------|--------|--------------|
| `00_Proje_Ozeti.md` | Projenin genel özeti, hedefler, vizyon | İlk başlangıçta — genel bağlam için |
| `01_Master_Strateji.md` | İş modeli, gelir stratejisi, büyüme planı | Büyük mimari karar öncesi |
| `02_Hosting_ve_Altyapi.md` | Hostinger kurulumu, PHP/MySQL versiyonları, deployment | Sunucu, env, deployment işlemlerinde |
| `03_Uygulama_Fazlari.md` | Faz 1–3 planı, hangi özellik hangi fazda | Görev sırası belirlenirken, yeni özellik eklenirken |
| `04_Sayfa_Yerlesim_Plani.md` | Sayfa wireframe'leri, URL yapısı, bileşen listesi | Yeni sayfa veya route oluştururken |
| `05_Kurumsal_Kimlik_Tasarim.md` | Renk paleti, tipografi, logo kuralları | Herhangi bir UI/CSS işleminde |
| `06_Gorsel_Varlik_Kurallari.md` | Görsel boyutları, watermark, logo konumları | Görsel yükleme, cover image, watermark işleminde |
| `07_Lokal_Canli_Gecis_Plani.md` | Lokelden production'a geçiş adımları | Deploy, canlıya alma işlemlerinde |
| `08_Icerik_Konsept_Rehberi.md` | İçerik türleri, yazım tonu, kategori yapısı | İçerik modeli, kategori, haber yapısı kurulurken |
| `09_Kultur_Jargon_Referansi.md` | Tablo adları, model adları, enum değerleri, GS jargonu | **Her görevde — zorunlu** |
| `10_Is_Akisi_Protokolu.md` | Geliştirme iş akışı, araç rolleri, onay süreçleri | Süreç sorusu olduğunda |
| `11_Gelecek_Ozellikler.md` | Faz 2–3 özellikleri, roadmap | Gelecek özellik planlanırken, kapsam dışı sorularda |
| `12_Felsefi_Detaylar.md` | Projenin ruhu, taraftar kimliği, içerik felsefesi | İçerik tonu, kullanıcı deneyimi kararlarında |
| `13_Rol_ve_Is_Bolumu.md` | Kim ne yapar, hangi araç hangi görevi üstlenir | Sorumluluk belirsizliğinde |

### Göreve Göre Hızlı Referans

| Görev Türü | Okunacak REFERENCE Dosyaları |
|------------|------------------------------|
| Migration / Model / DB | `09`, `03`, `08` |
| Controller / Route / API | `09`, `04`, `03` |
| Blade / Frontend / UI | `04`, `05`, `06`, `09` |
| FilamentPHP / Admin | `09`, `03`, `13` |
| Görsel / Watermark | `06`, `05` |
| Deploy / Hosting | `02`, `07` |
| Yeni özellik planı | `03`, `11`, `01` |
| İçerik / Kategori yapısı | `08`, `12`, `09` |

---

## Görev Başlamadan Önce

1. KODLAMA_GOREVLERI.md'de aktif görevi tespit et
2. Yukarıdaki haritadan ilgili REFERENCE dosyalarını oku
3. Ne yapacağını Eser'e kısaca açıkla
4. Büyük mimari değişikliklerde onay iste, onay gelmeden başlama
5. Göreve başla

---

## Her Görev Sonrası

1. Rapor yaz → `Docs\PROJECT_LOG\report\YYYYMMDD-HHMM-[konu].md`
2. KODLAMA_GOREVLERI.md'de görev durumunu güncelle
3. Önemli bir karar aldıysan DECISIONS.md'ye ekle (Eser onayından sonra)

---

## Genel Kurallar

### Yapılacaklar
- Kodu yazmadan önce ne yapacağını açıkla
- Adım adım ilerle, her adımı doğrula
- Hata çıkarsa error-handler skill'ini devreye al
- Yorumları Türkçe yaz, kodu İngilizce bırak
- `php artisan test` ile test suite çalıştır

### Kesinlikle Yapılmayacaklar
- `.env` dosyasını Git'e ekleme
- Canlı sunucuda (Hostinger) doğrudan değişiklik yapma
- Eser'in onayı olmadan büyük mimari değişiklik yapma
- Eski dosya/klasör adlarını kullanma (proje kökü: `cadde1905`, log klasörü: `PROJECT_LOG`)
- Admin panel route'unu `/admin` olarak tanımlama — `/yonetim` kullan

---

## İletişim Kuralları

- Net, doğrudan cevap ver — gereksiz açıklama yapma
- Türkçe iletişim kur
- Varsayım yapma — belirsiz durumda sor
- Hata çıktığında: önce analiz et, sonra çöz


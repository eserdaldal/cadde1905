# CADDE1905 — Dosya Haritası

> Bu dosya projedeki tüm dosyaların envanteri ve kullanım kurallarıdır.
> ChatGPT hangi dosyanın ne içerdiğini buradan bilir.
> Gerektiğinde Eser'den gerekçeli olarak talep eder.

---

## Aktif Çalışma Dosyaları

Her zaman güncel olan dosyalar. Karar ve görev değişikliklerinde güncellenir.

| Dosya | Konum | Boyut | İçerik | Güncelleyen |
|-------|-------|-------|--------|-------------|
| `PROJE_DURUMU.md` | `Docs/PROJECT_LOG/` | ~2 KB | Projenin anlık durumu, görev tablosu, son kararlar | ChatGPT + Antigravity |
| `DECISIONS.md` | `Docs/PROJECT_LOG/` | ~8 KB | 22 kesinleşmiş karar, tam gerekçeleriyle | ChatGPT (Eser onayı ile) |
| `KODLAMA_GOREVLERI.md` | `Docs/PROJECT_LOG/` | ~8 KB | Faz 1-3 görev listesi, bağımlılıklar, beklenen çıktılar | Antigravity + ChatGPT |
| `SESSION_START.md` | `Docs/PROJECT_LOG/` | ~7 KB | Antigravity onboarding dosyası — teknik yığın, tasarım sistemi, roller | AI Asistan (Claude) |

**Kural:** `PROJE_DURUMU.md` her zaman sende hazır olsun.
`DECISIONS.md` ve `KODLAMA_GOREVLERI.md` gerektiğinde talep et.

---

## ChatGPT Başlangıç Paketi

Yeni bir ChatGPT sohbeti açtığında yüklenecek dosyalar (3 dosya, ~20 KB):

```
1. PROJE_DURUMU.md         → Neredeyiz
2. DOSYA_HARITASI.md       → Hangi dosya ne
3. CHATGPT_KURALLARI.md    → Nasıl çalışıyoruz
```

Bu üç dosya yeterli. ChatGPT projeyi tanır ve çalışmaya başlar.

---

## Strateji Dokümanları (REFERENCE)

`Docs/REFERENCE/` klasöründe. Nadiren değişir. Gerektiğinde talep et.

| Dosya | Boyut | İçerik | Ne Zaman İste |
|-------|-------|--------|---------------|
| `00_Proje_Ozeti.md` | 1.6 KB | Proje özeti, vizyon | **İsteme** — PROJE_DURUMU.md + CADDE1905_Proje_Tanitim.html zaten kapsar |
| `01_Master_Strateji.md` | 5 KB | İş modeli, strateji | **İsteme** — nadiren lazım, içeriği zaten biliyorsun |
| `02_Hosting_ve_Altyapi.md` | 12 KB | Hostinger, PHP, MySQL, deployment | Sunucu/hosting/deploy konuşulunca → "02 dosyasını gönderir misin?" |
| `03_Uygulama_Fazlari.md` | 15 KB | Faz 1-3 detayları, görev listeleri | Faz planı veya kapsam konuşulunca → "03 dosyasını gönderir misin?" |
| `04_Sayfa_Yerlesim_Plani.md` | 39 KB | Wireframe, URL yapısı, bileşen listesi | Sayfa/route/UI tasarımı konuşulunca → "04 dosyasını gönderir misin?" |
| `05_Kurumsal_Kimlik_Tasarim.md` | 24 KB | Renk paleti, tipografi, logo | Tasarım/CSS/marka konuşulunca → "05 dosyasını gönderir misin?" |
| `06_Gorsel_Varlik_Kurallari.md` | 23 KB | Görsel boyutları, watermark | Görsel yükleme/watermark konuşulunca → "06 dosyasını gönderir misin?" |
| `07_Lokal_Canli_Gecis_Plani.md` | 25 KB | Lokal→production geçiş | Deploy adımları konuşulunca → "07 dosyasını gönderir misin?" |
| `08_Icerik_Konsept_Rehberi.md` | 15 KB | İçerik türleri, yazım tonu | İçerik modeli/kategori konuşulunca → "08 dosyasını gönderir misin?" |
| `09_Kultur_Jargon_Referansi.md` | 10 KB | Tablo adları, model adları, enum | Teknik isimlendirme konuşulunca → "09 dosyasını gönderir misin?" |
| `10_Is_Akisi_Protokolu.md` | 7.5 KB | İş akışı, araç rolleri | Süreç/rol belirsizliğinde → "10 dosyasını gönderir misin?" |
| `11_Gelecek_Ozellikler.md` | 6.5 KB | Faz 2-3 roadmap | Gelecek özellik planlamasında → "11 dosyasını gönderir misin?" |
| `12_Felsefi_Detaylar.md` | 7 KB | Proje ruhu, UX felsefesi | İçerik tonu/kullanıcı deneyimi konuşulunca → "12 dosyasını gönderir misin?" |
| `13_Rol_ve_Is_Bolumu.md` | 7 KB | Kim ne yapar | Sorumluluk belirsizliğinde → "13 dosyasını gönderir misin?" |

---

## Tasarım Referans Dosyaları

| Dosya | Boyut | İçerik | Ne Zaman İste |
|-------|-------|--------|---------------|
| `CADDE1905_Proje_Tanitim.html` | 49 KB | Proje tanıtımı, kapsamlı özet | Projeye genel bakış gerektiğinde (nadiren) |
| `cadde1905-anasayfa.html` | 58 KB | Anasayfa tasarım referansı | **İsteme** — bu dosya Antigravity içindir, ChatGPT için gereksiz |

---

## Antigravity Sistem Dosyaları

ChatGPT bu dosyaları talep etmez. Bunlar Antigravity'nin çalışma dosyalarıdır.

| Dosya/Klasör | Açıklama |
|---|---|
| `.agent/rules/` | Antigravity her zaman yükler — kurallar |
| `.agent/skills/` | Antigravity ihtiyaçta yükler — protokoller |
| `.agent/workflows/` | `/komut` ile tetiklenir |
| `AGENTS.md` | Antigravity giriş noktası |

---

## Rapor Arşivi

`Docs/PROJECT_LOG/report/` klasöründe.
Format: `YYYYMMDD-HHMM-[konu].md`
Antigravity her görev sonrası yazar. ChatGPT PROJE_DURUMU.md bölüm 9'dan takip eder.
Detay gerekirse: "20260219-1430-laravel-setup.md dosyasını gönderir misin?"

---

## Dosya Talep Kuralları

ChatGPT bir dosya talep ederken şu formatı kullanır:

> "[Konu] hakkında konuşmak/karar almak için **[dosya adı]** dosyasına ihtiyacım var.
> Bu dosyayı gönderir misin?"

**Talep etmeden önce kontrol:** O bilgi zaten `PROJE_DURUMU.md` veya `DECISIONS.md` içinde var mı?
Varsa talep etme, oradan kullan.

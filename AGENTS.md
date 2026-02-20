# CADDE1905 — AGENTS.md

Bu dosya Antigravity ve diğer AI kodlama araçlarının proje kökünde
otomatik tanıdığı evrensel giriş noktasıdır.

---

## Bu Proje Nedir

CADDE1905, Galatasaray taraftarları için geliştirilmekte olan bir medya ve
topluluk platformudur. Laravel 12, PHP 8.3+, Tailwind CSS v4, FilamentPHP v3.

**Workspace:** `C:\cadde1905\cadde1905\` ← Laravel projesi burası

---

## Antigravity Kural ve Skill Sistemi

Tüm kurallar ve skill'ler `.agent/` klasöründe tanımlıdır.

### Rules (Daima Aktif)
`.agent/rules/` klasöründe, her prompt'ta otomatik yüklenir:

| Dosya                  | İçerik                              |
|------------------------|-------------------------------------|
| `01-proje.md`          | Proje kimliği, teknik yığın, klasörler |
| `02-calisma-protokolu.md` | Görev akışı, genel kurallar      |
| `03-backend.md`        | Laravel kuralları (naming, model, route) |
| `04-frontend.md`       | Blade/Tailwind/Alpine kuralları     |
| `05-veritabani.md`     | MySQL/Migration kuralları           |
| `06-raporlama.md`      | Rapor formatı ve konumu             |

### Skills (İhtiyaç Anında Yüklenir)
`.agent/skills/` klasöründe, semantic eşleşme ile tetiklenir:

| Skill              | Tetikleyici                               |
|--------------------|-------------------------------------------|
| `backend-laravel`  | migration, model, controller, filament    |
| `frontend-blade`   | blade, tailwind, alpine, dark mode, layout |
| `database-mysql`   | tablo, schema, index, ilişki, sorgu       |
| `error-handler`    | hata, exception, 500, çalışmıyor          |
| `report-writer`    | rapor yaz, tamamlandı, özet               |

### Workflows (Manuel Tetiklenir)
`.agent/workflows/` klasöründe, `/komut` ile çalıştırılır:

| Komut             | Açıklama                          |
|-------------------|-----------------------------------|
| `/yeni-gorev`     | Yeni göreve başlamadan önce çalıştır |
| `/gorev-tamamla`  | Görev bittikten sonra çalıştır    |
| `/hata-coz`       | Hata ile karşılaşıldığında çalıştır |

---

## İlk Kez Başlarken (Onboarding)

Sırayla oku:
1. `.agent/rules/` → tüm rule dosyaları (otomatik yüklenir)
2. `Docs/PROJECT_LOG/KODLAMA_GOREVLERI.md` → aktif görev
3. `Docs/PROJECT_LOG/DECISIONS.md` → alınan kararlar
4. `Docs/REFERENCE/09_Kultur_Jargon_Referansi.md` → tablo/model adları
5. `Docs/CADDE1905_Proje_Tanitim.html` → proje tanıtımı
6. `Docs/cadde1905-anasayfa.html` → tasarım referansı

---

## REFERENCE Dosya Haritası (Özet)

`Docs\REFERENCE\` klasöründeki 14 doküman Antigravity'nin proje bağlamını anlamasını sağlar.
Detaylı harita: `.agent/rules/02-calisma-protokolu.md`

| # | Dosya | Kısa Açıklama |
|---|-------|---------------|
| 00 | `Proje_Ozeti.md` | Genel özet, vizyon |
| 01 | `Master_Strateji.md` | İş modeli, strateji |
| 02 | `Hosting_ve_Altyapi.md` | Sunucu, PHP, MySQL |
| 03 | `Uygulama_Fazlari.md` | Faz planı — **görev sırası için oku** |
| 04 | `Sayfa_Yerlesim_Plani.md` | Wireframe, URL yapısı |
| 05 | `Kurumsal_Kimlik_Tasarim.md` | Renk, tipografi |
| 06 | `Gorsel_Varlik_Kurallari.md` | Görsel standartlar |
| 07 | `Lokal_Canli_Gecis_Plani.md` | Deploy adımları |
| 08 | `Icerik_Konsept_Rehberi.md` | İçerik modeli |
| 09 | `Kultur_Jargon_Referansi.md` | Tablo/model adları — **her görevde oku** |
| 10 | `Is_Akisi_Protokolu.md` | İş akışı |
| 11 | `Gelecek_Ozellikler.md` | Roadmap |
| 12 | `Felsefi_Detaylar.md` | UX felsefesi |
| 13 | `Rol_ve_Is_Bolumu.md` | Sorumluluklar |

---

## Raporlama

Her işlem sonrası rapor → `Docs\PROJECT_LOG\report\YYYYMMDD-HHMM-[konu].md`

---

## Kilit Kurallar (Özet)

- Admin panel route'u: `/yonetim` (asla `/admin` değil)
- `.env` Git'e eklenme
- Canlı sunucuda doğrudan değişiklik yapma
- Büyük değişiklikte Eser onayı al
- Her görev sonrası rapor yaz

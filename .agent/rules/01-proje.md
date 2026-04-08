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
# CADDE1905 — Proje Kimliği ve Bağlam

**Aktivasyon:** Always On — Her prompt'ta aktif

---

## Proje Nedir

CADDE1905, Galatasaray taraftarları için geliştirilmekte olan bir medya ve topluluk platformudur.
Laravel 12 tabanlı, dark-mode öncelikli, Türkçe içerikli bir web uygulamasıdır.

## Senin Rolün

Sen bu projenin yapay zeka kod uzmanısın. Deneyimli bir full-stack geliştirici gibi düşün,
Laravel ekosisteminde uzmanlaşmış biri gibi davran. Kodu üretmeden önce analiz et, plan yap,
sonra uygula. Varsayım yapma — emin olmadığın şeyleri sor.

## Teknik Yığın

| Katman       | Teknoloji                                      |
|--------------|------------------------------------------------|
| Backend      | Laravel 12, PHP 8.3+                           |
| Admin Panel  | FilamentPHP v3 — route: `/yonetim`             |
| Frontend     | Blade, BladewindUI, Alpine.js                  |
| CSS          | Tailwind CSS v4 (`@theme` bloğu ile)           |
| Veritabanı   | MySQL 8.0+                                     |
| Görseller    | Intervention Image                             |
| Queue/Cache  | Database driver (Faz 1 — Redis yok)            |
| Hosting      | Hostinger Premium                              |

## Klasör Yapısı

```
C:\cadde1905\
├── cadde1905\              ← Laravel projesi — tüm kod burası
│   ├── app\
│   ├── resources\views\
│   ├── database\migrations\
│   ├── public\images\
│   └── .agent\             ← Bu klasörün konumu
└── Docs\
    ├── REFERENCE\          ← 00–13 strateji dokümanları
    └── PROJECT_LOG\
        ├── SESSION_START.md
        ├── DECISIONS.md
        ├── KODLAMA_GOREVLERI.md
        └── report\         ← Antigravity raporları
```

## Lokal Geliştirme

- URL: `http://cadde1905.test`
- Herd veya Laragon
- Veritabanı: lokal MySQL, db adı: `cadde1905`

## Dosya Sorumlulukları

| Dosya                    | Kim Yazar    | Kim Okur              | Amaç                        |
|--------------------------|--------------|-----------------------|-----------------------------|
| `SESSION_START.md`       | AI Asistan   | AI Asistan            | Proje bağlamı, oturum sürekliliği |
| `DECISIONS.md`           | AI Asistan   | Antigravity (okur)    | Stratejik kararlar           |
| `KODLAMA_GOREVLERI.md`   | AI Asistan   | Antigravity (okur + günceller) | Kodlama görev listesi |
| `report/*.md`            | Antigravity  | Eser, AI Asistan      | İşlem kayıtları              |

**Not:** `SESSION_START.md` AI Asistan'ın dosyasıdır.
Antigravity bu dosyayı yalnızca proje bağlamını anlamak için okur, güncellemez.


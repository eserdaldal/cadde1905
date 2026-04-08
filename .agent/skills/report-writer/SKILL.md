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
---
name: report-writer
description: Tamamlanan görev, çözülen hata veya yapılan değişiklik sonrası rapor dosyası oluştur. "Rapor yaz", "kaydet", "özet çıkar" denildiğinde veya bir görev tamamlandığında otomatik devreye gir.
---

# Report Writer Skill

## Amaç
Her işlem sonrası izlenebilirlik sağlamak için standart formatta rapor oluşturup doğru klasöre kaydetmek.

## Rapor Konumu

```
C:\cadde1905\Docs\PROJECT_LOG\report\
```

## Dosya Adı Formatı

```
YYYYMMDD-HHMM-[konu-ingilizce-kebab-case].md
```

Örnekler:
```
20260219-1430-laravel-setup.md
20260219-1545-users-migration.md
20260219-1600-error-filament-route.md
20260219-1715-news-model-relations.md
20260219-1820-homepage-blade.md
```

## Rapor Şablonu

```markdown
# [Görev / İşlem Adı] — Rapor

**Tarih:** YYYY-MM-DD HH:MM
**Görev ID:** [KODLAMA_GOREVLERI.md'deki ID — örn: Görev 1.2]
**Durum:** ✅ Tamamlandı | ❌ Hatalı | ⚠️ Kısmi

---

## Yapılan İşlemler

1. [İşlem 1]
2. [İşlem 2]
3. [İşlem 3]

## Çalıştırılan Komutlar

```bash
php artisan make:migration create_news_table
php artisan migrate
php artisan test
```

## Değiştirilen / Oluşturulan Dosyalar

| Dosya | İşlem |
|-------|-------|
| `database/migrations/2026_02_19_create_news_table.php` | Oluşturuldu |
| `app/Models/News.php` | Güncellendi |
| `app/Http/Controllers/NewsController.php` | Oluşturuldu |

## Sonuç

[Ne başarıldı, ne değişti, neden önemli]

## Sorunlar (varsa)

[Karşılaşılan sorun ve nasıl çözüldü]

## Sonraki Adım

[Bir sonraki görev ID'si veya dikkat edilecek nokta]
```

## Görev Tamamlandığında Ek Adım

Raporu yazdıktan sonra `KODLAMA_GOREVLERI.md` güncelle:

```markdown
**DURUM:** ✅ Tamamlandı — 2026-02-19
```

## Kurallar

- Her işlem sonrası yaz — "küçük değişiklik" diye atlama
- Dosya adında Türkçe karakter kullanma
- Tarih ve saati atla — dosya adında ve içeride her ikisi de zorunlu
- Komutları gerçek şekliyle yaz — kısaltma

## Bu Skill'de Okunacak REFERENCE Dosyaları

| Dosya | Ne İçin |
|-------|---------|
| `Docs\REFERENCE\10_Is_Akisi_Protokolu.md` | Raporlama protokolü, iş akışı standartları |
| `Docs\REFERENCE\13_Rol_ve_Is_Bolumu.md` | Kimin hangi belgeyi güncellediği |


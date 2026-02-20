# CADDE1905 — Raporlama Kuralları

**Aktivasyon:** Always On

---

## Rapor Konumu

```
C:\cadde1905\Docs\PROJECT_LOG\report\
```

## Dosya Adı Formatı

```
YYYYMMDD-HHMM-[kisa-konu-ingilizce].md

Örnekler:
  20260219-1430-laravel-setup.md
  20260219-1545-users-migration.md
  20260219-1600-error-filament-route.md
  20260219-1715-news-model.md
```

## Rapor Şablonu

```markdown
# [Görev Adı] — Rapor

**Tarih:** YYYY-MM-DD HH:MM
**Görev ID:** [KODLAMA_GOREVLERI.md'deki ID]
**Durum:** ✅ Tamamlandı | ❌ Hatalı | ⚠️ Kısmi

## Yapılan İşlemler
1. ...

## Çalıştırılan Komutlar
```bash
php artisan ...
```

## Değiştirilen Dosyalar
| Dosya | İşlem |
|-------|-------|
| `database/migrations/...` | Oluşturuldu |

## Sonuç
[Ne başarıldı]

## Sorunlar (varsa)
[Sorun ve çözüm]

## Sonraki Adım
[Bir sonraki görev]
```

## Kurallar

- Her görev tamamlandığında yaz — küçük değişiklik diye atlama
- Görev tamamlandığında KODLAMA_GOREVLERI.md güncelle: `✅ Tamamlandı — YYYY-MM-DD`
- Dosya adında Türkçe karakter kullanma

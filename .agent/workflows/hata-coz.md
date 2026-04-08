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
# Hata Çözüm Workflow'u

**Tetikleyici:** `/hata-coz`
**Kullanım:** Bir hata veya exception ile karşılaşıldığında çalıştır.

---

## Adımlar

1. `tail -n 50 storage/logs/laravel.log` ile hatayı oku
2. Hata türünü tespit et (syntax / config / DB / route / permission)
3. `php artisan optimize:clear` dene — cache sorunu mu?
4. Hatayı tinker veya geçici debug route ile izole et
5. Test ortamında çözümü uygula, doğrula
6. Debug kodlarını temizle (`dd()`, `dump()`, test route)
7. Düzeltmeyi gerçek ortama uygula
8. `php artisan test` çalıştır
9. Hata raporu yaz → `Docs\PROJECT_LOG\report\YYYYMMDD-HHMM-error-[konu].md`


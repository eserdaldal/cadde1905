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
# Görev Tamamlama Workflow'u

**Tetikleyici:** `/gorev-tamamla`
**Kullanım:** Bir kodlama görevi bittikten sonra çalıştır.

---

## Adımlar

1. `php artisan test` çalıştır — testler geçiyor mu?
2. Test geçmiyorsa DUR — error-handler skill'ini devreye al, sorunu çöz
3. Testler geçtiyse devam et
4. Değiştirilen dosyaları listele
5. Raporu yaz → `Docs\PROJECT_LOG\report\YYYYMMDD-HHMM-[konu].md`
6. `Docs\PROJECT_LOG\KODLAMA_GOREVLERI.md` güncelle → görevi ✅ Tamamlandı yap
7. Eser'e kısa özet sun: ne yapıldı, sonraki görev hangisi


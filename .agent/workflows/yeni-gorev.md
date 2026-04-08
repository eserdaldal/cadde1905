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
# Yeni Görev Başlatma Workflow'u

**Tetikleyici:** `/yeni-gorev`
**Kullanım:** Yeni bir kodlama görevi başlamadan önce çalıştır.

---

## Adımlar

1. `Docs\PROJECT_LOG\KODLAMA_GOREVLERI.md` dosyasını oku
2. Durumu "Bekliyor" olan ilk görevi tespit et
3. Görevin bağımlılıklarını kontrol et — bağımlı görevler tamamlandı mı?
4. `Docs\PROJECT_LOG\DECISIONS.md` dosyasını oku — ilgili kararlar var mı?
5. `02-calisma-protokolu.md` içindeki haritadan göreve uygun REFERENCE dosyalarını oku
6. Görevi Eser'e özetle: ne yapacaksın, kaç adım, tahmini süre
7. Eser onay verirse başla
8. Onay gelmezse bekle, değişiklik varsa not al


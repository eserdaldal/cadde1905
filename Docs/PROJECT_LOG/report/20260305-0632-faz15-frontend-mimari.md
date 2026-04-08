# FAZ 1.5 — Frontend Mimari Analiz ve Düzeni Raporu

**Tarih:** 2026-03-05 06:32
**Görev:** FAZ 1.5 Frontend Mimari (layout/partials/components düzeni)
**Durum:** ✅ Tamamlandı

---

## Yapılanlar

### Phase A — Repository Scan
35 dosya/dizin analiz edildi. Mevcut yapı ve kullanım akışları belirlendi.

**Tespit edilen anomaliler:**
| Anomali | Detay | Karar |
|---------|-------|-------|
| Çift layout sistemi | `layouts/app.blade.php` (aktif) + `components/layouts/app.blade.php` (kullanılmıyor) | Component layout'a dokunulmadı |
| Ölü dosyalar | `home.blade.php` (kök), `welcome.blade.php` | Silme yasak — bırakıldı |
| Typo dosya | `join-community.blad.php` (`.blad.php`) | Blade tanımıyor — cleanup'a bırakıldı |
| Backup dosyalar | `.bak-20260305-0355` (2 adet) | Önceki hotfix'ten — bırakıldı |

### Phase B — Safe Target Structure
- Mevcut yapı zaten doğru prensiplere uygun (pages → layout → components/widgets)
- Yeni klasör oluşturulmasına gerek yok
- **`@theme` token migrasyonu** → Ayrı görev olarak planlandı (mutabık kalındı)

### Phase C — Controlled Implementation
Tek değişiklik uygulandı:

| Dosya | Değişiklik |
|-------|-----------|
| `layouts/app.blade.php` | `<html lang="tr">` → `<html lang="tr" data-theme="dark">` |

**Neden:** `04-frontend.md` kuralı gereği `data-theme="dark"` HTML attribute'u zorunlu. FOUC script'i JS ile set ediyor ama HTML'de default yoksa ilk render'da CSS `[data-theme="dark"]` kuralları uygulanmıyor → potansiyel beyaz flash.

## Doğrulama Sonuçları

| Test | Sonuç |
|------|-------|
| `docker compose logs node \| grep error` | ✅ Hata yok |
| Homepage header/footer/logo | ✅ Görünüyor |
| Homepage dark tema | ✅ Uygulanıyor, FOUC yok |
| Homepage grid layout | ✅ Main + sidebar doğru |
| Homepage bölümler | ✅ Son Haberler, Arşiv, Video, Galeri |
| `/haberler` sayfası | ✅ Layout tutarlı, header/footer var |
| CTA widget | ✅ Gizli (önceki hotfix) |

## Etkilenen Dosyalar

| Dosya | İşlem |
|-------|-------|
| `resources/views/layouts/app.blade.php` | 1 satır değişiklik (`data-theme`) |
| `resources/views/layouts/app.blade.php.bak-20260305-0632` | Yedek oluşturuldu |

## Rollback Planı

```powershell
Copy-Item resources\views\layouts\app.blade.php.bak-20260305-0632 resources\views\layouts\app.blade.php -Force
```

## Sonraki Adım Önerisi (FAZ 1.5 devamı)

1. **`@theme` token migrasyonu** — `app.css`'deki vanilla CSS değişkenlerini Tailwind v4 `@theme` bloğuna taşı (ayrı görev)
2. **Header'ı `04-frontend.md` standardına güncelle** — `sticky top-0 z-50 backdrop-blur-md h-[66px]` + CSS değişken renkleri
3. **Cleanup** — Ölü dosyaları sil (`home.blade.php` kök, `welcome.blade.php`, `liste.txt`, typo `join-community.blad.php`, `.bak-*` dosyaları)
4. **Component layout kararı** — `components/layouts/app.blade.php` silinsin mi yoksa section-based layout ile birleştirilsin mi? (Mimari karar gerekli)

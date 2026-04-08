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
# CADDE1905 — Backend Kuralları (Laravel)

**Aktivasyon:** Always On

---

## Naming Kuralları

- Route isimleri: `kaynak.aksiyon` formatı → `news.show`, `profile.edit`
- Tablo adları: küçük harf, alt çizgi, çoğul → `history_events`
- Model adları: PascalCase, tekil → `HistoryEvent`
- Servis sınıfları: `App\Services\` altında → `WatermarkService`
- Enum sınıfları: `App\Enums\` altında → `App\Enums\Rank`

## Model Zorunlu Kuralları

```php
// fillable — $guarded = [] KULLANMA
protected $fillable = ['title', 'slug', 'content', ...];

// Cast tanımları
protected $casts = [
    'published_at' => 'datetime',
    'rank'         => Rank::class,
];

// Public içerik modelleri için scope — ZORUNLU
public function scopePublished($query) {
    return $query->whereNotNull('published_at')
                 ->where('published_at', '<=', now());
}
```

- `SoftDeletes` → `News` modeline ekle
- Eager loading: `with()` kullan, N+1 sorgu yasak

## Controller Kuralları

- Resource Controller oluştur: `php artisan make:controller XController --resource --model=X`
- İş mantığı Controller'da değil, Service sınıfında olmalı
- Form validation: Form Request sınıfı oluştur

## Route Kuralları

```php
Route::resource('news', NewsController::class)->only(['index', 'show']);
// Admin panel route'u — zorunlu prefix:
Route::prefix('yonetim')->middleware(['auth', 'admin'])->group(...);
```

## Güvenlik

- Admin panel URL: `/yonetim` (asla `/admin` değil)
- Rate limiting: API route'larına ekle
- CSRF token: her formda (Laravel default)
- `.env` değerleri: asla hardcode etme

## Cache TTL (Database driver)

- Haber listesi: 30 dakika
- Puan durumu: 6 saat
- Kullanıcı profili: 15 dakika


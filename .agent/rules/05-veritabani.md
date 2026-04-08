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
# CADDE1905 — Veritabanı Kuralları (MySQL)

**Aktivasyon:** Always On

---

## Tablo Adları (Kesin — Değiştirme)

```
users               history_events      comments
news                legends             likes
categories          efsane_moments      cp_transactions
                    collections         moderation_queue
dictionary_topics   social_wall_items   city_guide_places
dictionary_entries
```

## Enum Değerleri (Rank)

```php
// App\Enums\Rank
nev_zuhur | mektepli | mulazim | kudema
```

## Migration Standartları

```php
Schema::create('tablo', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('slug')->unique();
    $table->timestamp('published_at')->nullable();
    $table->timestamps();   // ZORUNLU
});
// Index — arama yapılan kolonlar
$table->index(['slug', 'published_at']);
```

- `foreignId()->constrained()` kullan — `unsignedBigInteger` değil
- Her migration öncesi: `php artisan migrate --pretend`
- Büyük migration öncesi yedek: `mysqldump -u root -p cadde1905 > backup_YYYYMMDD.sql`

## Sorgu Kuralları

- Raw SQL yasak — Eloquent veya Query Builder
- `SELECT *` yasak — kolonları açık belirt
- N+1 yasak — `with()` ile eager load
- Listelerde: `paginate(15)`
- Toplu işlemlerde: `chunk(100, ...)`


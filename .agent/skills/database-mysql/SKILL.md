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
name: database-mysql
description: MySQL veritabanı şema tasarımı ve yönetimi. Yeni tablo migration'ı yazma, mevcut tabloya kolon ekleme, index oluşturma, Eloquent ilişki tanımlama, sorgu optimizasyonu ve yedekleme işlemlerinde bu skill'i kullan.
---

# Database MySQL Skill

## Amaç
CADDE1905 veritabanını doğru şema, tutarlı isimlendirme ve optimum performansla yönetmek.

## Migration Oluşturma Protokolü

```bash
# Yeni tablo
php artisan make:migration create_[tablo]_table

# Mevcut tabloya kolon ekleme
php artisan make:migration add_[kolon]_to_[tablo]_table

# SQL önizlemesi — ZORUNLU, uygulamadan önce kontrol et
php artisan migrate --pretend

# Büyük migration öncesi yedek — ZORUNLU
mysqldump -u root -p cadde1905 > backup_YYYYMMDD_HHMM.sql

# Uygula
php artisan migrate

# Sorun çıkarsa geri al
php artisan migrate:rollback --step=1
```

## Standart Migration Şablonu

```php
Schema::create('tablo_adi', function (Blueprint $table) {
    $table->id();

    // İlişkiler
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

    // Alanlar
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('content')->nullable();
    $table->string('cover_image')->nullable();

    // Enum → string olarak sakla, PHP Enum ile cast et
    $table->string('status')->default('draft');

    // Tarihler
    $table->timestamp('published_at')->nullable();
    $table->timestamps();   // created_at + updated_at — ZORUNLU
    // $table->softDeletes(); // Sadece News tablosunda
});

// Index — arama yapılan kolonlara
$table->index('slug');
$table->index('published_at');
$table->index(['category_id', 'published_at']); // bileşik
```

## Eloquent İlişki Şablonları

```php
// BelongsTo
public function category(): BelongsTo {
    return $this->belongsTo(Category::class);
}

// HasMany
public function comments(): HasMany {
    return $this->hasMany(Comment::class);
}

// BelongsToMany (koleksiyonlar)
public function collectedBy(): BelongsToMany {
    return $this->belongsToMany(User::class, 'collections')
                ->withTimestamps();
}

// MorphMany (likes, comments — polymorphic)
public function likes(): MorphMany {
    return $this->morphMany(Like::class, 'likeable');
}
```

## Sorgu Optimizasyonu

```php
// DOĞRU
News::with('category:id,name', 'author:id,username')
    ->select('id', 'title', 'slug', 'published_at', 'category_id', 'user_id')
    ->published()
    ->latest('published_at')
    ->paginate(15);

// YANLIŞ — N+1
foreach (News::all() as $news) {
    echo $news->category->name; // Her satırda sorgu!
}

// Toplu işlem
News::chunk(100, function ($items) {
    foreach ($items as $item) { /* işlem */ }
});
```

## PHP Enum Tanımı

```php
// app/Enums/Rank.php
enum Rank: string {
    case NevZuhur = 'nev_zuhur';
    case Mektepli = 'mektepli';
    case Mulazim  = 'mulazim';
    case Kudema   = 'kudema';
}

// Migration'da
$table->string('rank')->default(Rank::NevZuhur->value);

// Model'de
protected $casts = ['rank' => Rank::class];
```

## Tinker ile Hızlı Test

```bash
php artisan tinker
>>> App\Models\News::with('category')->published()->count()
>>> DB::table('users')->where('rank', 'kudema')->get()
>>> App\Models\User::first()->cp_transactions
```

## Kısıtlamalar
- Raw SQL kullanma — Eloquent veya Query Builder
- `SELECT *` kullanma — kolonları belirt
- Büyük migration öncesi yedek almadan devam etme
- `down()` metodunu boş bırakma — rollback çalışmalı

## Bu Skill'de Okunacak REFERENCE Dosyaları

| Dosya | Ne İçin |
|-------|---------|
| `Docs\REFERENCE\09_Kultur_Jargon_Referansi.md` | Tablo adları, kolon adları, enum değerleri — **zorunlu** |
| `Docs\REFERENCE\03_Uygulama_Fazlari.md` | Hangi tablo hangi fazda oluşturulacak |
| `Docs\REFERENCE\08_Icerik_Konsept_Rehberi.md` | İçerik veri modeli, kategori yapısı |
| `Docs\REFERENCE\02_Hosting_ve_Altyapi.md` | MySQL versiyon bilgisi, production kısıtlamaları |


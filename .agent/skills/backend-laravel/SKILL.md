---
name: backend-laravel
description: Laravel 12 backend geliştirme için detaylı protokol. Migration oluşturma, Eloquent model tanımlama, Resource Controller yazma, Service sınıfı oluşturma, Route tanımlama ve FilamentPHP resource ekleme işlemlerinde bu skill'i kullan.
---

# Backend Laravel Skill

## Amaç
CADDE1905 Laravel 12 backend katmanında tutarlı, güvenli ve optimize kod üretmek.

## Migration Protokolü

```bash
# 1. Oluştur
php artisan make:migration create_[tablo]_table

# 2. SQL çıktısını kontrol et
php artisan migrate --pretend

# 3. Uygula
php artisan migrate

# 4. Rollback testi
php artisan migrate:rollback --step=1
```

**Migration şablonu:**
```php
Schema::create('tablo_adi', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('content')->nullable();
    $table->string('rank')->default('nev_zuhur');
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
    $table->softDeletes(); // Sadece News tablosunda
    $table->index(['slug', 'published_at', 'category_id']);
});
```

## Model Protokolü

```bash
php artisan make:model [Model] -mfsc
# -m migration, -f factory, -s seeder, -c controller
```

**Model şablonu:**
```php
class News extends Model {
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'content', 'published_at', 'category_id', 'user_id'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // İlişkiler
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    // Scope — public modellere zorunlu
    public function scopePublished($query) {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}
```

## Controller Protokolü

```bash
php artisan make:controller NewsController --resource --model=News
php artisan make:request StoreNewsRequest
```

```php
// İş mantığı Service'e — Controller ince olmalı
public function store(StoreNewsRequest $request, NewsService $service) {
    $news = $service->create($request->validated());
    return redirect()->route('news.show', $news);
}
```

## Service Sınıfı

```php
// app/Services/NewsService.php
class NewsService {
    public function create(array $data): News {
        // Slug oluştur, watermark ekle, cache temizle
        $data['slug'] = Str::slug($data['title']);
        return News::create($data);
    }
}
```

## FilamentPHP Resource

```bash
php artisan make:filament-resource News --generate
# Panel route: /yonetim (asla /admin değil)
```

## Artisan Komutları

```bash
php artisan optimize:clear   # Cache sorunlarında
php artisan route:list       # Route kontrolü
php artisan tinker           # Hızlı test
php artisan test             # Test suite
```

## Kısıtlamalar
- `$guarded = []` kullanma — her zaman `$fillable`
- Raw SQL yasak
- N+1 sorgu yasak — `with()` kullan
- Hardcode değer yasak

## Bu Skill'de Okunacak REFERENCE Dosyaları

| Dosya | Ne İçin |
|-------|---------|
| `Docs\REFERENCE\09_Kultur_Jargon_Referansi.md` | Tablo adları, model adları, enum değerleri — **zorunlu** |
| `Docs\REFERENCE\03_Uygulama_Fazlari.md` | Hangi model/özellik hangi fazda, sıralama |
| `Docs\REFERENCE\08_Icerik_Konsept_Rehberi.md` | İçerik türleri, kategori yapısı, haber modeli |
| `Docs\REFERENCE\13_Rol_ve_Is_Bolumu.md` | FilamentPHP ile hangi işlemlerin yapılacağı |

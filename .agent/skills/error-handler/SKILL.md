---
name: error-handler
description: Hata, exception veya beklenmedik davranışla karşılaşıldığında devreye gir. "Hata var", "çalışmıyor", "exception", "500 hatası", "migration failed", "siyah ekran", "route bulunamadı" gibi durumlarda bu skill'i kullan. 5 adımlı protokolü uygula.
---

# Error Handler Skill

## Amaç
Her hatayı sistematik biçimde analiz et, izole et, test et ve güvenli şekilde çöz. Çözümü rapor olarak kaydet.

## 5 Adımlı Hata Çözüm Protokolü

### Adım 1: Analiz

```bash
# Laravel log — son 50 satır
tail -n 50 storage/logs/laravel.log

# PHP hata logu
tail -n 30 /var/log/php_errors.log

# Artisan ile durum kontrolü
php artisan about
```

Tespit edilecekler:
- Hata türü: syntax / logic / config / DB / permission / route
- Hatanın fırlatıldığı dosya ve satır
- Son yapılan değişiklik neydi? (`git diff`)

### Adım 2: Kaynak Tespiti

```bash
# Cache sorunları için — ilk deneme
php artisan optimize:clear

# Spesifik cache temizleme
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Autoload sorunu için
composer dump-autoload

# Migration durumu
php artisan migrate:status
```

### Adım 3: Test Ortamı

```bash
# Tinker ile izole test
php artisan tinker
>>> App\Models\News::first()        // Model çalışıyor mu?
>>> DB::table('news')->count()      // DB bağlantısı var mı?
>>> route('news.index')             // Route var mı?
```

Geçici debug route (test sonrası SİL):
```php
// routes/web.php sonuna ekle — test bittikten sonra kaldır
Route::get('/debug-test', function () {
    dd(App\Models\News::with('category')->first());
});
```

### Adım 4: Doğrulama

```bash
php artisan test --filter=TestSinifi
curl -s http://cadde1905.test/[route] | head -50
php artisan route:list | grep [pattern]
```

Hata devam ediyorsa Adım 1'e dön — farklı kaynak ara.

### Adım 5: Uygula ve Raporla

1. Debug kodlarını kaldır (`dd()`, `dump()`, test route)
2. Düzeltmeyi gerçek dosyaya uygula
3. `php artisan test` çalıştır
4. Raporu yaz: `Docs\PROJECT_LOG\report\YYYYMMDD-HHMM-error-[konu].md`

---

## Sık Karşılaşılan Hatalar — Hızlı Çözüm

### 419 Page Expired
```blade
{{-- Blade formuna CSRF ekle --}}
<form method="POST">
    @csrf
```

### Class Not Found
```bash
composer dump-autoload
php artisan optimize:clear
```

### Migration Failed: Column Already Exists
```bash
php artisan migrate:status
php artisan migrate:rollback --step=1
# Migration dosyasını düzelt, tekrar migrate
```

### FilamentPHP 404
```bash
php artisan filament:upgrade
php artisan optimize:clear
# config/filament.php → path: 'yonetim' olmalı
```

### Tailwind Stilleri Görünmüyor
```bash
npm run dev    # Geliştirmede
npm run build  # Production
```

### .env Değişikliği Sonrası Config Cache
```bash
php artisan config:clear
php artisan config:cache
```

### Siyah Ekran / Boş Sayfa
```bash
# APP_DEBUG=true yap (geçici)
# storage/logs/laravel.log oku
# storage/ klasörü yazma izni kontrol
chmod -R 775 storage/ bootstrap/cache/
```

## Kısıtlamalar
- Production'da `dd()` veya `var_dump()` bırakma
- Hatayı çözmeden rapor yazmayı atlama
- Test ortamında doğrulamadan gerçek ortama geçme
- Hata kaynağını bulmadan `php artisan optimize:clear` yapıp devam etme

## Bu Skill'de Okunacak REFERENCE Dosyaları

| Dosya | Ne İçin |
|-------|---------|
| `Docs\REFERENCE\02_Hosting_ve_Altyapi.md` | Sunucu ortamı, PHP versiyonu, path bilgileri |
| `Docs\REFERENCE\09_Kultur_Jargon_Referansi.md` | Doğru tablo/model adı teyidi için |

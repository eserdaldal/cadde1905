# FAZ 1.5 — Frontend Mimari (Genişletilmiş) — STRICT PROTOCOL RAPORU

**Tarih:** 2026-03-05 06:58
**Görev:** FAZ 1.5 Frontend Mimari — Partials + Component Standardizasyonu
**Protokol:** CONTROLLED_EXECUTION_STRICT
**Durum:** ✅ Tamamlandı

---

## 1) Ne Yapıldı

### CREATE — 5 Yeni Dosya

| # | Dosya (Tam Yol) | Amaç | Risk |
|---|-----------------|------|------|
| 1 | `C:\laragon\www\cadde1905\resources\views\partials\header.blade.php` | Header partial — logo, mobile menu button, `@include('partials.nav')`, dark mode toggle | Düşük — mevcut markup'ın kopyası |
| 2 | `C:\laragon\www\cadde1905\resources\views\partials\nav.blade.php` | Desktop navigasyon partial (header'dan ayrıştırıldı) — Haberler dropdown, Efsane Anlar, Puan Durumu, Fikstür | Düşük — header'ın nav bölümünün izolasyonu |
| 3 | `C:\laragon\www\cadde1905\resources\views\partials\footer.blade.php` | Footer partial — branding, sosyal linkler (Twitter/Instagram), copyright, legal linkler | Düşük — mevcut markup'ın kopyası |
| 4 | `C:\laragon\www\cadde1905\resources\views\components\news\card.blade.php` | Tekil haber kartı bileşeni — `@props(['item'])` ile reusable | Düşük — yeni dosya, mevcut sisteme etkisiz |
| 5 | `C:\laragon\www\cadde1905\resources\views\components\widgets\league-table.blade.php` | Puan durumu widget — placeholder (API 1.6'da canlanacak) | Düşük — yeni dosya, sidebar'a henüz eklenmedi |

### EDIT — 1 Dosya (Sadece 2 Satır)

**Dosya:** `C:\laragon\www\cadde1905\resources\views\layouts\app.blade.php`
**Backup:** `layouts\app.blade.php.bak-20260305-0648`

```diff
 <body>
-    <x-header />
+    @include('partials.header')

     <main>
         @yield('content')
     </main>

-    <x-footer />
+    @include('partials.footer')
 </body>
```

`layouts/app.blade.php` tam içeriği (45 satır):
```html
<!DOCTYPE html>
<html lang="tr" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Cadde1905') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.svg') }}">

    <!-- Manrope Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- FOUC Prevention Script -->
    <script>
        (function () {
            let theme = localStorage.getItem('theme');
            if (!theme) {
                theme = 'dark';
                localStorage.setItem('theme', theme);
            }
            document.documentElement.dataset.theme = theme;
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>

</html>
```

---

## 2) Dokunulmayan Dosyalar (Compat Layer)

Aşağıdaki dosyalar olduğu gibi korundu (0 edit, 0 delete, 0 rename):

| Dosya | Neden Korundu |
|-------|---------------|
| `components/header.blade.php` | Compat — `<x-header/>` çağrıları hâlâ çalışır |
| `components/footer.blade.php` | Compat — `<x-footer/>` çağrıları hâlâ çalışır |
| `components/sidebar.blade.php` | Aktif — tüm sayfalar `<x-sidebar/>` kullanıyor |
| `components/widgets/next-match.blade.php` | Zaten mevcut — üzerine yazılmadı |
| `components/widgets/categories.blade.php` | Zaten mevcut — üzerine yazılmadı |
| `components/widgets/super-lig.blade.php` | Zaten mevcut — üzerine yazılmadı |
| Tüm diğer widget dosyaları | Kapsam dışı |
| `pages/*.blade.php` | MIGRATE LATER — bu fazda sayfa refactor yok |
| PostCSS / Tailwind / Vite config | Kapsam dışı — build pipeline sabit |

**Oluşturulmayan:** `components/sidebar/index.blade.php` — Blade ambiguity riski (mevcut `<x-sidebar/>` kırılır).

---

## 3) Verify Çıktıları

| Test | Komut | Sonuç |
|------|-------|-------|
| Container restart | `docker compose restart node` | ✅ Clean restart |
| Hata taraması | `docker compose logs --since 30s node` | ✅ Çıktı yok (hata yok) |
| Homepage HTTP | `curl -s -o NUL -w "%{http_code}" http://localhost:8080/` | ✅ **200** |
| Haberler HTTP | `curl -s -o NUL -w "%{http_code}" http://localhost:8080/haberler` | ✅ **200** |
| Homepage HTML | `curl -s http://localhost:8080/ \| grep header/footer/nav/logo` | ✅ `<header>`, `<nav>`, `</nav>`, `</header>`, `<footer>`, `</footer>`, `logo.svg` mevcut |
| Haberler HTML | `curl -s http://localhost:8080/haberler \| grep header/footer` | ✅ `<header>`, `<footer>`, "Haberler" mevcut |

---

## 4) Rollback Komutu

```powershell
# Tek komutla geri dönüş:
Copy-Item C:\laragon\www\cadde1905\resources\views\layouts\app.blade.php.bak-20260305-0648 C:\laragon\www\cadde1905\resources\views\layouts\app.blade.php -Force
```

**Rollback testi:**
```powershell
# Restore sonrası doğrulama:
curl.exe -s -o NUL -w "%{http_code}" http://localhost:8080/
# Beklenen: 200
```

Not: Partials dosyaları silinmese bile zarar vermez (sadece kullanılmayan dosyalar olur).

---

## 5) Sonraki Adımlar (MIGRATE LATER — Bu Fazda UYGULANMADI)

| # | Önerilen İş | Açıklama |
|---|-------------|----------|
| 1 | Sayfa refactor | `pages/home.blade.php` ve `pages/news/*.blade.php` → `<x-news.card>` kullanımına geçirilmesi |
| 2 | `@theme` token migrasyonu | `app.css` vanilla CSS değişkenlerini Tailwind v4 `@theme` bloğuna taşıma |
| 3 | Header standardizasyonu | `04-frontend.md` uyumu: `h-[66px]`, `backdrop-blur-md`, CSS değişken renkleri |
| 4 | Ölü dosya cleanup | `home.blade.php` (kök), `welcome.blade.php`, `liste.txt`, typo `join-community.blad.php`, `.bak-*` |
| 5 | Compat layer kararı | `components/header.blade.php` + `components/footer.blade.php` silinsin mi yoksa partials'a redirect mi olsun? |
| 6 | `league-table` widget entegrasyonu | Sidebar'a ekleme + API-Football bağlantısı (Faz 1.6) |

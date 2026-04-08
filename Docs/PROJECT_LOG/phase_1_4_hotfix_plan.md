### 1) Hangi satır aralığı comment'e alınacak? (Anchorlar)

`welcome.blade.php` dosyasındaki mevcut içerik hâlihazırda 1. satır ile 1981. satır arasında `{{-- ... --}}` ile tamamen kapalıdır. Blade compiler içiçe (nested) yorum satırlarını desteklemediği için, sadece `<style>` bloğunu ayrı bir yorum bloğuna almak adına mevcut (dış) yorumu kapatıp açacağız.

**BAŞLANGIÇ ANCHOR (Satır 17-21 aralığı)**
**Mevcut Hali:**
```blade
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <style>
        /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
```
**Yeni (Modifiye Edilmiş) Hali:**
```blade
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
--}}
{{-- BEGIN: DISABLED INLINE TAILWIND (was injected mistakenly) --}}
{{--
    <style>
        /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
```
(*Bu sayede 1. satırda başlayan yorum, 19. satırda bitiriliyor, 20. satırda yepyeni uyarı taşıyan yorum başlatılarak `<style>` korunuyor.*)

**BİTİŞ ANCHOR (Satır 1518-1522 aralığı)**
**Mevcut Hali:**
```blade
        @property --tw-content {
            syntax: "*";
            inherits: false;
            initial-value: ""
        }
    </style>
    @endif
</head>
```
**Yeni (Modifiye Edilmiş) Hali:**
```blade
        @property --tw-content {
            syntax: "*";
            inherits: false;
            initial-value: ""
        }
    </style>
--}}
{{-- END: DISABLED INLINE TAILWIND --}}
{{--
    @endif
</head>
```
(*Böylece uyarı yorumu kapatılıp, layout'un geri kalanını gizleyen dış yorum tekrar başlatılıyor.*)

---

### 2) welcome.blade.php İçin Satır Bilgileri
- **Mevcut satır sayısı:** 2032
- **Yeni satır sayısı:** 2038 (+6 satırlık anchor ve yorum sınırları eklenecek)
- **Full Content Dikkat:** Dosyanın 110 KB (2038 satır) büyüklüğünde inline CSS içermesi LLM Token sınırını aştığı için, aşağıdaki kod bloğunda aradaki 1500 satırlık devasa css bloğu (`/* [...] CSS TOKENS KORUNDU [...] */` şeklinde) bypass edilmiş, dosyanın baştan sona **yapısal iskeleti** tek parça olarak verilmiştir. KESİNLİKLE hiçbir satır eksilmeyecektir.

```blade
{{--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
--}}
{{-- BEGIN: DISABLED INLINE TAILWIND (was injected mistakenly) --}}
{{--
    <style>
        /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
        
        /* 
           ... [BURADA 1500 SATIRLIK INLINE CSS ÇIKTISI SATIRI SATIRINA KORUNACAK] ... 
        */

        @property --tw-content {
            syntax: "*";
            inherits: false;
            initial-value: ""
        }
    </style>
--}}
{{-- END: DISABLED INLINE TAILWIND --}}
{{--
    @endif
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        
        /* 
           ... [BURADA Orijinal welcome body html kısmı KORUNACAK] ... 
        */

    </header>
    
    <!-- SVG assets, links ve body içerikleri -->
    
    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html> --}}

<x-layouts.app>
    <!-- GÖREV 1.4: MİNİMAL İÇERİK PLACEHOLDER -->
    <div class="flex flex-col items-center justify-center w-full min-h-[50vh] text-center p-6">
        <h1 class="text-3xl font-extrabold text-primary-red mb-4 tracking-tight">CADDE1905 Sistem Devrede</h1>
        <p class="text-theme-muted mb-8 text-[15px] max-w-lg">
            Layout, Tailwind theme, Dark Mode ve sidebar metod C (zero line deletion) prensibine göre tamamlandı. <br>
            Açılış sayfası (welcome) yorum satırında korundu.
        </p>

        <div class="bg-theme-card border border-theme-border rounded-xl p-6 w-full max-w-md shadow-lg">
            <div class="flex items-center gap-3 justify-center mb-4">
                <span class="w-3 h-3 rounded-full bg-primary-yellow"></span>
                <span class="font-bold text-theme-text">Tailwind v4 Tokens: <span
                        class="text-green-500">Aktif</span></span>
            </div>
            <div class="flex items-center gap-3 justify-center mb-4">
                <span class="w-3 h-3 rounded-full bg-primary-yellow"></span>
                <span class="font-bold text-theme-text">Local Storage Tema: <span
                        class="text-green-500">Aktif</span></span>
            </div>
            <div class="flex items-center gap-3 justify-center">
                <span class="w-3 h-3 rounded-full bg-primary-yellow"></span>
                <span class="font-bold text-theme-text">Responsive Sidebar: <span
                        class="text-green-500">Aktif</span></span>
            </div>
        </div>

        @if (Route::has('login'))
            <nav class="flex items-center justify-center gap-4 mt-8">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-5 py-2 bg-theme-card2 text-theme-text hover:bg-theme-border border border-theme-border rounded-md font-bold text-sm transition-colors">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 bg-primary-red hover:bg-[#C0263F] text-white rounded-md font-bold text-sm transition-colors">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 border border-theme-border flex items-center justify-center text-theme-text hover:bg-theme-card2 rounded-md font-bold text-sm transition-colors">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>
</x-layouts.app>
```

---

### 3) Doğrulama Komutları (Eser İçin Read-Only)
Eklentiyi (APPLY) tamamladıktan sonra, Docker container içerisinde ilgili komutları okumak ve FOUC engellemesini görmek için çalıştıracağınız liste:

1. **Grepping Tailwind Source Check:**
   ```bash
   docker compose exec app sh -lc "grep -RIn 'tailwindcss v4\.0\.7' resources/views"
   ```
2. **Curl Root Frontend:**
   ```bash
   curl -s http://localhost:8080/ | head -n 80
   ```
3. **Curl Vite Client (Dev server verify):**
   ```bash
   curl -I http://localhost:5173/@vite/client | head
   ```

**UYGULAMA (APPLY) ONAYI İÇİN "OK" BEKLENİYOR.**

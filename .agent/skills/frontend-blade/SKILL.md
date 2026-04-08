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
name: frontend-blade
description: Blade template, Tailwind CSS v4, Alpine.js ve BladewindUI ile CADDE1905 frontend geliştirme protokolü. Yeni sayfa layout'u, Blade bileşeni, dark/light mode toggle, renk sistemi, tipografi veya responsive yapı oluştururken bu skill'i kullan.
---

# Frontend Blade Skill

## Amaç
Dark-mode öncelikli, Galatasaray kimliğine uygun, tutarlı frontend üretmek.

## Yeni Sayfa Oluşturma Adımları

1. Layout dosyasını belirle: `resources/views/layouts/app.blade.php`
2. Section'ları tanımla: `@extends('layouts.app')` + `@section('content')`
3. Dark/light tema class'larını ekle
4. Responsive: mobile-first, `sm:` `md:` `lg:` sıralaması

## Dark Mode Zorunlu Yapı

```html
<!DOCTYPE html>
<html lang="tr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- FOUC önlemi — head'in EN BAŞINDA olmalı --}}
    <script>
        (function(){
            var t = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
```

## CSS Tema Geçişi

```css
/* resources/css/app.css */
@import 'tailwindcss';
@import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

@theme {
  --color-primary:        #A91D35;
  --color-accent:         #FCB816;
  --color-dark-bg:        #141414;
  --color-dark-surface:   #1E1E1E;
  --color-dark-surface-2: #272727;
  --color-dark-border:    #333333;
  --color-dark-muted:     #909090;
  --color-dark-text:      #F2F2F2;
  --color-light-bg:       #F2F2F2;
  --color-light-surface:  #FFFFFF;
  --color-light-surface-2:#EBEBEB;
  --color-light-border:   #D0D0D0;
  --color-light-text:     #1A1A1A;
  --font-sans: 'Manrope', sans-serif;
}

[data-theme="dark"] {
    background-color: var(--color-dark-bg);
    color: var(--color-dark-text);
}
[data-theme="light"] {
    background-color: var(--color-light-bg);
    color: var(--color-light-text);
}
```

## Dark Mode Toggle (Alpine.js)

```html
<button
    x-data="{ theme: localStorage.getItem('theme') || 'dark' }"
    @click="
        theme = theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', theme);
        document.documentElement.setAttribute('data-theme', theme);
    "
    class="p-2 rounded-lg">
    <span x-show="theme === 'dark'">☀️</span>
    <span x-show="theme === 'light'">🌙</span>
</button>
```

## Header Şablonu

```html
<header class="sticky top-0 z-50 backdrop-blur-md h-[66px]
               border-b border-[var(--color-dark-border)]
               bg-[var(--color-dark-surface)]/90">
    <div class="max-w-7xl mx-auto px-4 h-full flex items-center justify-between">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.svg') }}" alt="CADDE1905" class="h-8">
        </a>
        {{-- nav + toggle --}}
    </div>
</header>
```

## Blade Bileşeni Oluşturma

```bash
php artisan make:component CardNews
# resources/views/components/card-news.blade.php
# app/View/Components/CardNews.php
```

```html
{{-- Kullanım --}}
<x-card-news :news="$item" />
```

## BladewindUI Kullanımı

```html
<x-bladewind::card>...</x-bladewind::card>
<x-bladewind::button label="Gönder" type="primary" />
<x-bladewind::input name="email" placeholder="Email" />
<x-bladewind::notification />
```

## İkon Sistemi

```html
{{-- Lucide Icons --}}
<i data-lucide="star" class="w-5 h-5 text-[var(--color-accent)]"></i>

{{-- JS --}}
<script>
    import { createIcons, icons } from 'lucide';
    createIcons({ icons });
</script>
```

## Kısıtlamalar
- Tailwind `config.js` oluşturma — sadece `@theme` kullan
- Bootstrap ekleme
- jQuery ekleme
- `@apply` kullanımını minimumda tut

## Bu Skill'de Okunacak REFERENCE Dosyaları

| Dosya | Ne İçin |
|-------|---------|
| `Docs\REFERENCE\04_Sayfa_Yerlesim_Plani.md` | Sayfa yapıları, wireframe, URL/route listesi — **zorunlu** |
| `Docs\REFERENCE\05_Kurumsal_Kimlik_Tasarim.md` | Renk paleti, tipografi, logo kuralları — **zorunlu** |
| `Docs\REFERENCE\06_Gorsel_Varlik_Kurallari.md` | Görsel boyutları, logo konumları, watermark |
| `Docs\REFERENCE\09_Kultur_Jargon_Referansi.md` | Türkçe UI terimleri, etiket isimleri |
| `Docs\REFERENCE\12_Felsefi_Detaylar.md` | Kullanıcı deneyimi tonu, taraftar kimliği |


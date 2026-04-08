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
# CADDE1905 — Frontend Kuralları (Blade + Tailwind)

**Aktivasyon:** Always On

---

## Tema Sistemi

- Dark mode **varsayılan** — localStorage yoksa dark açılır
- `data-theme` attribute `<html>` etiketine yazılır
- FOUC önlemi: `<head>` içinde inline script zorunlu

```html
<script>
  (function(){
    var t = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-theme', t);
  })();
</script>
```

## Renk Tokenleri (@theme bloğu)

```css
@import 'tailwindcss';
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
```

## Layout Standartları

- Header yüksekliği: `h-[66px]` desktop, `h-[56px]` mobile
- Header: `sticky top-0 backdrop-blur-md z-50`
- Logo: `public/images/logo.svg`
- İkonlar: Lucide Icons

## Tailwind v4 Kuralları

- Config dosyası oluşturma — `resources/css/app.css` içinde `@theme` kullan
- `@apply` kullanımını minimumda tut
- Utility class override: `data-theme` attribute ile CSS değişkenleri

## Alpine.js Kuralları

- Sadece basit UI etkileşimi (dropdown, modal, toggle)
- Karmaşık logic için sunucu taraflı çöz
- jQuery ekleme — vanilla JS veya Alpine kullan

## BladewindUI

```html
<x-bladewind::card>...</x-bladewind::card>
<x-bladewind::button label="Gönder" />
```

## Yasaklar

- Bootstrap ekleme
- Tailwind config.js dosyası oluşturma
- jQuery ekleme


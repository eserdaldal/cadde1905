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
# CADDE1905 — Sayfa Yapıları Referansı

Bu dosya frontend-blade skill'i tarafından referans olarak kullanılır.
Detay için: `Docs/REFERENCE/04_Sayfa_Yerlesim_Plani.md`

## Ana Sayfalar

| Sayfa           | Route       | View                          | Layout       |
|-----------------|-------------|-------------------------------|--------------|
| Ana Sayfa       | `/`         | `home.blade.php`              | `layouts.app`|
| Haberler        | `/haberler` | `news/index.blade.php`        | `layouts.app`|
| Haber Detay     | `/haberler/{slug}` | `news/show.blade.php`  | `layouts.app`|
| Tarih           | `/tarih`    | `history/index.blade.php`     | `layouts.app`|
| Efsaneler       | `/efsaneler`| `legends/index.blade.php`     | `layouts.app`|
| Sözlük          | `/sozluk`   | `dictionary/index.blade.php`  | `layouts.app`|
| Profil          | `/profil`   | `profile/show.blade.php`      | `layouts.app`|

## Bileşen Listesi (Faz 1)

```
resources/views/components/
├── card-news.blade.php        — Haber kartı
├── card-legend.blade.php      — Efsane futbolcu kartı
├── section-header.blade.php   — Bölüm başlığı
├── badge-rank.blade.php       — Rütbe rozeti
├── nav-header.blade.php       — Navigasyon
└── footer-main.blade.php      — Footer
```

## Grid Sistemi

```html
{{-- Haber grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($news as $item)
        <x-card-news :news="$item" />
    @endforeach
</div>

{{-- Pagination --}}
{{ $news->links() }}
```


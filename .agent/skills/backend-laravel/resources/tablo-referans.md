# CADDE1905 — Tablo ve Model Referansı

Bu dosya backend-laravel skill'i tarafından referans olarak kullanılır.

## Tablo → Model Eşleştirmesi

| Tablo               | Model           | Özel Özellik          |
|---------------------|-----------------|-----------------------|
| users               | User            | Auth, Rank, CP        |
| news                | News            | SoftDeletes, slug     |
| categories          | Category        | —                     |
| history_events      | HistoryEvent    | published_at          |
| legends             | Legend          | published_at          |
| efsane_moments      | EfsaneMoment    | published_at          |
| collections         | Collection      | BelongsToMany         |
| dictionary_topics   | DictionaryTopic | —                     |
| dictionary_entries  | DictionaryEntry | BelongsTo topic       |
| comments            | Comment         | Polymorphic           |
| likes               | Like            | Polymorphic           |
| cp_transactions     | CpTransaction   | —                     |
| moderation_queue    | ModerationQueue | —                     |
| social_wall_items   | SocialWallItem  | —                     |
| city_guide_places   | CityGuidePlace  | —                     |

## Enum: App\Enums\Rank

```php
enum Rank: string {
    case NevZuhur = 'nev_zuhur';   // Yeni üye
    case Mektepli = 'mektepli';    // Aktif üye
    case Mulazim  = 'mulazim';     // Kıdemli üye
    case Kudema   = 'kudema';      // Efsane üye
}
```

## Route Grupları

```php
// Web — Public
Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::resource('history', HistoryEventController::class)->only(['index', 'show']);

// Web — Auth gerekli
Route::middleware('auth')->group(function () {
    Route::resource('comments', CommentController::class)->only(['store', 'destroy']);
});

// Admin panel
Route::prefix('yonetim')->middleware(['auth', 'admin'])->group(function () {
    // FilamentPHP otomatik halleder
});
```

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoricalMatchController;
use App\Http\Controllers\HistoryEventController;
use App\Http\Controllers\HistoryEventPreviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegendController;
use App\Http\Controllers\LegendPreviewController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MirasController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SeasonArchiveController;
use App\Http\Controllers\SeasonArchivePreviewController;
use App\Http\Controllers\StandingsController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\TrophyController;
use App\Http\Controllers\TrophyPreviewController;
use App\Http\Controllers\HistoricalMatchPreviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

// ═══ HOMEPAGE ═══
Route::get('/', [HomeController::class, 'index'])->name('home');

// ═══ NEWS ═══
Route::prefix('haberler')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// ═══ CATEGORIES & TAGS ═══
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/etiket/{slug}', [TagController::class, 'show'])->name('tag.show');

// ═══ MATCH CENTER & STANDINGS ═══
Route::get('/mac-merkezi', [MatchController::class, 'show'])->name('match.show');
Route::get('/puan-durumu', [StandingsController::class, 'index'])->name('standings.index');
Route::get('/kronoloji', TimelineController::class)->name('timeline.index');

// ═══ PLATFORM / CORPORATE / LEGAL ═══
Route::prefix('platform')->name('platform.')->group(function () {
    Route::view('/', 'pages.platform.index')->name('index');
    Route::view('/hakkimizda', 'pages.platform.about')->name('about');
    Route::view('/iletisim', 'pages.platform.contact')->name('contact');
    Route::view('/gizlilik-politikasi', 'pages.platform.privacy')->name('privacy');
    Route::view('/kullanim-sartlari', 'pages.platform.terms')->name('terms');
    Route::view('/kvkk', 'pages.platform.kvkk')->name('kvkk');
});

// ═══ MIRAS (MUSEUM) SECTION ═══
Route::prefix('miras')->name('miras.')->group(function () {
    Route::get('/', [MirasController::class, 'index'])->name('index');

    // Efsaneler
    Route::prefix('efsaneler')->name('legends.')->group(function () {
        Route::get('/', [LegendController::class, 'index'])->name('index');
        Route::get('/{slug}', [LegendController::class, 'show'])->name('show');
    });

    // Sezon Arşivleri
    Route::prefix('sezonlar')->name('seasons.')->group(function () {
        Route::get('/', [SeasonArchiveController::class, 'index'])->name('index');
        Route::get('/{slug}', [SeasonArchiveController::class, 'show'])->name('show');
    });

    // Tarihi Maçlar
    Route::prefix('tarihi-maclar')->name('matches.')->group(function () {
        Route::get('/', [HistoricalMatchController::class, 'index'])->name('index');
        Route::get('/{slug}', [HistoricalMatchController::class, 'show'])->name('show');
    });

    // Kupalar
    Route::prefix('kupalar')->name('trophies.')->group(function () {
        Route::get('/', [TrophyController::class, 'index'])->name('index');
        Route::get('/{slug}', [TrophyController::class, 'show'])->name('show');
    });

    // History Events (Anlar, Dönemler, Kadrolar, Başarılar, Dönüm Noktaları)
    Route::get('/anlar', [HistoryEventController::class, 'indexByType'])->name('moments.index')->defaults('type', 'moment');
    Route::get('/donemler', [HistoryEventController::class, 'indexByType'])->name('eras.index')->defaults('type', 'era');
    Route::get('/kadrolar', [HistoryEventController::class, 'indexByType'])->name('squads.index')->defaults('type', 'squad');
    Route::get('/basarilar', [HistoryEventController::class, 'indexByType'])->name('achievements.index')->defaults('type', 'achievement');
    Route::get('/donum-noktalari', [HistoryEventController::class, 'indexByType'])->name('milestones.index')->defaults('type', 'milestone');

    Route::get('/anlar/{slug}', function (string $slug) { return app(HistoryEventController::class)->show(request(), $slug, 'moment'); })->name('moments.show');
    Route::get('/donemler/{slug}', function (string $slug) { return app(HistoryEventController::class)->show(request(), $slug, 'era'); })->name('eras.show');
    Route::get('/kadrolar/{slug}', function (string $slug) { return app(HistoryEventController::class)->show(request(), $slug, 'squad'); })->name('squads.show');
    Route::get('/basarilar/{slug}', function (string $slug) { return app(HistoryEventController::class)->show(request(), $slug, 'achievement'); })->name('achievements.show');
    Route::get('/donum-noktalari/{slug}', function (string $slug) { return app(HistoryEventController::class)->show(request(), $slug, 'milestone'); })->name('milestones.show');
});

// ═══ SIGNED PREVIEW ROUTES (ADMIN CONTENT PREVIEW) ═══
Route::middleware(['auth', 'signed'])->prefix('preview')->name('preview.')->group(function () {
    Route::get('/history-events/{historyEvent}', [HistoryEventPreviewController::class, 'show'])->name('history-events.show');
    Route::get('/historical-matches/{historicalMatch}', [HistoricalMatchPreviewController::class, 'show'])->name('historical-matches.show');
    Route::get('/season-archives/{seasonArchive}', [SeasonArchivePreviewController::class, 'show'])->name('season-archives.show');
    Route::get('/legends/{legend}', [LegendPreviewController::class, 'show'])->name('legends.show');
    Route::get('/trophies/{trophy}', [TrophyPreviewController::class, 'show'])->name('trophies.show');
});

require __DIR__ . '/worldcup.php';
require __DIR__ . '/engelsiz.php';

Route::get('/arama', [SearchController::class, 'index'])->name('search.index');

// Match Detail Page
Route::get('/mac/{fixture_id}', [\App\Http\Controllers\Match\MatchDetailController::class, 'show'])->name('match.detail');


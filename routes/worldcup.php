<?php

/*
|--------------------------------------------------------------------------
| CADDE1905 — Dünya Kupası 2026 Route Tanımları
|--------------------------------------------------------------------------
|
| Bu dosya Dünya Kupası bölümünün tüm route'larını tanımlar.
|
| ENTEGRASYON:
| routes/web.php dosyasının sonuna şu satırı ekleyin:
|     require __DIR__ . '/worldcup.php';
|
| MEVCUT DURUM:
| Route'lar şu anda closure (anonim fonksiyon) ile tanımlıdır.
| Bu geçici bir yaklaşımdır — controller'lar olmadan sayfaların
| render edilmesini sağlar. Üretim ortamı için controller'lara
| geçilmesi önerilir.
|
| ROUTE MODEL BINDING:
| {team:slug}, {stadium:slug}, {player:slug} parametreleri Laravel'in
| implicit route model binding sözdizimini kullanır. Ancak bu fazda
| model binding AKTİF DEĞİLDİR — closure'lar parametreyi string
| olarak alır ve kullanmaz. Binding, ilgili Eloquent modelleri ve
| getRouteKeyName() tanımları oluşturulduğunda devreye girer.
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorldCup\WorldCupHomeController;
use App\Http\Controllers\WorldCup\WorldCupTeamController;
use App\Http\Controllers\WorldCup\WorldCupMatchController;
use App\Http\Controllers\WorldCup\WorldCupGroupController;
use App\Http\Controllers\WorldCup\WorldCupStatController;
use App\Http\Controllers\WorldCup\WorldCupStadiumController;
use App\Http\Controllers\WorldCup\WorldCupPlayerController;


Route::prefix('dunya-kupasi')->name('worldcup.')->group(function () {

    // ── Landing Page ────────────────────────────────────────────────
    // Controller: WorldCupController@index
    Route::get('/', [WorldCupHomeController::class, 'index'])->name('index');

    // ── Takımlar ────────────────────────────────────────────────────
    // Controller: WorldCupTeamController@index, @show
    Route::get('/takimlar', [WorldCupTeamController::class, 'index'])->name('teams.index');

    Route::get('/takimlar/{team:slug}', [WorldCupTeamController::class, 'show'])->name('teams.show');

    // ── Maçlar ──────────────────────────────────────────────────────
    // Controller: WorldCupMatchController@index, @show
    Route::get('/maclar', [WorldCupMatchController::class, 'index'])->name('matches.index');

    Route::get('/maclar/{match}', [WorldCupMatchController::class, 'show'])->name('matches.show');

    // ── Gruplar & Puan Durumu ───────────────────────────────────────
    // Controller: WorldCupGroupController@index
    Route::get('/gruplar', [WorldCupGroupController::class, 'index'])->name('groups.index');

    // ── İstatistikler ───────────────────────────────────────────────
    // Controller: WorldCupStatController@index
    Route::get('/istatistikler', [WorldCupStatController::class, 'index'])->name('stats.index');

    // ── Stadyumlar ──────────────────────────────────────────────────
    // Controller: WorldCupStadiumController@index, @show
    Route::get('/stadyumlar', [WorldCupStadiumController::class, 'index'])->name('stadiums.index');

    Route::get('/stadyumlar/{stadium:slug}', [WorldCupStadiumController::class, 'show'])->name('stadiums.show');

    // ── Kupadaki Aslanlar ───────────────────────────────────────────
    // Controller: WorldCupAslanlarController@index, @show
    Route::get('/kupadaki-aslanlar', [WorldCupPlayerController::class, 'index'])->name('aslanlar.index');

    Route::get('/kupadaki-aslanlar/{player:slug}', [WorldCupPlayerController::class, 'show'])->name('aslanlar.show');

});

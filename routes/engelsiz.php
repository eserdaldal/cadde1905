<?php

use Illuminate\Support\Facades\Route;

Route::prefix('engelsiz-aslanlar')->name('engelsiz-aslanlar.')->group(function () {
    Route::get('/', function () {
        return view('engelsiz.index');
    })->name('index');
});

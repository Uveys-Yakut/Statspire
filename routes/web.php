<?php

use App\Http\Controllers\api\StatsCardController;
use App\Http\Controllers\api\TopLangsController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Docs\Index as DocsIndex;

Route::get('/', function () {
    return redirect('/docs');
});

Route::get('/docs/{slug}', DocsIndex::class);

Route::prefix('api')->group(function() {
    Route::prefix('v1')->group(function() {
        Route::get('/top-langs', [TopLangsController::class, 'top_langs']);
        Route::get('/stats-card', [StatsCardController::class, 'stats_card']);
    });
});

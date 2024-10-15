<?php

use App\Http\Controllers\api\StatsCardController;
use App\Http\Controllers\api\TopLangsController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/docs');
});

Route::get('/docs', function () {
    return view('docs.index');
});

Route::prefix('api')->group(function() {
    Route::prefix('v1')->group(function() {
        Route::get('/top-langs', [TopLangsController::class, 'top_langs']);
        Route::get('/stats-card', [StatsCardController::class, 'stats_card']);
    });
});

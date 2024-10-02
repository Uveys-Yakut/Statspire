<?php

use App\Http\Controllers\api\TopLangsController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('api')->group(function() {
    Route::prefix('v1')->group(function() {
        Route::get('/top-langs', [TopLangsController::class, 'top_langs']);
    });
});

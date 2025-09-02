<?php

use App\Http\Controllers\Api\V1\MenuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
    // Route::get('toggle/{menu}', [MenuController::class, 'toggle'])->name('toggle');
    // Route::get('data', [MenuController::class, 'extraData'])->name('data');
});
Route::apiResource('menu', MenuController::class);


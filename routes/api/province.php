<?php

use App\Http\Controllers\Api\V1\ProvinceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'province', 'as' => 'province.'], function () {
    // Route::get('toggle/{province}', [ProvinceController::class, 'toggle'])->name('toggle');
    // Route::get('data', [ProvinceController::class, 'extraData'])->name('data');
});
Route::apiResource('province', ProvinceController::class);


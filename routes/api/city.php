<?php

use App\Http\Controllers\Api\V1\CityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'city', 'as' => 'city.'], function () {
    // Route::get('toggle/{city}', [CityController::class, 'toggle'])->name('toggle');
    // Route::get('data', [CityController::class, 'extraData'])->name('data');
});
Route::apiResource('city', CityController::class);


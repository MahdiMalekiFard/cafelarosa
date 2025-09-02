<?php

use App\Http\Controllers\Api\V1\CountryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'country', 'as' => 'country.'], function () {
    // Route::get('toggle/{country}', [CountryController::class, 'toggle'])->name('toggle');
    // Route::get('data', [CountryController::class, 'extraData'])->name('data');
});
Route::apiResource('country', CountryController::class);


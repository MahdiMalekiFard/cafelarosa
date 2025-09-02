<?php

use App\Http\Controllers\Api\V1\LocalityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'locality', 'as' => 'locality.'], function () {
    // Route::get('toggle/{locality}', [LocalityController::class, 'toggle'])->name('toggle');
    // Route::get('data', [LocalityController::class, 'extraData'])->name('data');
});
Route::apiResource('locality', LocalityController::class);


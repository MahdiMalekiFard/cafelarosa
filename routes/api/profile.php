<?php

use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    // Route::get('toggle/{profile}', [ProfileController::class, 'toggle'])->name('toggle');
    // Route::get('data', [ProfileController::class, 'extraData'])->name('data');
});
Route::apiResource('profile', ProfileController::class);


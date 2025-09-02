<?php

use App\Http\Controllers\Api\V1\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
    // Route::get('toggle/{setting}', [SettingController::class, 'toggle'])->name('toggle');
    // Route::get('data', [SettingController::class, 'extraData'])->name('data');
});
Route::apiResource('setting', SettingController::class);


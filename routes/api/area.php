<?php

use App\Http\Controllers\Api\V1\AreaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'area', 'as' => 'area.'], function () {
    // Route::get('toggle/{area}', [AreaController::class, 'toggle'])->name('toggle');
    // Route::get('data', [AreaController::class, 'extraData'])->name('data');
});
Route::apiResource('area', AreaController::class);


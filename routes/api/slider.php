<?php

use App\Http\Controllers\Api\V1\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'slider', 'as' => 'slider.'], function () {
    // Route::get('toggle/{slider}', [SliderController::class, 'toggle'])->name('toggle');
    // Route::get('data', [SliderController::class, 'extraData'])->name('data');
});
Route::apiResource('slider', SliderController::class);


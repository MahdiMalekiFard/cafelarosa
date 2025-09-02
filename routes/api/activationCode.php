<?php

use App\Http\Controllers\Api\V1\ActivationCodeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'activation-code', 'as' => 'activation-code.'], function () {
    // Route::get('toggle/{activation-code}', [ActivationCodeController::class, 'toggle'])->name('toggle');
    // Route::get('data', [ActivationCodeController::class, 'extraData'])->name('data');
});
Route::apiResource('activation-code', ActivationCodeController::class);


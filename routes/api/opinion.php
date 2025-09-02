<?php

use App\Http\Controllers\Api\V1\OpinionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'opinion', 'as' => 'opinion.'], function () {
    // Route::get('toggle/{opinion}', [OpinionController::class, 'toggle'])->name('toggle');
    // Route::get('data', [OpinionController::class, 'extraData'])->name('data');
});
Route::apiResource('opinion', OpinionController::class);


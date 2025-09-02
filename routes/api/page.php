<?php

use App\Http\Controllers\Api\V1\PageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'page', 'as' => 'page.'], function () {
    // Route::get('toggle/{page}', [PageController::class, 'toggle'])->name('toggle');
    // Route::get('data', [PageController::class, 'extraData'])->name('data');
});
Route::apiResource('page', PageController::class);


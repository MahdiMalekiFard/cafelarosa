<?php

use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    // Route::get('toggle/{category}', [CategoryController::class, 'toggle'])->name('toggle');
    // Route::get('data', [CategoryController::class, 'extraData'])->name('data');
});
Route::apiResource('category', CategoryController::class);


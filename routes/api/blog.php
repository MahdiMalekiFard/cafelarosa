<?php

use App\Http\Controllers\Api\V1\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    // Route::get('toggle/{blog}', [BlogController::class, 'toggle'])->name('toggle');
    // Route::get('data', [BlogController::class, 'extraData'])->name('data');
});
Route::apiResource('blog', BlogController::class);


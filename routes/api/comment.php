<?php

use App\Http\Controllers\Api\V1\CommentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
    // Route::get('toggle/{comment}', [CommentController::class, 'toggle'])->name('toggle');
    // Route::get('data', [CommentController::class, 'extraData'])->name('data');
});
Route::apiResource('comment', CommentController::class);


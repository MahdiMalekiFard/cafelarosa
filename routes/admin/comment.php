<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\CommentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {

});
Route::resource('comment',CommentController::class);

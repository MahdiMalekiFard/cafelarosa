<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('/{blog}/toggle', [BlogController::class, 'toggle'])->name('toggle');
});
Route::resource('blog',BlogController::class);

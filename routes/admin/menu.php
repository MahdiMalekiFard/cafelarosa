<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
    Route::get('/{menu}/toggle', [MenuController::class, 'toggle'])->name('toggle');
});
Route::resource('menu', MenuController::class);

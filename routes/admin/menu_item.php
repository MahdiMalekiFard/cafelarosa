<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\MenuItemController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'menu-item', 'as' => 'menu-item.'], function () {
    Route::get('/{menuItem}/toggle', [MenuItemController::class, 'toggle'])->name('toggle');
});
Route::resource('menu-item',MenuItemController::class);

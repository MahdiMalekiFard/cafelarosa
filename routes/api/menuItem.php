<?php

use App\Http\Controllers\Api\V1\MenuItemController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'menu-item', 'as' => 'menu-item.'], function () {
    // Route::get('toggle/{menu-item}', [MenuItemController::class, 'toggle'])->name('toggle');
    // Route::get('data', [MenuItemController::class, 'extraData'])->name('data');
});
Route::apiResource('menu-item', MenuItemController::class);


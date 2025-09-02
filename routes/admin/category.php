<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {

});
Route::resource('category',CategoryController::class);

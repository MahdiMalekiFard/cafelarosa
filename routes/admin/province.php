<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ProvinceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'province', 'as' => 'province.'], function () {

});
Route::resource('province',ProvinceController::class);

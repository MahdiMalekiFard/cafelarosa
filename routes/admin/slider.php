<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'slider', 'as' => 'slider.'], function () {

});
Route::resource('slider',SliderController::class);

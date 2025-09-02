<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\CityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'city', 'as' => 'city.'], function () {

});
Route::resource('city',CityController::class);

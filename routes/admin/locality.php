<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\LocalityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'locality', 'as' => 'locality.'], function () {

});
Route::resource('locality',LocalityController::class);

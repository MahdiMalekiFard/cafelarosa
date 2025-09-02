<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\CountryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'country', 'as' => 'country.'], function () {

});
Route::resource('country',CountryController::class);

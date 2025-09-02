<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {

});
Route::resource('contact',ContactController::class);

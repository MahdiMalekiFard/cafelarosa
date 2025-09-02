<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'page', 'as' => 'page.'], function () {

});
Route::resource('page',PageController::class);

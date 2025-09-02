<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\AreaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'area', 'as' => 'area.'], function () {

});
Route::resource('area',AreaController::class);

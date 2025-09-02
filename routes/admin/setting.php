<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {

});
Route::resource('setting',SettingController::class);

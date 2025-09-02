<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ActivationCodeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'activation-code', 'as' => 'activation-code.'], function () {

});
Route::resource('activation-code',ActivationCodeController::class);

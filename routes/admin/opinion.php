<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\OpinionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'opinion', 'as' => 'opinion.'], function () {

});
Route::resource('opinion',OpinionController::class);

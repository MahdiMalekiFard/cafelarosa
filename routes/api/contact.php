<?php

use App\Http\Controllers\Api\V1\ContactController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
    // Route::get('toggle/{contact}', [ContactController::class, 'toggle'])->name('toggle');
    // Route::get('data', [ContactController::class, 'extraData'])->name('data');
});
Route::apiResource('contact', ContactController::class);


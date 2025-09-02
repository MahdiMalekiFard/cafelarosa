<?php

use App\Http\Controllers\Api\V1\ArtGalleryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'art-gallery', 'as' => 'art-gallery.'], function () {
    // Route::get('toggle/{art-gallery}', [ArtGalleryController::class, 'toggle'])->name('toggle');
    // Route::get('data', [ArtGalleryController::class, 'extraData'])->name('data');
});
Route::apiResource('art-gallery', ArtGalleryController::class);


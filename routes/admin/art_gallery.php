<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ArtGalleryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'art-gallery', 'as' => 'art-gallery.'], function () {

});
Route::resource('art-gallery',ArtGalleryController::class);

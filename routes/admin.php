<?php

use App\Http\Controllers\Admin\CoreController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SharedDataController;
use App\Livewire\Admin\Shared\TranslationGenerator;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'locale.admin']], function () {
    Route::get('change-locale/{lang}', [CoreController::class, 'changeLocale'])->name('change-locale');

    Route::get('generate-translation/{model}/{id}', TranslationGenerator::class)->name('generate-translation');

    Route::get('static-content',function (){
        return view('admin.pages.static-content.view');
    })->name('static-content');

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::group(['prefix' => 'select', 'as' => 'select.'], function () {
        Route::get('user', [SharedDataController::class, 'dropdownUsers'])->name('user');
        Route::get('category/{type}', [SharedDataController::class, 'dropdownCategory'])->name('category');
        Route::get('country', [SharedDataController::class, 'dropdownCountry'])->name('country');
        Route::get('province', [SharedDataController::class, 'dropdownProvince'])->name('province');
        Route::get('tag', [SharedDataController::class, 'dropdownTag'])->name('tag');
    });

    $files = array_diff(scandir(__DIR__ . '/admin', SCANDIR_SORT_ASCENDING), ['.', '..']);
    foreach ($files as $file_name) {
        require sprintf('admin/%s', $file_name);
    }
});

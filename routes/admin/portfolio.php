<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'portfolio', 'as' => 'portfolio.'], function () {
    Route::get('/{portfolio}/toggle', [PortfolioController::class, 'toggle'])->name('toggle');
});
Route::resource('portfolio', PortfolioController::class);

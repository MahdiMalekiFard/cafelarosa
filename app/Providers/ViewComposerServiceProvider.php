<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /** Register services. */
    public function register(): void {}

    /** Bootstrap services. */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('currentUser', auth()->user());
        });
    }
}

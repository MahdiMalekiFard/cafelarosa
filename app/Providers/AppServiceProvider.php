<?php

namespace App\Providers;

use App\Services\StaticContentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('local')) {
//            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        }

        Paginator::useTailwind();

        // set macro for response
        Response::macro('data', function ($data = null, string $message = '', int $status = 200) {
            return response()->json(compact('message', 'data'), $status);
        });

        Response::macro('error', function (string $message = '', int $status = 400) {
            return response()->json(compact('message'), $status);
        });

        Response::macro('dataWithAdditional', function (AnonymousResourceCollection $data, array $additional = [], string $message = '', int $status = 200) {
            return $data->additional(array_merge(compact('message'), $additional))->response()->setStatusCode($status);
        });
        Blade::directive('conditionalNavigate', function ($expression) {
            return "<?php if (config('livewire.navigate.enable') === true): ?>{$expression}<?php endif; ?>";
        });

        $this->app->singleton('static_content', function () {
            return new StaticContentService();
        });
    }
}

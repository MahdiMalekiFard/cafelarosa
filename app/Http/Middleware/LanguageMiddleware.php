<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1, session('locale',config('app.fallback_locale')));
        $route  = $request->route();
        if (in_array($locale, config('app.supported_locales'), true)) {
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
            session(['locale' => $locale]); // Store the locale in session
            $route?->forgetParameter('locale');
        } elseif ( ! in_array($locale, ['admin', 'api'], true)) {
            $lang = session('locale',config('app.fallback_locale'));
            App::setLocale($lang);
            URL::defaults(['locale' => $lang]);
            $route?->forgetParameter('locale');
            $route?->setParameter('locale', $lang);
            session(['locale' => $lang]); // Store the locale in session

            return redirect($lang . $request->getRequestUri());
        }

        $route?->setParameter('locale', $locale);

        return $next($request);
    }
}

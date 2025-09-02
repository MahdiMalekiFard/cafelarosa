<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale          = $request->segment(1);
        $protectedRoutes = ['admin', 'api', 'livewire', 'docs', 'documents', 'telescope', '_debugbar', 'horizon', 'storage', 'media', 'assets', 'build', 'font', 'storage', 'vendor'];
        if ($locale!==null && ! in_array($locale, config('app.supported_locales'), true) && ! in_array($locale, $protectedRoutes, true)) {
            $lang            = session('locale', session('locale',config('app.fallback_locale')));
            return redirect($lang . $request->getRequestUri());
        }

        //        if (Str::contains($request->getRequestUri(), 'auth')){
        //            $request->route()?->forgetParameter('locale'); // Remove existing locale parameter
        //            $request->route()?->setParameter('locale', $lang); // Set the correct locale
        //        }
        return $next($request);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveSearchTermParamFromRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestData = $request->all();

        if (isset($requestData['search_terms'])) {
            // Remove the key from the request data
            unset($requestData['search_terms']);

            // Set the modified request data back to the original request
            $request->merge($requestData);
        }

        $query = $request->query();

        if (isset($query['search_terms'])) {
            unset($query['search_terms']);
            $request->merge(['search_terms' => null]); // Setting the key to null in case it's being used later in the application

            $queryString = http_build_query($query);
            $request->server->set('QUERY_STRING', $queryString);
            parse_str($queryString, $_GET);
        }

        return $next($request);
    }
}

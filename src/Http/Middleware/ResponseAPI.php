<?php

namespace Thienhungho\Modules\CoreBase\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class ResponseAPI
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        $response->header('Content-Type', 'application/json');

        return $response;
    }
}

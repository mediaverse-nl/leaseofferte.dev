<?php

namespace App\Http\Middleware;

use Closure;

class CalculatorToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->api_token == 'api_xxxx'){
            return $next($request);
        }
        return abort(403);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class Subscribed
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

        if ($request->user() && ! $request->user()->subscribed('main')) {
            // This user is not a paying customer...
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}

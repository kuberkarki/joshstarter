<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Redirect;

class SentinelFreelancer
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
        if (!Sentinel::check()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return Redirect::route('login');
            }
        }
        return $next($request);
    }
}

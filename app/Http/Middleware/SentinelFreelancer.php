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
            return Redirect::route('login');
        }
        if(!Sentinel::inRole('freelancer'))
               ; // return Redirect::route('login');
        return $next($request);
    }
}

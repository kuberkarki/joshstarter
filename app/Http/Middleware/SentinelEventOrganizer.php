<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Redirect;

class SentinelEventOrganizer
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
            //return Redirect::route('login');
            return redirect()->guest('login');

        }
        /*if(!Sentinel::inRole('event-organizer'))
            return redirect()->guest('login')->with('error', 'Not Event organizer');;
*/
                // return Redirect::route('login');
        return $next($request);
    }
}

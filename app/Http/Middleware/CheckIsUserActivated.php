<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsUserActivated
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
        if ( (auth()->user()->activated == false) && config('settings.activation')) {

            return redirect()->route('not-activated');

        }

        return $next($request);
    }
}

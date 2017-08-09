<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsUserSubscribed
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
        if($request->user() and !$request->user()->subscribed('main'))
        {
            return redirect()->route('profileUser')->with('message', 'You are not subscribed!');
        }

        return $next($request);
    }
}

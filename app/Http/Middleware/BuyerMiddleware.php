<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class BuyerMiddleware
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
        $user = Sentinel::getUser();

        if ($user->inRole('buyer'))
            return $next($request);
        else
            return redirect()->route('home');
    }
}

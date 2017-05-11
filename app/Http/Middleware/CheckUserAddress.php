<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class CheckUserAddress
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
        $profile = Sentinel::getUser()->profile;
        if(!$profile->address)
        {
            return redirect()->route('user.address.create');
        }
        return $next($request);
    }
}

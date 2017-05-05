<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class ArtistMiddleware
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

        if ($user->inRole('artist'))
            return $next($request);
        else
            return redirect()->route('user.profile');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfAdmin
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
        if (Auth::user()->isAdmin == 1) {
            return redirect()->route('file.shared');
        } else {
            return redirect()->route('file.units');
        }
        // return $next($request);
    }
}

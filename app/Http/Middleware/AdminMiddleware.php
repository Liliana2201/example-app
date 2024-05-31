<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::check() && (Auth::user()->is_admin || Auth::user()->is_smm || Auth::user()->is_head || Auth::user()->is_house || Auth::user()->is_mentor || Auth::user()->is_fitter)) {
            return $next($request);
        }
        abort(404);
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
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
        if (Auth::check() && Auth::user()->user_role_id == 1) {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->user_role_id != 1) {
            return redirect('/');
        }else {
            return redirect('/login');
        }
        
    }
}

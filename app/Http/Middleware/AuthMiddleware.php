<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthMiddleware
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
        if (! $request->expectsJson()) {
            if (Auth::guard('admin')->guest()) {
                return redirect()->route('admin/login');
            }
            // if(Auth::guard('admin')->check()) {
            //     return redirect()->intended('admin/dashboard');
            // }
        }
        
        return $next($request);
    }
}

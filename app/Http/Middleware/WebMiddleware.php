<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Your middleware logic goes here
        if ($request->user() && $request->user()->role_id == 1) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'You are not authorized to access this page.');
    }
}

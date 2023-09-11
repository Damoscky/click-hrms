<?php

namespace App\Http\Middleware;

use Closure;

class BusinessDevMiddleware
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
        if (!auth()->user()->hasRole('businessdevelopment')) {
            toastr()->error("Access Denied :(");
            return back();
        }
        return $next($request);
    }
}

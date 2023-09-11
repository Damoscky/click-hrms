<?php

namespace App\Http\Middleware;

use Closure;

class RecuritmentMiddleware
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
        if (!auth()->user()->hasRole('recruitment')) {
            toastr()->error("Access Denied :(");
            return back();
        }
        return $next($request);
    }
}

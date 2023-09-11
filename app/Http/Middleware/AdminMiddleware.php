<?php

namespace App\Http\Middleware;

use Closure;

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
        if (!auth()->user()->hasRole(['superadmin', 'admin', 'workforce', 'recruitment', 'businessdevelopment'])) {
            toastr()->error("Access Denied :(");
            return back();
        }
        return $next($request);
    }
}

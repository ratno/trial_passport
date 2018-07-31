<?php

namespace App\Http\Middleware;

use Closure;

class LogAccess
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
        $response = $next($request);

        \Log::info("userid: ".\Auth::user()??\Auth::user()->id);

        return $response;
    }
}

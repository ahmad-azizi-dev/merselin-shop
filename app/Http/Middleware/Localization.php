<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      //  dd(stripos($request->route()->uri(), 'administrator') === 0);
        if (stripos($request->route()->uri(), 'administrator') === 0) {
            App::setLocale('en');
        } else {
            App::setLocale('fa');
        }
        return $next($request);
    }
}

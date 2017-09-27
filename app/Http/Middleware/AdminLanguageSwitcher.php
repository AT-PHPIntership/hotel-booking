<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class AdminLanguageSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request request from url
     * @param \Closure                 $next    next page
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = Cookie::get('admin_locale');
        if ($locale) {
            App::setLocale($request->cookie('admin_locale', $locale));
        }
        
        return $next($request);
    }
}

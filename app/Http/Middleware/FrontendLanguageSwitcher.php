<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class FrontendLanguageSwitcher
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
        $locale = Cookie::get('frontend_locale');
        if ($locale) {
            App::setLocale($request->cookie('frontend_locale', $locale));
        }
        
        return $next($request);
    }
}

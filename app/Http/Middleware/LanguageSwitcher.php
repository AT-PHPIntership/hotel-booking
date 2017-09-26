<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Session\Middleware\StartSession as BaseSession;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher
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
        if (!Cookie::get('locale')) {
            $locale = Config::get('app.locale');
        }

        $locale = $request->cookie('locale', Cookie::get('locale'));
        App::setLocale($locale);

        return $next($request);
    }
}

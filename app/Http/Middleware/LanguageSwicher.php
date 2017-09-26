<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Middleware\StartSession as BaseSession;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageSwicher
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
        if (!Session::has('locale')) {
            Session::put('locale', Config::get('app.locale'));
        }
        app()->setLocale(Session::get('locale'));

        return $next($request);
    }
}

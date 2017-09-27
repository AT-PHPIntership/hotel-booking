<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cookie;
use Illuminate\Support\Facades\App;
use URL;

class LanguageController extends Controller
{
    /**
     * Show language when user choose
     *
     * @param string $language language in website
     *
     * @return void
     */
    public function show($language)
    {
        App::setLocale($language);
        Cookie::queue('admin_locale', $language, config('cookie.lifetime'));

        return redirect(url(URL::previous()));
    }
}

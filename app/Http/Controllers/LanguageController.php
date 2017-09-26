<?php

namespace App\Http\Controllers;

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
    public function show($language = 'en')
    {
        App::setLocale($language);
        Cookie::queue('locale', $language, config('cookie.lifetime'));

        return redirect(url(URL::previous()));
    }
}

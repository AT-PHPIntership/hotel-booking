<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\News;
use App\Model\Place;
use App\Model\Category;
use App\Model\Hotel;
use App\Model\Reservation;

class AdminController extends Controller
{
    /**
     * Return the view index page.
     *
     * @return view
    */
    public function index()
    {
        $users = User::count();
        $news = News::count();
        $places = Place::count();
        $categories = Category::count();
        $hotels = Hotel::count();
        $bookRoom = Reservation::where('status', '=', Reservation::STATUS_ACCEPTED)->count();
        return view('backend.home.index', compact(
            'users',
            'news',
            'places',
            'categories',
            'hotels',
            'bookRoom'
        ));
    }
}

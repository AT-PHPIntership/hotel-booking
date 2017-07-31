<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend/home/index');
});
Route::get('/home', function () {
    return view('frontend/home/index');
});
Route::get('/detailHotel', function () {
    return view('frontend/hotels/hoteldetail');
});

Route::get('/search', function () {    
	return view('frontend/hotels/searchHotel');
});

Route::get('/room', function () {    
	return view('frontend/rooms/roomDetail');
});

Route::get('/booking', function () {    
	return view('frontend/rooms/bookingRoom');
});

Route::get('/user', function () {    
	return view('frontend/users/userProfile');
});

Route::get('/edit', function () {    
	return view('frontend/users/updateProfile');
});

Route::get('/show', function () {    
	return view('frontend/users/showHistoryBookingroom');
});

Route::get('/editHistory', function () {    
	return view('frontend/users/editHistoryBookingroom');
});

Route::get('/login', function () {    
	return view('frontend/users/login');
});

Route::get('/register', function () {    
	return view('frontend/users/register');
});

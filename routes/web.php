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

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/registerSuccess', function() {
    return view('frontend.notice');
})->name('notice')->middleware('auth');
Route::group(['namespace'=>'Admin', 'prefix'=>'admin', 'middleware'=>'adminLogin'], function() {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::resource('/user', 'UserController');
    Route::resource('/place', 'PlaceController');
    Route::resource('/comment', 'RatingCommentController');
    Route::resource('/news', 'NewsController');
    Route::resource('/hotel', 'HotelController');
    Route::group(['prefix'=>'hotel/{hotel}'], function($hotel) {
        Route::resource('/room', 'RoomController');
    });
    Route::resource('/image', 'ImageController', ['only' => ['destroy']]);
    Route::resource('/category', 'CategoryController');
    Route::resource('/feedback', 'FeedbackController');
    Route::resource('/static-page', 'StaticPageController');
    Route::resource('/service', 'ServiceController', ['except' => ['show']]);
    Route::resource('reservation', 'ReservationController', ['except' => ['create','store']]);

    Route::put('/user/{id}/status', 'UserController@updateStatus')->name('user.updateStatus');
    Route::put('/user/{id}/role', 'UserController@updateRole')->name('user.updateRole');
});

Route::group(['namespace'=>'Frontend', 'as' => 'frontend.'], function() {
    Route::resource('/hotel', 'HotelController');
});
Auth::routes();

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
    return view('welcome');
});
Route::group(['namespace'=>'Admin', 'prefix'=>'admin'], function() {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('/user', 'UserController');
    Route::resource('/place', 'PlaceController');
    Route::resource('/comment', 'RatingCommentController');
    Route::resource('/news', 'NewsController');
    Route::resource('/hotel', 'HotelController');
    Route::group(['prefix'=>'hotel/{hotel}'], function($hotel) {
        Route::resource('/room', 'RoomController');
    });
    Route::get('/image/{id}/removeImage', 'RoomController@removeImage')->name('image.removeImage');
    Route::resource('/category', 'CategoryController');
    Route::put('/user/{id}/status', 'UserController@updateStatus')->name('user.updateStatus');
    Route::put('/user/{id}/role', 'UserController@updateRole')->name('user.updateRole');
});
	
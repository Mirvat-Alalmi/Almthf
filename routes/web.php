<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::post('/addSugg', 'SuggController@add');

Route::get('/test', function () {
    return view('test');
});
//Route::get('/hotel', 'HotelController@index');
Route::get('/getRooms/{user_id}/{number_of_adults}/{number_of_children}/{come_date}/{leave_date}', 'HomeController@temp');
//Route::post('/hotel/rooms/{typeId}', 'HotelController@showRooms');
//Route::get('/hotel/rooms/{typeId}', 'HotelController@showRooms');

Route::get('/res', 'ResController@index');
Route::post('/res/check', 'ResController@meels_checked');
Route::get('/res/check', 'ResController@index');


Route::get('/hotel', 'HotelController@index');
Route::get('/hotel/bookroom', 'BookController@index');
Route::post('/hotel/showroom', 'BookController@showRooms');
Route::post('/hotel/bookroom', 'BookController@bookRooms');



Auth::routes();


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


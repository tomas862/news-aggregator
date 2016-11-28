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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');
Route::get('/categories', 'Admin\CategoryController@index')->middleware('auth');
Route::get('/feeds', 'Admin\FeedController@index')->middleware('auth');
Route::get('/change-password', 'Auth\ChangePasswordController@index')->middleware('auth');
Route::get('/addFeed', function() {
    return view('admin/addFeed');
})->middleware('auth');
Route::get('/addCategory', function() {
    return view('admin/addFeedCategory');
})->middleware('auth');

Route::post('/', 'Auth\ChangePasswordController@changePasswordAction');
Route::post('/feeds', 'Admin\FeedController@addFeedAction');
Route::post('/categories', 'Admin\CategoryController@addFeedCategoryAction');

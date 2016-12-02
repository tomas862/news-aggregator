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

Route::get('/', 'FrontController@index');

Auth::routes();

Route::get('/categories', 'Admin\CategoryController@index')->middleware('auth');
Route::get('/feeds', 'Admin\FeedController@index')->middleware('auth');
Route::get('/change-password', 'Auth\ChangePasswordController@index')->middleware('auth');

Route::get('/addFeed/{id?}', 'Admin\FeedController@addFeedView')->middleware('auth');
Route::get('/addCategory/{id?}', 'Admin\CategoryController@addCategoryView')->middleware('auth');

Route::get('/removeCategory/{id}', 'Admin\CategoryController@removeCategoryAction')->middleware('auth');
Route::get('/removeFeed/{id}', 'Admin\FeedController@removeFeedAction')->middleware('auth');

Route::post('/', 'Auth\ChangePasswordController@changePasswordAction');
Route::post('/', 'FrontController@ajaxProcess');
Route::post('/feeds', 'Admin\FeedController@addFeedAction');
Route::post('/categories', 'Admin\CategoryController@addFeedCategoryAction');

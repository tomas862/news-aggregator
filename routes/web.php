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

Route::get('/addFeed/{id?}', function() {

    $categories = App\CategoryModel::pluck('name', 'id')->all();

    return view(
        'admin/addFeed',
        [
            'categories' => $categories
        ]
    );
})->middleware('auth');

Route::get('/addCategory/{id?}', function($id_category = 0) {
    $categoryModel = App\CategoryModel::find($id_category);
    return view(
        'admin/addFeedCategory',
        [
            'id_category' => $id_category,
            'category_name' => ($categoryModel)? $categoryModel->name: null
        ]
    );
})->middleware('auth');

Route::get('/removeCategory/{id}', 'Admin\CategoryController@removeCategoryAction')->middleware('auth');

Route::post('/', 'Auth\ChangePasswordController@changePasswordAction');
Route::post('/feeds', 'Admin\FeedController@addFeedAction');
Route::post('/categories', 'Admin\CategoryController@addFeedCategoryAction');

<?php
/**
 * Created by PhpStorm.
 * User: zjl
 * Date: 18-9-29
 * Time: 下午5:15
 */

Route::get('/', 'IndexController@index');
Route::post('/signup', 'UsersController@create')->name('signup');
Route::post('/login', 'UsersController@login');
Route::get('/logins', 'UsersController@creates');
Route::post('/categoryAdd', 'CategoriesController@create');
Route::get('/categoryList', 'CategoriesController@index');
Route::post('/categoryListSx', 'CategoriesController@lists');
Route::post('/categorySave', 'CategoriesController@update');
Route::post('/categoryDel', 'CategoriesController@destroy');
Route::post('/categoryDelAll', 'CategoriesController@destroyAll');
Route::post('/articleList', 'ArticlesController@index');
Route::post('/articleAdd', 'ArticlesController@create');
Route::post('/articleDel', 'ArticlesController@destroy');

Route::middleware('auth:admin')->get('/user', function (\Illuminate\Http\Request $request) {
    echo $request->user();
});
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', 'IndexController@articles');
Route::get('/articles/', 'IndexController@articles');
Route::post('/addWebvolume', 'IndexController@addView');
Route::get('/tags', 'TagsController@index');
Route::get('/tagsArticles/{cateId}', 'TagsController@articles');
Route::get('/viewPeople', 'IndexController@viewPeople');
Route::post('/readNum', 'ArticleController@readNum');
Route::get('/details/{postId}', 'ArticleController@details');



Route::get('/learn', 'LearnluaController@learn');
Route::get('/learnget', 'LearnluaController@learnget');
Route::get('/learnpost', 'LearnluaController@learnpost');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

Route::get('/sns', 'PostController@getHomePost');

Route::get('/like', 'LikeController@like');
Route::post('/like', 'LikeController@like');

Route::post('/bookmark', 'BookmarkController@bookmark');

Route::get('/mypage/{type}', 'UserController@getMypage');

Route::post('/update', 'UserController@updateUser');

Route::get('/user/{id}', 'UserController@getUserPage');

Route::post('/follow', 'FollowController@follow');

Route::get('/search/{type?}', 'PostController@getSearchPost');

Route::get('/notification', 'NotificationController@getNotification');

Route::get('/message', function () {
    return view('main.message');
});

Route::post('/post', 'PostController@post');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

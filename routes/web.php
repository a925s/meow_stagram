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

Route::get('/mypage/post', 'UserController@getMypagePost');

Route::get('/mypage/bookmark', 'UserController@getMypageBookmark');

Route::post('/update', 'UserController@updateUser');

Route::get('/user', function () {
    return view('main.user');
});

Route::get('/search', 'PostController@getSearchPost');

Route::get('/search/rank', 'PostController@getSearchRankPost');

Route::get('/search/new', 'PostController@getSearchNewPost');

Route::get('/search/video', 'PostController@getSearchVideoPost');

Route::get('/notification', function () {
    return view('main.notification');
});

Route::get('/message', function () {
    return view('main.message');
});

Route::post('/post', 'PostController@post');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

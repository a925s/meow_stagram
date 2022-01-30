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

Route::get('/home', 'PostController@getHomePost');

Route::get('/mypage/post', function () {
    return view('main.mypage_post');
});

Route::get('/mypage/bookmark', function () {
    return view('main.mypage_bookmark');
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
Auth::routes();

Route::get('/signin', 'HomeController@index')->name('home');

Route::post('/post', 'PostController@post');

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

Route::get('/home', function () {
    return view('main.home');
});

Route::get('/mypage', function () {
    return view('main.mypage');
});

Route::get('/search', function () {
    return view('main.search');
});

Route::get('/search/rank', function () {
    return view('main.search_rank');
});

Route::get('/search/new', function () {
    return view('main.search_new');
});

Route::get('/search/video', function () {
    return view('main.search_video');
});

Route::get('/message', function () {
    return view('main.message');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

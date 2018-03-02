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

Auth::routes();

Route::get('/home', 'ObservationController@index')->name('home');
Route::get('/profile/{user}', 'ProfileController@show')->name('profile');
Route::resource('upload', 'UploadController', ['only' => ['store', 'destroy']]);

Route::resource('observation', 'ObservationController');
Route::resource('comment', 'CommentController', ['only' => ['store']]);

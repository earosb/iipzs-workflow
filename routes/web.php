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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::redirect('/', '/home', 301);
    Route::get('/home', 'IssueController@index')->name('home');
    Route::get('/profile/{user}', 'ProfileController@show')->name('profile');
    Route::resource('upload', 'UploadController', ['only' => ['store', 'destroy']]);

    Route::resource('issue', 'IssueController');
    Route::resource('issue/{issue}/comment', 'CommentController', ['only' => ['store']]);
    Route::resource('type', 'TypeController');
    Route::post('issue/{issue}/toggle-subscription', 'ToggleSubscriptionController')->name('toggle-subscription');

    Route::resource('user', 'UserController', ['only' => ['index', 'create', 'store', 'destroy']]);
});
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

// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}', 'InviteController@accept')->name('accept');
Route::post('register/{token}', 'InviteController@register')->name('register');

Route::group(['middleware' => ['auth']], function () {
    Route::redirect('/', 'home', 301);
    Route::get('home', 'HomeController')->name('home');

    Route::get('/profile', 'ProfileController@show')->name('profile');
    Route::get('/profile/edit/password', 'ProfileController@editPassword')->name('profile.password');
    Route::post('/profile/edit/password', 'ProfileController@updatePassword')->name('profile.update-password');

    Route::resource('upload', 'UploadController', ['only' => ['store', 'destroy']]);

    Route::resource('issue', 'IssueController');
    Route::resource('issue/{issue}/comment', 'CommentController', ['only' => ['store']]);
    Route::resource('type', 'TypeController');
    Route::post('issue/{issue}/toggle-subscription', 'ToggleSubscriptionController')->name('toggle-subscription');

    Route::resource('user', 'UserController', ['only' => ['index']]);
    Route::get('invite', 'InviteController@invite')->name('invite');
    Route::post('invite', 'InviteController@process')->name('process');
});
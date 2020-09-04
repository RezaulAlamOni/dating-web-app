<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/all-users', 'HomeController@viewAllUser')->name('all-user-view');
Route::post('/upload-profile', 'HomeController@uploadProfile')->name('upload-profile');



// for get all user
Route::get('/get-all-users', 'HomeController@allUser')->name('all.user');
Route::post('/like-user', 'LikeUsersController@createLike')->name('like.user');
Route::post('/dislike-user', 'LikeUsersController@createDislike')->name('dislike.user');

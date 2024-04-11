<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth.success'], function () {
    Route::get('/', function () {
        return view('index');
    })->name('get_login');
});

Route::post('login', 'App\Http\Controllers\UserController@postLogin')->name('login');
Route::get('logout', 'App\Http\Controllers\UserController@getLogout')->name('logout');

Route::group(['middleware' => 'auth.false'], function () {
    Route::get('/member', 'App\Http\Controllers\UserController@getCheckStatus')->name('member');
    Route::get('/review', 'App\Http\Controllers\UserController@getCheckStatus')->name('review');
});
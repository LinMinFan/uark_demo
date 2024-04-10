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

Route::get('/', function () {
    return view('index');
})->middleware(['auth.success'])->name('login');

Route::get('/member', function () {
    return view('member');
})->middleware(['auth.false'])->name('member');

Route::get('/review', function () {
    return view('account_review');
})->middleware(['auth.false'])->name('review');

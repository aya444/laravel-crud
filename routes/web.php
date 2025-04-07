<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/login', 'showLogin')->name('show.login');

    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::resource('products', ProductController::class)->middleware('auth');

Route::resource('categories', CategoryController::class)->middleware('auth');

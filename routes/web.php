<?php

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RedirectIfAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(RedirectIfAuthMiddleware::class)->group(function () {
    Route::get('login', fn() => view('auth.login'))->name('login');
    Route::get('register', fn() => view('auth.register'))->name('register');
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('home', fn() => view('homepage'));
    Route::get('topup', fn() => view('topup'));
    Route::get('service', fn() => view('service'));
    Route::get('history', fn() => view('transaction'));
    Route::get('profile', fn() => view('profile'));
});

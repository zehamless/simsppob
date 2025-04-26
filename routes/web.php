<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RedirectIfAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(RedirectIfAuthMiddleware::class)->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login');
    Route::get('register', [AuthController::class, 'registerView'])->name('register');
    Route::post('register', [AuthController::class, 'registerUser'])->name('register.post');
    Route::post('login', [AuthController::class, 'newSession'])->name('login.post');
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('home', \App\Http\Controllers\HomeController::class)->name('home');
    Route::get('topup', fn() => view('topup'));
    Route::get('service', fn() => view('service'));
    Route::get('history', fn() => view('transaction'));
    Route::get('profile', fn() => view('profile'));
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RedirectIfAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(RedirectIfAuthMiddleware::class)->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login');
    Route::get('register', [AuthController::class, 'registerView'])->name('register');
    Route::post('register', [AuthController::class, 'registerUser'])->name('register.post');
    Route::post('login', [AuthController::class, 'newSession'])->name('login.post');
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
    Route::get('topup', [\App\Http\Controllers\TopupController::class, 'index'])->name('topup');
    Route::post('topup', [\App\Http\Controllers\TopupController::class, 'topup'])->name('topup.post');
    Route::get('service/detail/{servideCode}', [\App\Http\Controllers\PayServiceController::class, 'index'])->name('service');
    Route::post('service', [\App\Http\Controllers\PayServiceController::class, 'payService'])->name('service.post');
    Route::get('history', [\App\Http\Controllers\TransactionHistoryController::class, 'index'])->name('history');
    Route::get('history/get', [\App\Http\Controllers\TransactionHistoryController::class, 'getTransactions'])->name('history.get');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.post');
    Route::post('logout', [AuthController::class, 'destroySession'])->name('logout');
    Route::post('profile/image', [\App\Http\Controllers\ProfileController::class, 'updateImage'])->name('profile.image');
});

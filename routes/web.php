<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\TransactionHistoryController;
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
    Route::get('/', HomeController::class)->name('home');
    Route::get('topup', [TopupController::class, 'index'])->name('topup');
    Route::post('topup', [TopupController::class, 'topup'])->name('topup.post');
    Route::get('service/detail/{servideCode}', [PayServiceController::class, 'index'])->name('service');
    Route::post('service', [PayServiceController::class, 'payService'])->name('service.post');
    Route::get('history', [TransactionHistoryController::class, 'index'])->name('history');
    Route::get('history/get', [TransactionHistoryController::class, 'getTransactions'])->name('history.get');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.post');
    Route::post('logout', [AuthController::class, 'destroySession'])->name('logout');
    Route::post('profile/image', [ProfileController::class, 'updateImage'])->name('profile.image');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->prefix('auth')->controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/login', 'login')->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(PolicyController::class)->group(function () {
        Route::get('/bookmark', 'bookmarks')->name('policies.bookmarks');
        Route::get('/aktivitas', 'activities')->name('user.activities');
        Route::get('/kebijakan', 'index')->name('policies.index');
        Route::get('/kebijakan/{policy:slug}', 'show')->name('policies.show');
        Route::post('/kebijakan/{policy}/interact', 'interact')->name('policies.interact');
        Route::post('/kebijakan/{policy}/comment', 'storeComment')->name('policies.comment');
        Route::post('/comments/{comment}/interact', 'interactComment')->name('comments.interact');
    });
});

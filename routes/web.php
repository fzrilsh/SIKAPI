<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::get('/kebijakan', [PolicyController::class, 'index'])->name('policies.index');
    Route::get('/kebijakan/{policy:slug}', [PolicyController::class, 'show'])->name('policies.show');

    Route::post('/kebijakan/{policy}/comment', [PolicyController::class, 'storeComment'])->name('policies.comment');
    Route::post('/comments/{comment}/interact', [PolicyController::class, 'interactComment'])
        ->name('comments.interact');

    Route::post('/kebijakan/{policy}/interact', [PolicyController::class, 'interact'])
        ->name('policies.interact');
});

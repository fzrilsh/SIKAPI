<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/kebijakan', function () {
    return view('pages.kebijakan');
});

Route::get('/kebijakan/ruu-kesehatan', function () {
    return view('pages.detail-kebijakan');
});


Route::get('/register', function () {
    return view('pages.auth');
})->name('register');

Route::get('/login', function () {
    return view('pages.auth');
})->name('login');

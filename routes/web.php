<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crud', function () {
    return view('crud');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


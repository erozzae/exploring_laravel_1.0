<?php

use App\Http\Controllers\CRUDController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::controller(CRUDController::class)->prefix('/crud')->group(function () {
    Route::get('/', 'index')->name('crud.index');
    Route::post('/store', 'store')->name('crud.store');
});

Route::controller(GalleryController::class)->prefix('/gallery')->group(function () {
    Route::get('/', 'index')->name('gallery.index');
    Route::post('/store', 'store')->name('gallery.store');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


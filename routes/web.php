<?php

use App\Http\Controllers\CRUDController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::controller(CRUDController::class)->prefix('/crud')->group(function () {
    Route::get('/', 'index')->name('crud.index');
    Route::post('/store', 'store')->name('crud.store');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


<?php

use Illuminate\Support\Facades\Route;

Route::post('/register', 'App\Http\Controllers\AuthApiCT@daftar');
Route::post('/login', 'App\Http\Controllers\AuthApiCT@masuk');

Route::middleware(['khususUser:admin'])->group(function () {
    Route::get('/categories', 'App\Http\Controllers\CategoryApiCT@ambil_semua');
    Route::post('/categories', 'App\Http\Controllers\CategoryApiCT@tambah');

    Route::get('/categories/{id}', 'App\Http\Controllers\CategoryApiCT@ambil');
    Route::delete('/categories/{id}', 'App\Http\Controllers\CategoryApiCT@hapus');
    Route::put('/categories/{id}', 'App\Http\Controllers\CategoryApiCT@ubah');
});

Route::middleware(['khususUser:admin,user'])->group(function () {
    Route::get('/products', 'App\Http\Controllers\ProductApiCT@ambil_semua');
    Route::post('/products', 'App\Http\Controllers\ProductApiCT@tambah');

    Route::delete('/products/{id}', 'App\Http\Controllers\ProductApiCT@hapuss');
    Route::put('/products/{id}', 'App\Http\Controllers\ProductApiCT@ubah');
    Route::get('/products/{id}', 'App\Http\Controllers\ProductApiCT@ambil');
});

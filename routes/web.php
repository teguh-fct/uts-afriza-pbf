<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return response()->view('welcome');
});

Route::get('/api/oauth/callback', 'App\Http\Controllers\AuthCT@oauth_panggilan_balik');
Route::get('/api/oauth/register', 'App\Http\Controllers\AuthCT@oauth_alihkan');

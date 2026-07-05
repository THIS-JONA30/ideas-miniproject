<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/login', [SessionsController::class, 'store']);
});

Route::middleware('auth')->group(function() {
    Route::delete('logout', [SessionsController::class, 'destroy']);
});
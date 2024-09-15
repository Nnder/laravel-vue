<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function(){
	Route::get('/login', [WebController::class, 'login'])->name('login');
	Route::get('/register', [WebController::class, 'register'])->name('register');
});

Route::middleware('auth:sanctum')->group(function(){
	Route::get('/', [WebController::class, 'home'])->name('home');
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});

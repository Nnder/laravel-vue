<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function(){
	Route::post('/login', [UserController::class, 'login'])->name('user.login');
	Route::post('/register', [UserController::class, 'register'])->name('user.register');
});

Route::middleware('auth:sanctum')->group(function(){
	Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});

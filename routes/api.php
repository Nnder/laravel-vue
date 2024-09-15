<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('guest')->group(function(){
	Route::post('/login', [UserController::class, 'login'])->name('user.login');
	Route::post('/register', [UserController::class, 'register'])->name('user.register');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
	Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});

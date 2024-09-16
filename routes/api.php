<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VueApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('guest')->group(function(){
	Route::post('/login', [UserController::class, 'login'])->name('user.login');
	Route::post('/register', [UserController::class, 'register'])->name('user.register');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
	Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('/user/avatar', [UserController::class, 'uploadAvatar'])->name('user.avatar.upload');
});


// VUE API
Route::middleware('guest')->group(function(){
	Route::post('/vue/login', [VueApiController::class, 'login'])->name('vue.user.login');
	Route::post('/vue/register', [VueApiController::class, 'register'])->name('vue.user.register');
    Route::post('/vue/logout', [VueApiController::class, 'logout'])->name('vue.user.logout');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/vue/avatar', [VueApiController::class, 'uploadAvatar'])->name('vue.user.avatar.upload');
    Route::get('/vue/user', [VueApiController::class, 'getUser'])->name('vue.user');
});


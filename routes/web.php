<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class,'index'])->name('home');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::middleware([ValidUser::class])->group(function () {
    Route::get('/register',[AuthController::class,'showRegister'])->name('show_register');
    Route::post('/register', [AuthController::class,'register'])->name('register');
    Route::get('/login', [AuthController::class,'showLogin'])->name('show_login');
    Route::post('/login', [AuthController::class,'login'])->name('login');
    route::get('/profile', [AuthController::class,'profile'])->name('profile');
});



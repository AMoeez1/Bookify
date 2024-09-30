<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register',[AuthController::class,'showRegister'])->name('register_form');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/login', [AuthController::class,'showLogin'])->name('show_login');
Route::post('/login', [AuthController::class,'login'])->name('login');
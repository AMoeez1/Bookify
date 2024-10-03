<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class,'index'])->name('home');

Route::get('/book/{slug}', [BookController::class, 'showBooks'])->name('showBook');
Route::get('/book/{slug}/download', [BookController::class, 'download'])->name('downloadBook');
Route::get('/book/{slug}/read', [BookController::class, 'read'])->name('readBook');
Route::middleware([ValidUser::class])->group(function () {
    Route::get('/register',[AuthController::class,'showRegister'])->name('show_register');
    Route::post('/register', [AuthController::class,'register'])->name('register');
    Route::get('/login', [AuthController::class,'showLogin'])->name('show_login');
    Route::post('/login', [AuthController::class,'login'])->name('login');
    route::get('/profile', [AuthController::class,'profile'])->name('profile');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::post('/edit/profile', [AuthController::class,'edit_profile'])->name('edit_profile');
    Route::get('/remove/profile', [AuthController::class,'remove_profile'])->name('remove_profile');
    Route::post('/add/book',[BookController::class,'addBook'])->name('add_book');
});



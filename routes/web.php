<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\BooksMiddleware;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class,'index'])->name('home');
Route::get('/book/{slug}', [BookController::class, 'read'])->name('readBook');
Route::get('/user/{id}', [AuthController::class, 'allUser'])->name('all_user');
Route::get('/books',[BookController::class,'allBooks'])->name('all_books');
Route::get('/search/books', [BookController::class,'filterSearch'])->name('filter_search');
Route::get('/author',[AuthController::class,'author']);


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
    Route::post('/send/mail',[AuthController::class, 'sendMail'])->name('send_mail');
    Route::get('/author/verify', [AuthController::class, 'verifyAuthor'])->name('author_verify');
});


Route::middleware([BooksMiddleware::class])->group(function () {
    Route::get('/book/edit/{slug}', [BookController::class,'showEdit'])->name('show_edit');
    Route::post('/book/edit/{slug}',[BookController::class, 'editBook'])->name('edit_book');
});


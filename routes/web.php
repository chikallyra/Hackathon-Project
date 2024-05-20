<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('main', ["title" => "Login"]);
})->name('index');

// Rute untuk halaman registrasi biasa
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Rute untuk proses login biasa
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rute untuk login dengan Google
Route::get('login/google/redirect', [SocialiteController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect');

Route::get('login/google/callback', [SocialiteController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [SocialiteController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/create', [BlogController::class, 'store'])->name('blog.store');

    Route::get('/blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{blog}/edit', [BlogController::class, 'update'])->name('blog.update');

    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::delete('/blog/{blog}/destroy', [BlogController::class, 'destroy'])->name('blog.destroy');

    // comment
    Route::post('/comment/create', [CommentController::class, 'store'])->name('comment.store');

});


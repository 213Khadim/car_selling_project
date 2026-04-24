<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ContactController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cars', [CarsController::class, 'index'])->name('cars');
Route::get('/cars/{car}', [CarsController::class, 'show'])->name('car-detail');
Route::get('/brands', [CarsController::class, 'brands'])->name('brands');
Route::get('/posts', [ContactController::class, 'posts'])->name('posts');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Guest Routes (Login/Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/admin/login', fn () => view('admin.login'))->name('admin.login');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Import Separate Route Files
require __DIR__.'/user.php';
require __DIR__.'/admin.php';

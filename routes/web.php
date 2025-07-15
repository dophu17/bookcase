<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;

// Language switching route
Route::get('/language/{locale}', [LanguageController::class, 'changeLocale'])->name('language.switch');

Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    Route::resource('books', App\Http\Controllers\BookController::class);
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [AuthController::class, 'showSettings'])->name('settings');
    Route::post('/settings', [AuthController::class, 'updateSettings'])->name('settings.update');
    Route::post('/analyze-book-image', [App\Http\Controllers\BookController::class, 'analyzeBookImage'])->name('analyze-book-image');
});

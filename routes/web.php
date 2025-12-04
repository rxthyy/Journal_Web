<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Custom authentication routes
Route::group([], function () {
    Route::get('/custom-register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/custom-register', [RegisterController::class, 'store'])->name('register');
    
    Route::get('/custom-login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/custom-login', [LoginController::class, 'authenticate'])->name('login');
});


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Calendar
    Route::get('/calendar', function () {
        return view('calendar');
    })->name('calendar');
    
    // Entry routes
    Route::get('/calendar/entries/{date}', [EntryController::class, 'getByDate'])
    ->middleware('auth');
    Route::get('/calendar/entries-month', [EntryController::class, 'getEntriesByMonth'])
    ->middleware('auth');
    
    
    Route::get('/entry/create', [EntryController::class, 'create'])->name('entry.create');
    Route::post('/entry/store', [EntryController::class, 'store'])->name('entry.store');
    Route::get('/entry/view/{id}', [EntryController::class, 'show'])->name('entry.view');
    // Route::get('/api/entries/month', [EntryController::class, 'getEntriesByMonth'])->name('entries.month');
    
    // Discover
    Route::get('/discover', function () {
        return view('discover');
    })->name('discover');
    
    // Profile
    Route::get('/view/profile', function () {
        return view('profile');
    })->name('view.profile');
});

// Laravel Breeze profile routes (if using Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function () {
    // Handle password reset logic here
})->name('password.email');

require __DIR__.'/auth.php';
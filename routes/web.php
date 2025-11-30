<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/custom-login', function () {
    return view('login'); // resources/views/login.blade.php
});

Route::get('/custom-register', function () {
    return view('register'); // resources/views/login.blade.php
});

Route::get('/calendar', function () {
    return view('calendar'); // resources/views/login.blade.php
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

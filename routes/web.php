<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/students/import', [\App\Http\Controllers\StudentImportController::class, 'show'])->name('students.import.form');
    Route::post('/students/import', [\App\Http\Controllers\StudentImportController::class, 'upload'])->name('students.import');
});

// public registration
Route::get('/students/register', [\App\Http\Controllers\StudentRegistrationController::class, 'show'])->name('students.register.form');
Route::post('/students/register', [\App\Http\Controllers\StudentRegistrationController::class, 'register'])->name('students.register');

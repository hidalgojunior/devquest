<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/students/import', [\App\Http\Controllers\StudentImportController::class, 'show'])->name('students.import.form');
    Route::post('/students/import', [\App\Http\Controllers\StudentImportController::class, 'upload'])->name('students.import');

    Route::get('/presences', [\App\Http\Controllers\PresenceController::class,'index'])->name('presences.index');
    Route::post('/presences', [\App\Http\Controllers\PresenceController::class,'store'])->name('presences.store');

    Route::resource('activities', \App\Http\Controllers\ActivityController::class);

    Route::resource('configurations', \App\Http\Controllers\ConfigurationController::class)->only(['index','edit','update']);
    Route::get('/submissions/{submission}', [\App\Http\Controllers\SubmissionController::class,'show'])->name('submissions.show');
});

// public registration
Route::get('/students/register', [\App\Http\Controllers\StudentRegistrationController::class, 'show'])->name('students.register.form');
Route::post('/students/register', [\App\Http\Controllers\StudentRegistrationController::class, 'register'])->name('students.register');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AlumniController as AdminAlumniController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');
Route::get('/register', [AlumniController::class, 'create'])->name('alumni.create');
Route::post('/register', [AlumniController::class, 'store'])->name('alumni.store');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminAlumniController::class, 'dashboard'])->name('dashboard');
    Route::resource('alumni', AdminAlumniController::class);
});

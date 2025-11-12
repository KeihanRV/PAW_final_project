<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route yang hanya bisa diakses oleh Admin
// Harus melewati middleware 'auth' (sudah login) dan 'admin' (role admin)
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {

    // Route Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('admin.dashboard');

    // ...
});

require __DIR__.'/auth.php';

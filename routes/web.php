<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Middleware\AdminMiddleware;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostcardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\JournalController;

Route::get('/', function () {
    return view('home');
});

// Route Darurat - Reset Password
// Route::get('/reset-password-darurat', function () {
//     $user = User::where('email', 'hansharvey33@gmail.com')->first();
//     if (!$user) return 'User tidak ditemukan!';
//     $user->password = Hash::make('Harvey.33');
//     $user->save();
//     return 'BERHASIL! Password untuk hansharvey33@gmail.com sudah diubah menjadi: Harvey.33';
// });

Route::middleware(['auth', 'verified'])->group(function () {

    // Journal Routes
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
    Route::delete('/journal/{journal}', [JournalController::class, 'destroy'])->name('journal.destroy');
    Route::put('/journal/{journal}', [JournalController::class, 'update'])->name('journal.update');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

    Route::get('/user/About Us', function () {
        return view('user/about');
    })->name('about');

    Route::get('/dashboard', function () {
        $postcards = \App\Models\Postcard::latest()->get();
        return view('dashboard', compact('postcards'));
    })->name('dashboard');

    Route::get('/postcard/{postcard}', [PostcardController::class, 'show'])->name('postcard.show');

    Route::get('/cek-php', function () {
        return [
            'File Config yang Dipakai' => php_ini_loaded_file(),
            'Upload Max' => ini_get('upload_max_filesize'),
            'Post Max' => ini_get('post_max_size'),
        ];
    });
});

// Route Admin
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [PostcardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::post('/postcard', [PostcardController::class, 'store'])->name('admin.postcard.store');
    Route::put('/postcard/{postcard}', [PostcardController::class, 'update'])->name('admin.postcard.update');
    Route::delete('/postcard/{postcard}', [PostcardController::class, 'destroy'])->name('admin.postcard.destroy');
});

require __DIR__.'/auth.php';
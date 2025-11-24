<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostcardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('home');
});

Route::get('/reset-password-darurat', function () {
    // 1. Cari user kamu
    $user = User::where('email', 'hansharvey33@gmail.com')->first();
    
    if (!$user) {
        return 'User tidak ditemukan!';
    }

    // 2. Set password baru (langsung Hash::make di sini biar aman)
    $user->password = Hash::make('Harvey.33');
    $user->save();

    return 'BERHASIL! Password untuk hansharvey33@gmail.com sudah diubah menjadi: Harvey.33';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/journal', function () {
        return view('user/soon');
    })->name('journal');
    Route::get('/user/About Us', function () {
        return view('user/about');
    })->name('about');

    Route::get('/dashboard', function () {
        $postcards = \App\Models\Postcard::latest()->get();
        return view('dashboard', compact('postcards'));
    })->name('dashboard');

    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

    Route::get('/postcard/{postcard}', [PostcardController::class, 'show'])->name('postcard.show');

    Route::get('/cek-php', function () {
        return [
            'File Config yang Dipakai' => php_ini_loaded_file(),
            'Upload Max' => ini_get('upload_max_filesize'),
            'Post Max' => ini_get('post_max_size'),
        ];
    });
});

// Route yang hanya bisa diakses oleh Admin
// Harus melewati middleware 'auth' (sudah login) dan 'admin' (role admin)
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {

    // Route Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('admin.dashboard');

    // 1. Dashboard Admin (Tampilan Utama)
    Route::get('/dashboard', [PostcardController::class, 'adminIndex'])->name('admin.dashboard');

    // 2. Proses CRUD
    Route::post('/postcard', [PostcardController::class, 'store'])->name('admin.postcard.store');
    Route::put('/postcard/{postcard}', [PostcardController::class, 'update'])->name('admin.postcard.update'); // Untuk Edit
    Route::delete('/postcard/{postcard}', [PostcardController::class, 'destroy'])->name('admin.postcard.destroy'); // Untuk Hapus
});

require __DIR__.'/auth.php';

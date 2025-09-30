<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    // Middleware akan berjalan sebelum closure ini, jadi isinya tidak terlalu penting
    // karena pengguna akan selalu diarahkan ulang.
})->middleware(['auth', 'verified', 'role.redirect'])->name('dashboard');

Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Contoh rute untuk dashboard admin
    Route::get('/dashboard', function() {
        return '<h1>Selamat Datang di Dashboard Admin</h1>'; // Ganti dengan view nanti
    })->name('dashboard');

    // Tambahkan rute admin lainnya di sini...
    // Contoh: Route::get('/products', ...)->name('products.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

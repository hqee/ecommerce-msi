<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
})->middleware(['auth', 'verified', 'role.redirect'])->name('dashboard');

Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products/{product:slug}', [FrontendProductController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Entrepreneur\DashboardController as EntrepreneurDashboardController;
use App\Http\Controllers\Entrepreneur\StandController;
use App\Http\Controllers\Entrepreneur\ProductController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/stands', [HomeController::class, 'stands'])->name('stands.index');
Route::get('/stands/{stand}', [HomeController::class, 'showStand'])->name('stands.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');
// Auth routes
require __DIR__.'/auth.php';

// routes pour l'authenitification
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

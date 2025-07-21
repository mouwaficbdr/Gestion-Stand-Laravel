<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\StandController;

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/stands', [StandController::class, 'index'])->name('stands.index');
// Routes d'authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes administrateur
Route::middleware(['auth', App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/demandes', [AdminController::class, 'demandes'])->name('admin.demandes');
    Route::post('/demandes/{id}/approuver', [AdminController::class, 'approuverDemande'])->name('admin.approuver');
    Route::delete('/demandes/{id}/rejeter', [AdminController::class, 'rejeterDemande'])->name('admin.rejeter');
    Route::get('/stands', [AdminController::class, 'stands'])->name('admin.stands');
});

// Routes entrepreneur approuvé
Route::middleware(['auth', App\Http\Middleware\ApprovedEntrepreneurMiddleware::class])->prefix('entrepreneur')->group(function () {
    Route::get('/dashboard', [EntrepreneurController::class, 'dashboard'])->name('entrepreneur.dashboard');
});

// Route entrepreneur en attente
Route::middleware(['auth', App\Http\Middleware\PendingMiddleware::class])->group(function () {
    Route::get('/entrepreneur/pending', [EntrepreneurController::class, 'pending'])->name('entrepreneur.pending');
});

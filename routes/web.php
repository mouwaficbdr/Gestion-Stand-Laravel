<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\StandController;

// =========================
// Routes publiques
// =========================
// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');
// Liste des stands accessibles à tous
Route::get('/stands', [StandController::class, 'index'])->name('stands.index');

// =========================
// Routes d'authentification
// =========================
// Connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Inscription
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// =========================
// Routes administrateur (protégées par le middleware Admin)
// =========================
Route::middleware(['auth', App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Liste des demandes de stands
    Route::get('/demandes', [AdminController::class, 'demandes'])->name('admin.demandes');
    // Approuver une demande
    Route::post('/demandes/{id}/approuver', [AdminController::class, 'approuverDemande'])->name('admin.approuver');
    // Rejeter une demande
    Route::delete('/demandes/{id}/rejeter', [AdminController::class, 'rejeterDemande'])->name('admin.rejeter');
    // Liste des stands
    Route::get('/stands', [AdminController::class, 'stands'])->name('admin.stands');
});

// =========================
// Routes entrepreneur approuvé (protégées par le middleware ApprovedEntrepreneur)
// =========================
Route::middleware(['auth', App\Http\Middleware\ApprovedEntrepreneurMiddleware::class])->prefix('entrepreneur')->group(function () {
    // Dashboard entrepreneur approuvé
    Route::get('/dashboard', [EntrepreneurController::class, 'dashboard'])->name('entrepreneur.dashboard');
});

// =========================
// Route entrepreneur en attente (protégée par le middleware Pending)
// =========================
Route::middleware(['auth', App\Http\Middleware\PendingMiddleware::class])->group(function () {
    // Page d'attente pour entrepreneur en attente
    Route::get('/entrepreneur/pending', [EntrepreneurController::class, 'pending'])->name('entrepreneur.pending');
});

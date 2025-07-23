<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StandPublicController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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
    Route::patch('/stands/{id}/retirer', [AdminController::class, 'retirerApprobation'])->name('admin.retirer');
    Route::get('/stands', [AdminController::class, 'stands'])->name('admin.stands');
});

// Routes entrepreneur approuvé
Route::middleware(['auth', App\Http\Middleware\ApprovedEntrepreneurMiddleware::class])->prefix('entrepreneur')->group(function () {
    Route::get('/dashboard', [EntrepreneurController::class, 'dashboard'])->name('entrepreneur.dashboard');
    Route::resource('products', ProductController::class, [
        'as' => 'entrepreneur'
    ]);
});

// Route entrepreneur en attente
Route::middleware(['auth', App\Http\Middleware\PendingMiddleware::class])->group(function () {
    Route::get('/entrepreneur/pending', [EntrepreneurController::class, 'pending'])->name('entrepreneur.pending');
});

// Vitrine publique
Route::get('/exposants', [StandPublicController::class, 'index'])->name('stands.public.index');
Route::get('/exposants/{id}', [StandPublicController::class, 'show'])->name('stands.public.show');

// Panier
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/modifier/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/panier/supprimer/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

// Commande
Route::get('/commande/{standId}', [OrderController::class, 'create'])->name('order.create');
Route::post('/commande/{standId}', [OrderController::class, 'store'])->middleware('throttle:5,1')->name('order.store');
Route::get('/commande/confirmation/{orderNumber}', [OrderController::class, 'confirmation'])->name('order.confirmation');

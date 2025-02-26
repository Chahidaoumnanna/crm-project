<?php

use App\Http\Controllers\Api\BonLivraisonController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProduitController;
use Illuminate\Support\Facades\Route;

// 🔹 Routes publiques : accès sans authentification
// les Routes publiques
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
// Routes pour les ressources existantes
//     Route::get('/', [HomeController::class, 'index'])->name('home');
//     Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
//     Route::get('/bon-de-livraison', [BonLivraisonController::class, 'index'])->name('bonlivraison.index');
//     Route::post('/bonlivraisons', [BonLivraisonController::class, 'store']);
//     Route::resource('clients', ClientController::class);
//     Route::resource('produits', ProduitController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Routes pour les produits
Route::resource('produits', ProduitController::class)->except(['show']);

// Routes pour les clients
// Dans votre fichier de routes
Route::get('/api/clients', [ClientController::class, 'apiClients']);
Route::post( '/api/clients',[ClientController::class,'apiCreateClient']);



Route::resource('clients', ClientController::class);

// Routes pour les bons de livraison
Route::get('/bon-de-livraison', [BonLivraisonController::class, 'index'])->name('bonlivraison.index');
Route::post('/bonlivraisons', [BonLivraisonController::class, 'store']);

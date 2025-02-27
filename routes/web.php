<?php

use App\Http\Controllers\Api\BonLivraisonController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\PaiementController;
use App\Http\Controllers\Api\BonLivraisonItemController;
use Illuminate\Support\Facades\Route;

// 🔹 Routes publiques : accès sans authentification
// les Routes publiques
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Routes pour les produits
Route::resource('produits', ProduitController::class)->except(['show']);
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');


Route::resource('produits', ProduitController::class);
Route::get('/api/produits', [ProduitController::class, 'apiProduits']);


Route::get('/bon-de-livraison', [BonLivraisonController::class, 'index'])->name('bonlivraison.index');

Route::get('/api/bon-de-livraison', [BonLivraisonController::class, 'apiBonLivraison'])->name('apiBonLivraison');

Route::post('/api/bon-de-livraison', [BonLivraisonController::class, 'apiCreateBonLivraison'])->name('apiCreateBonLivraison');


Route::get('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'apiBonLivraisonItems'])->name('apiBonLivraisonItems');
Route::get('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'index']);
Route::post('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'apiCreateBonLivraisonItem'])->name('apiCreateBonLivraisonItem');









// Routes pour les clients
// Dans votre fichier de routes
Route::get('/api/clients', [ClientController::class, 'apiClients']);
Route::post( '/api/clients',[ClientController::class,'apiCreateClient']);



Route::resource('clients', ClientController::class);

// Routes pour les bons de livraison


// Routes pour les paiement
Route::get('/api/paimentes/{idBonLivraison?}', [PaiementController::class, 'apiPaiementes']);
Route::post( '/api/paimentes',[PaiementController::class,'apiCreatePaiemente']);


//

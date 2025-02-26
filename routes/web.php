

<?php

use App\Http\Controllers\Api\BonLivraisonController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\BonLivraisonItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');



Route::resource('clients', ClientController::class);
Route::resource('produits', ProduitController::class);
Route::get('/api/produits', [ProduitController::class, 'apiProduits']);


Route::get('/bon-de-livraison', [BonLivraisonController::class, 'index'])->name('bonlivraison.index');

Route::get('/api/bon-de-livraison', [BonLivraisonController::class, 'apiBonLivraison'])->name('apiBonLivraison');

Route::post('/api/bon-de-livraison', [BonLivraisonController::class, 'apiCreateBonLivraison'])->name('apiCreateBonLivraison');




Route::get('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'apiBonLivraisonItems'])->name('apiBonLivraisonItems');
Route::get('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'index']);
Route::post('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'apiCreateBonLivraisonItem'])->name('apiCreateBonLivraisonItem');




// Routes publiques
// les Routes publiques
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Routes pour les produits
Route::resource('produits', ProduitController::class)->except(['show']);

// Routes pour les clients
Route::get('/api/clients', [ClientController::class, 'apiClients']);
Route::post('/api/clients', action: [ClientController::class, 'apiCreateClient']);

Route::get('/bon-de-livraison/{bonLivraison}/pdf', [BonLivraisonController::class, 'generatePdf']);

Route::resource('clients', ClientController::class);


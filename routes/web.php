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
use App\Http\Controllers\TicketController;


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
Route::get('/bon-de-livraison/create', [BonLivraisonController::class, 'create'])->name('bonlivraison.create'); // Ajoutez cette ligne

Route::get('/api/bon-de-livraison', [BonLivraisonController::class, 'apiBonLivraison'])->name('apiBonLivraison');

Route::post('/api/bon-de-livraison', [BonLivraisonController::class, 'apiCreateBonLivraison'])->name('apiCreateBonLivraison');


Route::get('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'apiBonLivraisonItems'])->name('apiBonLivraisonItems');
Route::get('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'index']);
Route::post('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'apiCreateBonLivraisonItem'])->name('apiCreateBonLivraisonItem');

Route::post( '/api/paimentes',[PaiementController::class,'apiCreatePaiement'])->name('apiCreatePaiement');
Route::get('/paimentes', [PaiementController::class, 'apiPaiementes'])->name('apiPaiementes');


Route::get('/api/clients', [ClientController::class, 'apiClients']);
Route::post( '/api/clients',[ClientController::class,'apiCreateClient']);



Route::resource('clients', ClientController::class);

Route::get('/pdf/{id}',[\App\Http\Controllers\PdfController::class,'print'])->name('pdf');
Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');

//

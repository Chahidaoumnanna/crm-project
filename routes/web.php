<?php

use App\Http\Controllers\Api\BonLivraisonController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\BonLivraisonItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');


Route::get('/bon-de-livraison', [BonLivraisonController::class, 'index'])->name('bonlivraison.index');
Route::post('/bonlivraisons', [BonLivraisonController::class, 'store']);


Route::resource('clients',ClientController::class);
Route::resource('produits',ProduitController::class);
Route::get('/api/produits', [ProduitController::class, 'apiProduits']);
Route::get('/api/apiBonLivraison' , [BonLivraisonController::class, 'apiBonLivraison']);
Route::post('api/bonLivraisonItem', [BonLivraisonItemController::class, 'apiBonLivraisonItems']);
Route::get('/api/bonLivraisonItem', [BonLivraisonItemController::class, 'index']);

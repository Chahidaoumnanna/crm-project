<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', action: [HomeController::class,'index'])->name('home');

Route::resource('clients',ClientController::class);



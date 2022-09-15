<?php

use dnj\Currency\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;


Route::get('/currencies/', [CurrencyController::class, "index"]);
Route::get('/currencies/{currency}', [CurrencyController::class, "show"]);
Route::post('/currencies/', [CurrencyController::class, "store"]);


<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientController::class, 'index'])->name('clients.index');


Route::resource('clients', ClientController::class);
Route::post('/clients/{client}/representatives', [ClientController::class, 'addRepresentative'])->name('clients.representatives.add');
Route::delete('/clients/{client}/representatives/{representative}', [ClientController::class, 'removeRepresentative'])->name('clients.representatives.remove');

<?php

use App\Http\Controllers\ClientCompanyRepresentativeController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientController::class, 'index'])->name('clients.index');


Route::resource('clients', ClientController::class);
Route::resource('clients.representatives', ClientCompanyRepresentativeController::class)
    ->only([
        'store',
        'destroy'
    ])
    ->shallow();

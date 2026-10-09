<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/index');
});

Route::get('/index', [KeranjangController::class, 'index']);
Route::get('/keranjang', [KeranjangController::class, 'keranjang']);

Route::get('/tambah/{id}', [KeranjangController::class, 'tambah']);
Route::get('/plus/{id}', [KeranjangController::class, 'plus']);
Route::get('/minus/{id}', [KeranjangController::class, 'minus']);
Route::get('/hapus/{id}', [KeranjangController::class, 'hapus']);
Route::get('/kosongkan', [KeranjangController::class, 'kosongkan']);
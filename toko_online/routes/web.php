<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Publik
Route::get('/', [BarangController::class, 'index']);
Route::get('/barang', [BarangController::class, 'index']);

// Login & register (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Harus login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/keranjang', [KeranjangController::class, 'index']);
    Route::get('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);
    Route::get('/keranjang/plus/{id}', [KeranjangController::class, 'plus']);
    Route::get('/keranjang/minus/{id}', [KeranjangController::class, 'minus']);
    Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus']);

    Route::get('/checkout', [CheckoutController::class, 'form']);
    Route::post('/checkout', [CheckoutController::class, 'proses']);

    Route::get('/riwayat', [CheckoutController::class, 'riwayat']);
    Route::get('/riwayat/{id}', [CheckoutController::class, 'detail']);
});

// PATCH untuk mengubah state, dilindungi auth & Gate manage-roles
Route::patch('/admin/users/{user}/role', [RoleController::class, 'update'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.role.update');
    
Route::get('/admin/users', function () {
    return view('admin.users', ['users' => \App\Models\User::all()]);
})->middleware(['auth', 'can:manage-roles']);
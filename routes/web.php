<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Auth bawaan Laravel (Login, Register, Logout, dll)
Auth::routes();

// Redirect ke dashboard setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Semua route ini hanya bisa diakses kalau sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'dashboard'])->name('dashboard');

    // CRUD transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::delete('/transactions', [TransactionController::class, 'destroyAll'])->name('transactions.destroyAll');
});

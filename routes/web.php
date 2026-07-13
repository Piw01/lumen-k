<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route otomatis CRUD (index, create, store, edit, update, destroy)
Route::resource('kategori', KategoriController::class);
Route::resource('alat', AlatController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('transaksi', TransaksiController::class)->except(['edit', 'update']); // Kita tidak butuh form edit full
Route::patch('/transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
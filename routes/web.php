<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

// ==========================================
// 1. RUTE PUBLIK (BISA DIAKSES SIAPA SAJA / GUEST)
// ==========================================
Route::get('/', function () {
    return view('welcome'); 
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ==========================================
// 2. RUTE TERPROTEKSI (WAJIB LOGIN DULU)
// ==========================================
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --------------------------------------
    // HAK AKSES: KELOMPOK INTERNAL (SUPER ADMIN & STAF)
    // Mampu mengelola semua Master Data & Operasional Toko
    // --------------------------------------
    Route::middleware('role:super_admin,staf')->group(function () {
        
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard'); // <-- UBAH BARIS INI

    Route::resource('kategori', KategoriController::class);
    Route::resource('alat', AlatController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class)->except(['edit', 'update']);
    Route::patch('/transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    });

    // --------------------------------------
    // HAK AKSES: KELOMPOK EKSTERNAL (CUSTOMER ONLY)
    // Tempat menaruh rute Keranjang Belanja & Transaksi Mandiri nanti
    // --------------------------------------
    Route::middleware('role:customer')->group(function () {
        // Rute untuk fungsionalitas customer akan kita letakkan di sini pada fase berikutnya
    });

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

// ==========================================
// 1. RUTE PUBLIK (GUEST)
// ==========================================
Route::get('/', function () {
    // Mengambil semua data alat dari database
    $alats = \App\Models\Alat::latest()->paginate(10); 
    
    // Mengirim data alat ke halaman welcome
    return view('welcome', compact('alats'));
})->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ==========================================
// 2. RUTE TERPROTEKSI (WAJIB LOGIN)
// ==========================================
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --------------------------------------
    // SUPER ADMIN & STAF (Internal)
    // --------------------------------------
    Route::middleware('role:super_admin,staf')->group(function () {
        
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::resource('kategori', KategoriController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('pelanggan', PelangganController::class);
        
        Route::resource('transaksi', TransaksiController::class)->except(['edit', 'update']);
        Route::patch('/transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    });

    // --------------------------------------
    // CUSTOMER ONLY (Eksternal)
    // --------------------------------------
    Route::middleware('role:customer')->group(function () {
        // Rute untuk keranjang belanja akan dibuat di sini nanti
    });

});
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Alat;
use App\Models\Pelanggan;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Hitung total pendapatan dari transaksi selesai
        $pendapatan = Transaksi::where('status_rental', '=', 'selesai', 'and')->sum('total_harga');

        // 2. Hitung alat yang sedang dipinjam
        $alatDipinjam = Transaksi::where('status_rental', '=', 'dipinjam', 'and')->count('*');

        // 3. Total stok gudang
        $stokTersedia = Alat::sum('stok');

        // 4. Total pelanggan terdaftar
        $totalPelanggan = Pelanggan::count('*');
    
        // 5. Mengambil data transaksi terakhir (DISAMAKAN DENGAN VIEW: $transaksiTerbaru)
        $transaksiTerbaru = Transaksi::latest('created_at')->take(5)->get();

        // Kirim semua variabel ke view home.blade.php
        return view('home', compact('pendapatan', 'alatDipinjam', 'stokTersedia', 'totalPelanggan', 'transaksiTerbaru'));
    }
}
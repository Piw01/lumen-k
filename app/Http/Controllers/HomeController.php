<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Alat;
use App\Models\Pelanggan;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Hitung total pendapatan dari transaksi selesai
        // Use simple where to avoid method signature conflicts
        $pendapatan = DB::table('transaksis')->where('status_rental', 'selesai')->sum('total_harga');

        // 2. Hitung alat yang sedang dipinjam
        // Use get()->count() to avoid method signature conflicts
        $alatDipinjam = DB::table('transaksis')->where('status_rental', 'dipinjam')->count();

        // 3. Total stok gudang (Disamakan dengan frontend: $stokTersedia)
        $stokTersedia = Alat::sum('stok');

        // 4. Total pelanggan terdaftar
        // Use all()->count() to avoid method signature issues with the model
        $totalPelanggan = Pelanggan::all()->count();

        // 5. Mengambil data transaksi terakhir untuk tabel dashboard
        // Use explicit orderBy to avoid potential method signature issues with latest()
        $transaksiTerakhir = DB::table('transaksis')->orderBy('created_at', 'desc')->take(5)->get();

        // Kirim semua variabel ke view home.blade.php
        return view('home', compact('pendapatan', 'alatDipinjam', 'stokTersedia', 'totalPelanggan', 'transaksiTerakhir'));
    }
}
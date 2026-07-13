<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Pendapatan (Hanya dari transaksi yang "selesai")
        $pendapatan = Transaksi::where('status', 'selesai')->sum('total_harga');

        // 2. Hitung Alat yang sedang "jalan" (dipinjam)
        $alatDipinjam = Transaksi::where('status', 'dipinjam')->count();

        // 3. Hitung Total Pelanggan
        $totalPelanggan = Pelanggan::count();

        // 4. Hitung Total Stok Alat yang Tersedia (Ready)
        $stokTersedia = Alat::sum('stok');

        // 5. Ambil 5 Transaksi Terakhir untuk ditampilkan di tabel ringkasan
        $transaksiTerbaru = Transaksi::with(['pelanggan', 'alat'])
                                     ->latest()
                                     ->take(5)
                                     ->get();

        return view('home', compact(
            'pendapatan', 
            'alatDipinjam', 
            'totalPelanggan', 
            'stokTersedia', 
            'transaksiTerbaru'
        ));
    }
}
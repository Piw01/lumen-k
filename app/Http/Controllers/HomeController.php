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
        // 1. Hitung total pendapatan dari transaksi yang sudah 'selesai'
        // Kolom 'status' diubah menjadi 'status_rental' sesuai migrasi baru
        $pendapatan = Transaksi::where('status_rental', 'selesai')->sum('total_harga');

        // 2. Hitung alat yang sedang dipinjam
        $alat_dipinjam = Transaksi::where('status_rental', 'dipinjam')->count();

        // 3. Total stok gudang (menghitung total unit alat yang ada)
        $total_stok = Alat::sum('stok');

        // 4. Total pelanggan terdaftar
        $total_pelanggan = Pelanggan::count();

        // 5. Mengambil data transaksi terakhir untuk tabel di bawah dashboard
        // Jika variabel di view UTS kamu berbeda, sesuaikan nama variabelnya
        $transaksi_terakhir = Transaksi::latest()->take(5)->get();

        // Kirim semua variabel ke view internal admin (home.blade.php)
        return view('home', compact('pendapatan', 'alat_dipinjam', 'total_stok', 'total_pelanggan', 'transaksi_terakhir'));
    }
}
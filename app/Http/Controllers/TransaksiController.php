<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Alat;
use Illuminate\Http\Request;
use Carbon\Carbon; // Library bawaan Laravel untuk hitung tanggal

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil data transaksi beserta relasi pelanggan dan alat, urutkan dari yang terbaru
        $transaksis = Transaksi::with(['pelanggan', 'alat'])->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        // Hanya tampilkan alat yang stoknya masih ada (> 0)
        $alats = Alat::where('stok', '>', 0)->get(); 
        return view('transaksi.create', compact('pelanggans', 'alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required',
            'alat_id' => 'required',
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_sewa',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        // Validasi ekstra (jaga-jaga jika dibobol)
        if ($alat->stok < 1) {
            return back()->with('error', 'Stok alat ini sedang kosong!');
        }

        // HITUNG TOTAL HARGA OTOMATIS
        $tgl_sewa = Carbon::parse($request->tgl_sewa);
        $tgl_kembali = Carbon::parse($request->tgl_kembali);
        $hari = $tgl_sewa->diffInDays($tgl_kembali);
        
        // Jika sewa dan kembali di hari yang sama, dihitung 1 hari
        if ($hari == 0) { $hari = 1; }

        $total_harga = $hari * $alat->harga_sewa;

        // Simpan Transaksi
        Transaksi::create([
            'pelanggan_id' => $request->pelanggan_id,
            'alat_id' => $request->alat_id,
            'tgl_sewa' => $request->tgl_sewa,
            'tgl_kembali' => $request->tgl_kembali,
            'total_harga' => $total_harga,
            'status' => 'dipinjam' // Status awal pasti dipinjam
        ]);

        // KURANGI STOK ALAT OTOMATIS
        $alat->decrement('stok');

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat. Stok otomatis berkurang!');
    }

    // Untuk transaksi, biasanya tidak ada edit form penuh, tapi fitur "Selesaikan Penyewaan"
    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        // Jika statusnya dipinjam dan mau diselesaikan
        if ($transaksi->status == 'dipinjam') {
            $transaksi->update(['status' => 'selesai']);
            
            // KEMBALIKAN STOK ALAT
            $alat = Alat::findOrFail($transaksi->alat_id);
            $alat->increment('stok');

            return back()->with('success', 'Barang telah dikembalikan. Stok otomatis bertambah!');
        }

        return back();
    }

    public function destroy(Transaksi $transaksi)
    {
        // Jika dihapus saat status masih dipinjam, kembalikan stoknya dulu
        if ($transaksi->status == 'dipinjam') {
            $alat = Alat::findOrFail($transaksi->alat_id);
            $alat->increment('stok');
        }
        
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Data riwayat transaksi dihapus!');
    }
}
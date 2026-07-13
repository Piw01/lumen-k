<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori; // Kita butuh model Kategori untuk dropdown
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        // get() dengan with() untuk mengambil relasi kategori sekaligus (Eager Loading)
        $alats = Alat::with('kategori')->get();
        return view('alat.index', compact('alats'));
    }

    public function create()
    {
        // Ambil semua kategori untuk ditampilkan di dropdown form
        $kategoris = Kategori::all();
        return view('alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_alat' => 'required',
            'merk' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        Alat::create($request->all());
        return redirect()->route('alat.index')->with('success', 'Data alat berhasil ditambahkan!');
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_alat' => 'required',
            'merk' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $alat->update($request->all());
        return redirect()->route('alat.index')->with('success', 'Data alat berhasil diupdate!');
    }

    public function destroy(Alat $alat)
    {
        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'Data alat berhasil dihapus!');
    }
}
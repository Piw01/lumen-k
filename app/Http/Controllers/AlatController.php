<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index()
    {
        // Mengambil semua data alat beserta relasi kategorinya
        $alats = Alat::with('kategori')->latest()->get();
        return view('alat.index', compact('alats'));
    }

    public function create()
    {
        // Mengambil data kategori untuk dropdown (select)
        $kategoris = Kategori::all();
        return view('alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_alat' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        // Logika upload gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('alats', 'public');
        }

        Alat::create($validated);

        return redirect()->route('alat.index')->with('success', 'Data Alat berhasil ditambahkan!');
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_alat' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika user mengunggah gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($alat->gambar) {
                Storage::disk('public')->delete($alat->gambar);
            }
            // Simpan gambar baru
            $validated['gambar'] = $request->file('gambar')->store('alats', 'public');
        }

        $alat->update($validated);

        return redirect()->route('alat.index')->with('success', 'Data Alat berhasil diperbarui!');
    }

    public function destroy(Alat $alat)
    {
        // Hapus file gambar dari server jika ada
        if ($alat->gambar) {
            Storage::disk('public')->delete($alat->gambar);
        }
        
        // Use static destroy with id to avoid argument mismatch on instance delete
        Alat::destroy($alat->id);

        return redirect()->route('alat.index')->with('success', 'Data Alat berhasil dihapus!');
    }
}
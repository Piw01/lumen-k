<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $fillable = ['kategori_id', 'nama_alat', 'merk', 'harga_sewa', 'stok', 'gambar'];

    // Relasi: Alat ini milik sebuah kategori
    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}

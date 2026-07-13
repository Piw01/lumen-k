<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // Kolom yang boleh diisi manual
    protected $fillable = ['nama_kategori', 'deskripsi'];

    // Relasi: Satu kategori punya banyak alat
    public function alats() {
        return $this->hasMany(Alat::class);
    }
}

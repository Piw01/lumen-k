<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'pelanggan_id', 'alat_id', 'tgl_sewa', 
        'tgl_kembali', 'total_harga', 'status'
    ];

    public function pelanggan() {
        return $this->belongsTo(Pelanggan::class);
    }

    public function alat() {
        return $this->belongsTo(Alat::class);
    }
}

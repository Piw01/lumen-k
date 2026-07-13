<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel induk transaksi
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade');
            // Relasi ke alat yang disewa
            $table->foreignId('alat_id')->constrained('alats')->onDelete('cascade');
            
            // Kita kunci harga saat disewa (antisipasi jika di masa depan harga master alat berubah)
            $table->integer('harga_per_hari'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};

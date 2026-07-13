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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            // Kode invoice unik, contoh: INV-20260714-0001
            $table->string('invoice')->unique(); 
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            
            // Tanggal sewa berlaku untuk seluruh isi keranjang
            $table->date('tgl_sewa');
            $table->date('tgl_kembali');
            $table->integer('total_harga');
            $table->integer('denda')->default(0);

            // Status Operasional & Pembayaran (Persiapan Midtrans)
            $table->enum('status_rental', ['menunggu_pembayaran', 'diproses', 'dipinjam', 'selesai', 'dibatalkan'])->default('menunggu_pembayaran');
            $table->enum('status_pembayaran', ['unpaid', 'paid', 'failed'])->default('unpaid');
            
            // Kolom opsional untuk menyimpan snap token Midtrans nanti
            $table->string('midtrans_snap_token')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

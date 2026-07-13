<x-layout>
    <x-slot:title>Buat Transaksi | Lumen-K</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h2 class="fw-bold mb-4" style="color: #facc15;">FORMULIR PENYEWAAN</h2>
        
        @if(session('error'))
            <div class="alert alert-danger bg-dark border-danger text-danger mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="card p-4" style="background-color: #111; border: 1px solid #333;">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small fw-bold"><i class="fa-solid fa-user me-2"></i>PILIH PELANGGAN</label>
                        <select name="pelanggan_id" class="form-select bg-black text-white border-secondary" required>
                            <option value="">-- Data Pelanggan --</option>
                            @foreach($pelanggans as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} (NIK: {{ $p->nik }})</option>
                            @endforeach
                        </select>
                        <div class="mt-2 text-end">
                            <a href="{{ route('pelanggan.create') }}" class="small text-warning text-decoration-none">+ Pelanggan Baru</a>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small fw-bold"><i class="fa-solid fa-camera me-2"></i>PILIH ALAT (READY STOK)</label>
                        <select name="alat_id" class="form-select bg-black text-white border-secondary" required>
                            <option value="">-- Katalog Alat --</option>
                            @foreach($alats as $a)
                                <!-- Kita tampilkan info harga harian agar admin mudah melihatnya -->
                                <option value="{{ $a->id }}">{{ $a->nama_alat }} - Rp {{ number_format($a->harga_sewa, 0, ',', '.') }}/hari</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row bg-black p-3 mb-4 rounded border border-secondary">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label text-muted small fw-bold">TANGGAL PENGAMBILAN (SEWA)</label>
                        <input type="date" name="tgl_sewa" class="form-control bg-dark text-warning border-secondary" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-bold">TANGGAL PENGEMBALIAN</label>
                        <input type="date" name="tgl_kembali" class="form-control bg-dark text-warning border-secondary" required>
                    </div>
                    <div class="col-12 mt-3 text-center">
                        <span class="text-muted small"><i class="fa-solid fa-circle-info me-1"></i>Sistem akan mengkalkulasi total harga secara otomatis berdasarkan durasi hari.</span>
                    </div>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn ds-btn flex-grow-1 py-3" style="font-size: 1.1rem;">PROSES TRANSAKSI & KURANGI STOK</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
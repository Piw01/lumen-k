<x-layout>
    <x-slot:title>Tambah Pelanggan | Lumen-K</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h2 class="fw-bold mb-4" style="color: #facc15;">REGISTRASI PELANGGAN</h2>
        
        <div class="card p-4" style="background-color: #111; border: 1px solid #333;">
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA LENGKAP</label>
                        <input type="text" name="nama" class="form-control bg-black text-white border-secondary" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small fw-bold">NOMOR HP / WHATSAPP</label>
                        <input type="text" name="no_hp" class="form-control bg-black text-white border-secondary" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">NIK (NOMOR INDUK KEPENDUDUKAN)</label>
                    <input type="text" name="nik" class="form-control bg-black text-white border-secondary" required>
                    @error('nik')
                        <div class="text-danger small mt-1">NIK sudah terdaftar sebelumnya.</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">ALAMAT LENGKAP</label>
                    <textarea name="alamat" class="form-control bg-black text-white border-secondary" rows="3" required></textarea>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn ds-btn flex-grow-1">SIMPAN DATA PELANGGAN</button>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">BATAL</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
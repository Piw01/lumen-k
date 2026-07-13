<x-layout>
    <x-slot:title>Edit Pelanggan | Lumen-K</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary me-3" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h2 class="fw-bold mb-0" style="color: #facc15;">EDIT DATA PELANGGAN</h2>
        </div>
        
        <div class="card p-4" style="background-color: #111; border: 1px solid #333;">
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA LENGKAP</label>
                        <input type="text" name="nama" class="form-control bg-black text-white border-secondary" value="{{ $pelanggan->nama }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small fw-bold">NOMOR HP / WHATSAPP</label>
                        <input type="text" name="no_hp" class="form-control bg-black text-white border-secondary" value="{{ $pelanggan->no_hp }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">NIK (NOMOR INDUK KEPENDUDUKAN)</label>
                    <input type="text" name="nik" class="form-control bg-black text-white border-secondary" value="{{ $pelanggan->nik }}" required>
                    @error('nik')
                        <div class="text-danger small mt-1">NIK sudah terdaftar sebelumnya.</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">ALAMAT LENGKAP</label>
                    <textarea name="alamat" class="form-control bg-black text-white border-secondary" rows="3" required>{{ $pelanggan->alamat }}</textarea>
                </div>
                
                <button type="submit" class="btn ds-btn w-100">UPDATE DATA PELANGGAN</button>
            </form>
        </div>
    </div>
</x-layout>
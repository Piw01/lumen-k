<x-layout>
    <x-slot:title>Edit Alat | Lumen-K</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary me-3" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h2 class="fw-bold mb-0" style="color: #facc15;">EDIT DATA ALAT</h2>
        </div>
        
        <div class="card p-4" style="background-color: #111; border: 1px solid #333;">
            <form action="{{ route('alat.update', $alat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA ALAT</label>
                        <input type="text" name="nama_alat" class="form-control bg-black text-white border-secondary" value="{{ $alat->nama_alat }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small fw-bold">KATEGORI</label>
                        <select name="kategori_id" class="form-select bg-black text-white border-secondary" required>
                            @foreach($kategoris as $k)
                                <!-- Logika untuk memilih opsi yang sesuai dengan data saat ini -->
                                <option value="{{ $k->id }}" {{ $alat->kategori_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted small fw-bold">MERK</label>
                        <input type="text" name="merk" class="form-control bg-black text-white border-secondary" value="{{ $alat->merk }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted small fw-bold">HARGA SEWA (Rp)</label>
                        <input type="number" name="harga_sewa" class="form-control bg-black text-white border-secondary" value="{{ $alat->harga_sewa }}" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label class="form-label text-muted small fw-bold">STOK SISA</label>
                        <input type="number" name="stok" class="form-control bg-black text-white border-secondary" value="{{ $alat->stok }}" required>
                    </div>
                </div>
                
                <button type="submit" class="btn ds-btn w-100">UPDATE KATALOG</button>
            </form>
        </div>
    </div>
</x-layout>
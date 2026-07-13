<x-layout>
    <x-slot:title>Tambah Alat | Lumen-K</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h2 class="fw-bold mb-4" style="color: #facc15;">INPUT ALAT BARU</h2>
        
        <div class="card p-4" style="background-color: #111; border: 1px solid #333;">
            <form action="{{ route('alat.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA ALAT</label>
                        <input type="text" name="nama_alat" class="form-control bg-black text-white border-secondary" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small fw-bold">KATEGORI</label>
                        <select name="kategori_id" class="form-select bg-black text-white border-secondary" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted small fw-bold">MERK</label>
                        <input type="text" name="merk" class="form-control bg-black text-white border-secondary" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-muted small fw-bold">HARGA SEWA (Rp)</label>
                        <input type="number" name="harga_sewa" class="form-control bg-black text-white border-secondary" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label class="form-label text-muted small fw-bold">STOK AWAL</label>
                        <input type="number" name="stok" class="form-control bg-black text-white border-secondary" value="1" required>
                    </div>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn ds-btn flex-grow-1">SIMPAN KATALOG</button>
                    <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">BATAL</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
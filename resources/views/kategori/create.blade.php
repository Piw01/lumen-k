<x-layout>
    <x-slot:title>Tambah Kategori | Lumen-K</x-slot:title>

    <div class="max-w-md mx-auto">
        <h2 class="fw-bold mb-4" style="color: #facc15;">INPUT KATEGORI BARU</h2>
        
        <div class="card p-4">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">NAMA KATEGORI</label>
                    <input type="text" name="nama_kategori" class="form-control bg-black text-white border-secondary" placeholder="Contoh: Kamera Mirrorless" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">DESKRIPSI (OPSIONAL)</label>
                    <textarea name="deskripsi" class="form-control bg-black text-white border-secondary" rows="3"></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn ds-btn w-100">SIMPAN DATA</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary w-100">BATAL</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>

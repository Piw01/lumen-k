<x-layout>
    <x-slot:title>Edit Kategori | Lumen-K</x-slot:title>

    <div class="max-w-md mx-auto">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary me-3" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h2 class="fw-bold mb-0" style="color: #facc15;">EDIT DATA KATEGORI</h2>
        </div>
        
        <div class="card p-4" style="background-color: #111; border: 1px solid #333;">
            <!-- Perhatikan action dan method di bawah ini -->
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                <!-- Wajib tambahkan method PUT untuk proses Update di Laravel -->
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">NAMA KATEGORI</label>
                    <input type="text" name="nama_kategori" class="form-control bg-black text-white border-secondary" value="{{ $kategori->nama_kategori }}" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">DESKRIPSI (OPSIONAL)</label>
                    <textarea name="deskripsi" class="form-control bg-black text-white border-secondary" rows="3">{{ $kategori->deskripsi }}</textarea>
                </div>
                
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn ds-btn flex-grow-1">SIMPAN PERUBAHAN</button>
                </div>
            </form>
        </div>
        
        <div class="mt-4 p-3 rounded" style="background-color: rgba(250, 204, 21, 0.1); border-left: 4px solid #facc15;">
            <p class="small text-muted mb-0"><i class="fa-solid fa-circle-info me-2 text-warning"></i>Data yang diubah akan langsung terupdate di seluruh sistem dan mempengaruhi data Alat yang terkait dengan kategori ini.</p>
        </div>
    </div>
</x-layout>
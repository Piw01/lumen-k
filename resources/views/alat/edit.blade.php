<x-layout>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow" style="background-color: #1a1a1a; border: 1px solid #333333;">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
                        <h4 class="text-warning mb-0">EDIT ALAT</h4>
                        <a href="{{ route('alat.index') }}" class="btn btn-sm btn-outline-light">Kembali</a>
                    </div>

                    <form action="{{ route('alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label text-white">Nama Alat</label>
                            <input type="text" name="nama_alat" class="form-control bg-dark text-white border-secondary @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat', $alat->nama_alat) }}" required>
                            @error('nama_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-white">Kategori</label>
                                <select name="kategori_id" class="form-select bg-dark text-white border-secondary @error('kategori_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-white">Merk</label>
                                <input type="text" name="merk" class="form-control bg-dark text-white border-secondary @error('merk') is-invalid @enderror" value="{{ old('merk', $alat->merk) }}" required>
                                @error('merk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-white">Harga Sewa per Hari (Rp)</label>
                                <input type="number" name="harga_sewa" class="form-control bg-dark text-white border-secondary @error('harga_sewa') is-invalid @enderror" value="{{ old('harga_sewa', $alat->harga_sewa) }}" required>
                                @error('harga_sewa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-white">Stok Barang</label>
                                <input type="number" name="stok" class="form-control bg-dark text-white border-secondary @error('stok') is-invalid @enderror" value="{{ old('stok', $alat->stok) }}" required>
                                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-white">Ganti Gambar Alat (Opsional)</label>
                            @if($alat->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $alat->gambar) }}" alt="Current Image" style="height: 100px; border-radius: 5px; border: 1px solid #555;">
                                </div>
                            @endif
                            <input type="file" name="gambar" class="form-control bg-dark text-muted border-secondary @error('gambar') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-warning fw-bold text-dark w-100">SIMPAN PERUBAHAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
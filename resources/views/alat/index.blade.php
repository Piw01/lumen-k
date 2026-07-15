<x-layout>
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
            <h3 class="text-white mb-0">MANAJEMEN ALAT</h3>
            <a href="{{ route('alat.create') }}" class="btn btn-warning fw-bold text-dark">
                <i class="bi bi-plus-lg"></i> Tambah Alat Baru
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success py-2">{{ session('success') }}</div>
        @endif

        <div class="card p-0 shadow" style="background-color: #1a1a1a; border: 1px solid #333333;">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0" style="border-color: #333333;">
                    <thead style="border-bottom: 2px solid #555;">
                        <tr>
                            <th class="py-3 text-warning">GAMBAR</th>
                            <th class="py-3 text-warning">NAMA ALAT</th>
                            <th class="py-3 text-warning">KATEGORI</th>
                            <th class="py-3 text-warning">MERK</th>
                            <th class="py-3 text-warning text-end">HARGA / HARI</th>
                            <th class="py-3 text-warning text-center">STOK</th>
                            <th class="py-3 text-warning text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alats as $item)
                        <tr>
                            <td class="align-middle">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Alat" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 60px; height: 60px; font-size: 10px; border-radius: 4px;">No Img</div>
                                @endif
                            </td>
                            <td class="align-middle text-white fw-bold">{{ $item->nama_alat }}</td>
                            <td class="align-middle text-muted">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td class="align-middle text-muted">{{ $item->merk }}</td>
                            <td class="align-middle text-success fw-bold text-end">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                            <td class="align-middle text-center text-white">{{ $item->stok }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('alat.edit', $item->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                <form action="{{ route('alat.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus alat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data alat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
<x-layout>
    <x-slot:title>Daftar Alat | Lumen-K</x-slot:title>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #facc15;">MASTER ALAT / KATALOG</h2>
        <a href="{{ route('alat.create') }}" class="btn ds-btn">+ TAMBAH ALAT</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-dark text-success border-success small mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-0">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0">
                <thead>
                    <tr style="border-bottom: 2px solid #333;">
                        <th class="px-4 py-3">#</th>
                        <th class="py-3">NAMA ALAT</th>
                        <th class="py-3">KATEGORI</th>
                        <th class="py-3">MERK</th>
                        <th class="py-3 text-end">HARGA / HARI</th>
                        <th class="py-3 text-center">STOK</th>
                        <th class="text-end px-4 py-3">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alats as $a)
                    <tr style="border-bottom: 1px solid #222;">
                        <td class="px-4 py-3 text-muted">{{ $loop->iteration }}</td>
                        <td class="py-3 fw-bold">{{ $a->nama_alat }}</td>
                        <!-- Mengambil nama kategori dari relasi -->
                        <td class="py-3 text-warning small">{{ $a->kategori->nama_kategori ?? 'Tidak ada Kategori' }}</td>
                        <td class="py-3 text-muted">{{ $a->merk }}</td>
                        <td class="py-3 text-end">Rp {{ number_format($a->harga_sewa, 0, ',', '.') }}</td>
                        <td class="py-3 text-center">
                            <span class="badge {{ $a->stok > 0 ? 'bg-success' : 'bg-danger' }}">{{ $a->stok }}</span>
                        </td>
                        <td class="text-end px-4 py-3">
                            <a href="{{ route('alat.edit', $a->id) }}" class="btn btn-sm btn-outline-info me-1">EDIT</a>
                            <form action="{{ route('alat.destroy', $a->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus alat ini?')">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
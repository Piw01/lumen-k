<x-layout>
    <x-slot:title>Daftar Kategori | Lumen-K</x-slot:title>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #facc15;">MASTER KATEGORI</h2>
        <a href="{{ route('kategori.create') }}" class="btn ds-btn">+ TAMBAH KATEGORI</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-dark text-success border-success small mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-0">
        <table class="table table-dark table-hover mb-0">
            <thead>
                <tr style="border-bottom: 2px solid #333;">
                    <th class="px-4 py-3">#</th>
                    <th class="py-3">NAMA KATEGORI</th>
                    <th class="py-3">DESKRIPSI</th>
                    <th class="text-end px-4 py-3">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $k)
                <tr style="border-bottom: 1px solid #222;">
                    <td class="px-4 py-3 text-muted">{{ $loop->iteration }}</td>
                    <td class="py-3 fw-bold">{{ $k->nama_kategori }}</td>
                    <td class="py-3 text-muted small">{{ $k->deskripsi ?? '-' }}</td>
                    <td class="text-end px-4 py-3">
                        <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm btn-outline-info me-2">EDIT</a>
                        <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus kategori ini?')">HAPUS</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>

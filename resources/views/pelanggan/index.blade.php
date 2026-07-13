<x-layout>
    <x-slot:title>Daftar Pelanggan | Lumen-K</x-slot:title>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #facc15;">MASTER PELANGGAN</h2>
        <a href="{{ route('pelanggan.create') }}" class="btn ds-btn">+ TAMBAH PELANGGAN</a>
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
                        <th class="py-3">NAMA</th>
                        <th class="py-3">NIK (ID)</th>
                        <th class="py-3">NO. HP</th>
                        <th class="py-3">ALAMAT</th>
                        <th class="text-end px-4 py-3">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelanggans as $p)
                    <tr style="border-bottom: 1px solid #222;">
                        <td class="px-4 py-3 text-muted">{{ $loop->iteration }}</td>
                        <td class="py-3 fw-bold">{{ $p->nama }}</td>
                        <td class="py-3 text-muted">{{ $p->nik }}</td>
                        <td class="py-3 text-warning small">{{ $p->no_hp }}</td>
                        <td class="py-3 text-muted small text-truncate" style="max-width: 200px;">{{ $p->alamat }}</td>
                        <td class="text-end px-4 py-3">
                            <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-sm btn-outline-info me-1">EDIT</a>
                            <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pelanggan ini? Riwayat transaksinya bisa ikut terhapus.')">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
<x-layout>
    <x-slot:title>Data Transaksi | Lumen-K</x-slot:title>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #facc15;">LOG TRANSAKSI PENYEWAAN</h2>
        <a href="{{ route('transaksi.create') }}" class="btn ds-btn">+ BUAT TRANSAKSI BARU</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-dark text-success border-success small mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-0" style="border: 1px solid #333;">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0 align-middle">
                <thead>
                    <tr style="border-bottom: 2px solid #333;">
                        <th class="px-4 py-3 text-muted small">ORDER ID</th>
                        <th class="py-3 text-muted small">PELANGGAN</th>
                        <th class="py-3 text-muted small">ALAT (MERK)</th>
                        <th class="py-3 text-muted small">DURASI SEWA</th>
                        <th class="py-3 text-end text-muted small">TOTAL HARGA</th>
                        <th class="py-3 text-center text-muted small">STATUS</th>
                        <th class="text-end px-4 py-3 text-muted small">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr style="border-bottom: 1px solid #222;">
                        <td class="px-4 py-3 fw-bold text-secondary">#TRX-{{ str_pad($t->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-3 text-white">{{ $t->pelanggan->nama ?? 'Anonim' }}</td>
                        <td class="py-3 text-warning">{{ $t->alat->nama_alat ?? 'Alat Dihapus' }}</td>
                        <td class="py-3 small text-muted">
                            {{ \Carbon\Carbon::parse($t->tgl_sewa)->format('d M Y') }} - <br>
                            {{ \Carbon\Carbon::parse($t->tgl_kembali)->format('d M Y') }}
                        </td>
                        <td class="py-3 text-end fw-bold text-success">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td class="py-3 text-center">
                            @if($t->status == 'dipinjam')
                                <span class="badge bg-warning text-dark px-3 py-2" style="border-radius: 0;">DIPINJAM</span>
                            @else
                                <span class="badge bg-success px-3 py-2" style="border-radius: 0;">SELESAI</span>
                            @endif
                        </td>
                        <td class="text-end px-4 py-3">
                            @if($t->status == 'dipinjam')
                                <!-- Tombol Selesaikan (Kembalikan Barang) -->
                                <form action="{{ route('transaksi.updateStatus', $t->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-success me-1" onclick="return confirm('Tandai barang sudah dikembalikan oleh pelanggan?')">
                                        <i class="fa-solid fa-check"></i> SELESAIKAN
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus log transaksi ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Belum ada riwayat transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
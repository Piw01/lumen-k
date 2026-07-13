<x-layout>
    <x-slot:title>Dashboard | Lumen-K</x-slot:title>

    <div class="mb-5">
        <h2 class="fw-bold" style="color: #facc15; letter-spacing: 2px;">KIREI COMMAND CENTER</h2>
        <p class="text-muted">Sistem Monitoring Penyewaan Lumen-K</p>
    </div>

    <!-- Baris Widget Statistik -->
    <div class="row g-4 mb-5">
        <!-- Widget 1: Pendapatan -->
        <div class="col-md-3">
            <div class="card h-100 p-4" style="background-color: #111; border: 1px solid #333; border-left: 4px solid #facc15;">
                <div class="text-muted small fw-bold mb-2">TOTAL PENDAPATAN</div>
                <h3 class="fw-bold mb-0 text-white">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Widget 2: Alat Dipinjam -->
        <div class="col-md-3">
            <div class="card h-100 p-4" style="background-color: #111; border: 1px solid #333; border-left: 4px solid #ef4444;">
                <div class="text-muted small fw-bold mb-2">ALAT SEDANG DIPINJAM</div>
                <h3 class="fw-bold mb-0 text-white">{{ $alatDipinjam }} <span class="fs-6 text-muted fw-normal">Unit</span></h3>
            </div>
        </div>

        <!-- Widget 3: Stok Tersedia -->
        <div class="col-md-3">
            <div class="card h-100 p-4" style="background-color: #111; border: 1px solid #333; border-left: 4px solid #3b82f6;">
                <div class="text-muted small fw-bold mb-2">TOTAL STOK GUDANG</div>
                <h3 class="fw-bold mb-0 text-white">{{ $stokTersedia }} <span class="fs-6 text-muted fw-normal">Unit</span></h3>
            </div>
        </div>

        <!-- Widget 4: Total Pelanggan -->
        <div class="col-md-3">
            <div class="card h-100 p-4" style="background-color: #111; border: 1px solid #333; border-left: 4px solid #10b981;">
                <div class="text-muted small fw-bold mb-2">TOTAL PELANGGAN</div>
                <h3 class="fw-bold mb-0 text-white">{{ $totalPelanggan }} <span class="fs-6 text-muted fw-normal">Orang</span></h3>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi Terbaru -->
    <div class="card p-0" style="background-color: #111; border: 1px solid #333;">
        <div class="card-header border-0 py-3 d-flex justify-content-between align-items-center" style="background-color: rgba(0,0,0,0.5);">
            <h6 class="mb-0 fw-bold" style="color: #facc15;">LOG TRANSAKSI TERAKHIR</h6>
            <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-secondary">LIHAT SEMUA</a>
        </div>
        <div class="table-responsive">
            <table class="table table-dark mb-0 align-middle">
                <thead>
                    <tr style="border-bottom: 2px solid #222;">
                        <th class="px-4 py-3 text-muted small">ORDER ID</th>
                        <th class="py-3 text-muted small">PELANGGAN</th>
                        <th class="py-3 text-muted small">ALAT</th>
                        <th class="py-3 text-end text-muted small">TOTAL HARGA</th>
                        <th class="py-3 text-center text-muted small">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $t)
                    <tr style="border-bottom: 1px solid #222;">
                        <td class="px-4 py-3 fw-bold text-secondary">#TRX-{{ str_pad($t->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-3 text-white">{{ $t->pelanggan->nama ?? 'Anonim' }}</td>
                        <td class="py-3 text-warning">{{ $t->alat->nama_alat ?? 'Alat Dihapus' }}</td>
                        <td class="py-3 text-end fw-bold text-success">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td class="py-3 text-center">
                            @if($t->status == 'dipinjam')
                                <span class="badge bg-warning text-dark">DIPINJAM</span>
                            @else
                                <span class="badge bg-success">SELESAI</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada aktivitas transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
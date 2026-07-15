<x-layout>
    <!-- Hero Section -->
    <div class="text-center py-5 mb-5 rounded shadow" style="background-color: #1a1a1a; border: 1px solid #333333;">
        <h1 class="text-warning fw-bold mb-3">LUMEN-K EQUIPMENT</h1>
        <p class="text-muted fs-5">Katalog Penyewaan Alat Fotografi & Videografi Terlengkap</p>
        
        @guest
            <a href="{{ route('login') }}" class="btn btn-warning text-dark fw-bold mt-3 px-4 py-2">Mulai Sewa Sekarang</a>
        @endguest
    </div>

    <!-- Katalog Section -->
    <div class="d-flex justify-content-between align-items-center border-bottom border-secondary pb-2 mb-4">
        <h4 class="text-white mb-0">Katalog Alat Tersedia</h4>
    </div>

    <div class="row g-4 mb-5">
        @forelse($alats as $alat)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm" style="background-color: #111111; border: 1px solid #333333;">
                    
                    <!-- Area Gambar -->
                    <div class="card-img-top bg-dark d-flex align-items-center justify-content-center" style="height: 180px; border-bottom: 1px solid #333333;">
                        @if($alat->gambar)
                            <!-- Asumsi gambar disimpan di folder storage publik nanti -->
                            <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="img-fluid h-100 w-100" style="object-fit: cover;">
                        @else
                            <span class="text-muted small">No Image Available</span>
                        @endif
                    </div>

                    <!-- Informasi Alat -->
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title text-white fw-bold mb-1">{{ $alat->nama_alat }}</h6>
                        <p class="card-text text-muted small mb-3">Merk: {{ $alat->merk }}</p>
                        
                        <h5 class="text-warning mb-3">
                            Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }}<span class="fs-6 text-muted fw-normal">/hari</span>
                        </h5>
                        
                        <!-- Tombol Aksi -->
                        <div class="mt-auto pt-3 border-top border-secondary d-flex justify-content-between align-items-center">
                            <span class="small text-muted">Stok: {{ $alat->stok }}</span>
                            
                            <!-- Tombol ini nanti akan kita hubungkan ke logika Keranjang (Fase 3) -->
                            <form action="#" method="POST">
                                @csrf
                                <button type="button" class="btn btn-outline-warning btn-sm">Tambah <i class="bi bi-cart-plus"></i></button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert py-4 text-center" style="background-color: #1a1a1a; border: 1px dashed #555;">
                    <h5 class="text-muted mb-0">Belum ada alat yang ditambahkan ke etalase.</h5>
                </div>
            </div>
        @endforelse
    </div>
</x-layout>
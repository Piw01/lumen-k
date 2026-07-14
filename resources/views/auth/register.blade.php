<x-layout>
    <div class="d-flex align-items-center justify-content-center my-5">
        <div class="col-md-6">
            <div class="card p-4 shadow" style="background-color: #1a1a1a; border: 1px solid #333333;">
                <h3 class="text-center text-warning mb-4">LUMEN-K REGISTER</h3>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label class="form-label text-white">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Email -->
                    <div class="mb-3">
                        <label class="form-label text-white">Email</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="mb-3">
                        <label class="form-label text-white">Password</label>
                        <input type="password" name="password" class="form-control bg-dark text-white border-secondary @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="mb-4">
                        <label class="form-label text-white">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control bg-dark text-white border-secondary" required>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 fw-bold text-dark">DAFTAR SEKARANG</button>
                </form>

                <p class="text-center mt-3 mb-0 text-muted fs-6">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-warning text-decoration-none">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>
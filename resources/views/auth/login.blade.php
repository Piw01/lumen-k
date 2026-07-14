<x-layout>
    <div class="d-flex align-items-center justify-content-center my-5">
        <div class="col-md-5">
            <div class="card p-4 shadow" style="background-color: #1a1a1a; border: 1px solid #333333;">
                <h3 class="text-center text-warning mb-4">LUMEN-K LOGIN</h3>
                
                @if(session('success'))
                    <div class="alert alert-success py-2 fs-6">{{ session('success') }}</div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-white">Email</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Password</label>
                        <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 mt-2 fw-bold text-dark">MASUK</button>
                </form>
                <p class="text-center mt-3 mb-0 text-muted fs-6">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-warning text-decoration-none">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>
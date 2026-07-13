<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lumen-K</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #111111; color: #ffffff; }
        .card { background-color: #1a1a1a; border: 1px solid #333333; }
        .btn-warning { background-color: #ffc107; color: #000000; font-weight: bold; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="col-md-4">
        <div class="card p-4 shadow">
            <h3 class="text-center text-warning mb-4">LUMEN-K LOGIN</h3>
            
            @if(session('success'))
                <div class="alert alert-success py-2 fs-6">{{ session('success') }}</div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
                </div>
                <button type="submit" class="btn btn-warning w-100 mt-2">MASUK</button>
            </form>
            <p class="text-center mt-3 mb-0 text-muted fs-6">Belum punya akun? <a href="{{ route('register') }}" class="text-warning text-decoration-none">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
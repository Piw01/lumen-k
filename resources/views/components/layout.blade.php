<!DOCTYPE html>
<html lang="id" data-bs-theme="dark" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lumen-K | Equipment Rental' }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        /* --- TEMA GELAP (BRIDGES) --- */
        :root {
            --bg-main: #0a0a0a;
            --bg-card: #111111;
            --text-main: #e5e5e5;
            --text-muted: #888888;
            --border-color: #333333;
            --accent-color: #facc15; 
            --accent-hover: #ca8a04;
            --btn-text: #000000;
            --nav-bg: rgba(10, 10, 10, 0.8);
            --table-header-bg: rgba(0, 0, 0, 0.5);
            --input-bg: #000000;
        }

        /* --- TEMA TERANG (UCA) --- */
        [data-bs-theme="light"] {
            --bg-main: #f4f6f8;
            --bg-card: #ffffff;
            --text-main: #212529;
            --text-muted: #6c757d;
            --border-color: #dee2e6;
            --accent-color: #0d6efd; /* Biru UCA */
            --accent-hover: #0b5ed7;
            --btn-text: #ffffff;
            --nav-bg: rgba(255, 255, 255, 0.9);
            --table-header-bg: rgba(240, 240, 240, 0.8);
            --input-bg: #ffffff;
        }

        /* --- TRANSISI SMOOTH --- */
        body, .card, .navbar, .ds-btn, .table, th, td, input, select, textarea, .form-control, .form-select {
            transition: background-color 0.4s ease, color 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
        }

        /* --- STYLING DASAR --- */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main) !important;
            color: var(--text-main) !important;
        }

        /* Navbar */
        .navbar {
            background-color: var(--nav-bg) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
        }
        .navbar-brand {
            font-weight: 800;
            letter-spacing: 2px;
            color: var(--accent-color) !important;
        }
        .nav-link {
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            font-weight: 600;
            color: var(--text-main) !important;
        }
        .nav-link:hover { color: var(--accent-color) !important; }

        /* Tombol Custom */
        .ds-btn {
            background-color: transparent;
            color: var(--accent-color);
            border: 1px solid var(--accent-color);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 0; 
        }
        .ds-btn:hover {
            background-color: var(--accent-color);
            color: var(--btn-text);
        }

        /* Card & Table */
        .card {
            background-color: var(--bg-card) !important;
            border-color: var(--border-color) !important;
        }
        .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--text-main);
            border-color: var(--border-color) !important;
        }
        .table thead tr { border-bottom: 2px solid var(--accent-color) !important; }
        .table tbody tr { border-bottom: 1px solid var(--border-color) !important; }
        .table td { color: var(--text-main) !important; }
        .table-header-custom { background-color: var(--table-header-bg) !important; }

        /* Form Inputs (Sangat Penting untuk Create/Edit) */
        .form-control, .form-select {
            background-color: var(--input-bg) !important;
            color: var(--text-main) !important;
            border-color: var(--border-color) !important;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); /* Focus outline biru netral */
            border-color: var(--accent-color) !important;
        }
        /* Custom class untuk styling form container agar ikut berubah tema */
        .form-container-custom {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        /* Class Warna Teks Custom */
        .text-warning-custom { color: var(--accent-color) !important; }
        .text-muted-custom { color: var(--text-muted) !important; }

        /* Tombol Switch Tema */
        #theme-toggle {
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            color: var(--text-main);
            transition: all 0.3s ease;
        }
        #theme-toggle:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg sticky-top px-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="fa-solid fa-camera-retro me-2"></i>LUMEN-K
            </a>
            <button class="navbar-toggler ds-btn border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/kategori">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="/alat">Katalog Alat</a></li>
                    <li class="nav-item"><a class="nav-link" href="/pelanggan">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/transaksi">Transaksi</a></li>
                    
                    <!-- TOMBOL SWITCH TEMA -->
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <button id="theme-toggle" title="Ganti Tema">
                            <i class="fa-solid fa-moon" id="theme-icon"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1 container py-5">
        {{ $slot }}
    </main>

    <footer class="py-4 text-center mt-auto" style="border-top: 1px solid var(--border-color); background-color: var(--bg-main);">
        <div class="container text-muted small">
            <p class="mb-1 fw-bold" style="letter-spacing: 1px; color: var(--text-main);">LUMEN-K EQUIPMENT RENTALS</p>
            <p class="mb-0 text-muted-custom">&copy; 2026 BRIDGES NETWORK / UCA - ALL RIGHTS RESERVED.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- LOGIKA JAVASCRIPT UNTUK TEMA -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const htmlRoot = document.getElementById('html-root');
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');

            // Ambil tema terakhir, atau default ke 'dark'
            const currentTheme = localStorage.getItem('theme') || 'dark';
            setTheme(currentTheme);

            themeToggleBtn.addEventListener('click', () => {
                const newTheme = htmlRoot.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                setTheme(newTheme);
            });

            function setTheme(theme) {
                htmlRoot.setAttribute('data-bs-theme', theme);
                localStorage.setItem('theme', theme);
                if (theme === 'light') {
                    themeIcon.classList.replace('fa-moon', 'fa-sun');
                } else {
                    themeIcon.classList.replace('fa-sun', 'fa-moon');
                }
            }
        });
    </script>
</body>
</html>
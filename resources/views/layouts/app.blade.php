<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporBanjir') — BPBD Kab. Bandung</title>

    {{-- Stylesheet utama aplikasi LaporBanjir dengan cache buster --}}
    <link rel="stylesheet" href="{{ asset('css/laporbanjir.css') }}?v={{ time() }}">
</head>
<body>

    {{-- HEADER & NAVIGASI --}}
    <header class="site-header">
        <div class="header-container">
            <div class="header-brand">
                <h1>LaporBanjir</h1>
                <span>BPBD Kabupaten Bandung</span>
            </div>
            
            <nav class="site-nav">
                <ul class="nav-menu">
                    <li><a href="{{ route('laporbanjir.create') }}" class="{{ request()->routeIs('laporbanjir.create', 'laporbanjir.store') ? 'active' : '' }}">Form Laporan</a></li>
                    <li><a href="{{ route('laporbanjir.index') }}" class="{{ request()->routeIs('laporbanjir.index') ? 'active' : '' }}">Daftar Laporan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    {{-- KONTEN UTAMA --}}
    <main class="page-wrapper">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="site-footer">
        <p>&copy; {{ date('Y') }} Sistem Pelaporan Banjir — BPBD Kabupaten Bandung. Prototipe Tanpa Database.</p>
    </footer>

    {{-- JavaScript aplikasi LaporBanjir --}}
    <script src="{{ asset('js/laporbanjir.js') }}?v={{ time() }}"></script>
</body>
</html>


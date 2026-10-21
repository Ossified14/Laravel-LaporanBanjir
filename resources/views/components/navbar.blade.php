<nav>
    <a href="{{ route('laporbanjir.create') }}" class="brand">🌊 LaporBanjir</a>
    <ul>
        <li>
            <a href="{{ route('laporbanjir.create') }}"
               class="{{ request()->routeIs('laporbanjir.create') ? 'active' : '' }}">
                Buat Laporan
            </a>
        </li>
        <li>
            <a href="{{ route('laporbanjir.index') }}"
               class="{{ request()->routeIs('laporbanjir.index') ? 'active' : '' }}">
                Daftar Laporan
            </a>
        </li>
    </ul>
</nav>
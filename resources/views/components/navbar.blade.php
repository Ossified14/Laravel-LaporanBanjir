<nav>
    <a href="{{ route('laporbanjir.create') }}" class="brand">LaporBanjir</a>
    <ul>
        <li>
            <a href="{{ route('laporbanjir.create') }}"
               class="{{ request()->routeIs('laporbanjir.create') ? 'active' : '' }}">
                Buat Laporan
            </a>
        </li>

        @auth
            <li>
                <a href="{{ route('laporbanjir.index') }}"
                   class="{{ request()->routeIs('laporbanjir.index') ? 'active' : '' }}">
                    Daftar Laporan
                </a>
            </li>
            <li>
                <a href="{{ route('profile') }}"
                   class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                    Profil Petugas
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-nav-logout">Logout</button>
                </form>
            </li>
        @endauth

        @guest
            <li>
                <a href="{{ route('login.form') }}"
                   class="{{ request()->routeIs('login.form') ? 'active' : '' }}">
                    Login
                </a>
            </li>
            <li>
                <a href="{{ route('register.form') }}"
                   class="{{ request()->routeIs('register.form') ? 'active' : '' }}">
                    Register
                </a>
            </li>
        @endguest
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard.index') }}">UD Kharisma Tunggal</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard.index') }}">KT</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-fire"></i> <span>Dasbor</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-home"></i> <span>Beranda</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('pengguna.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pengguna.index') }}">
                    <i class="fas fa-users"></i> <span>Data Pengguna</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('barang.index') }}">
                    <i class="fas fa-box"></i> <span>Data Barang</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('kategori_barang.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kategori_barang.index') }}">
                    <i class="fas fa-th-large"></i> <span>Kategori Barang</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('artikel.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('artikel.index') }}">
                    <i class="fas fa-newspaper"></i> <span>Data Artikel</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('tags.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tags.index') }}">
                    <i class="fas fa-tags"></i> <span>Data Tag Artikel</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('ulasan.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('ulasan.index') }}">
                    <i class="fas fa-comments"></i> <span>Data Ulasan</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('faq.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('faq.index') }}">
                    <i class="fas fa-question-circle"></i> <span>Data FAQ</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('partners.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('partners.index') }}">
                    <i class="fas fa-handshake"></i> <span>Data Partner</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pengaturan.index') }}">
                    <i class="fas fa-cog"></i> <span>Pengaturan</span>
                </a>
            </li>

            <li>
                <form id="logoutForm" action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                </form>
                <a href="#" onclick="logout()" class="nav-link"> <i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
            </li>
            <!-- Logout form -->
        </ul>
    </aside>
</div>

<script>
    function logout() {
        if (confirm('Apakah Anda yakin ingin keluar?')) {
            document.getElementById('logoutForm').submit();
        }
    }
</script>

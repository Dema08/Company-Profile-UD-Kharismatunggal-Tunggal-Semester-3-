 <!-- navbar start -->
 <nav class="navbar">
     <a href="{{ route('users.index') }}" class="navbar-logo">
         <img src="{{ asset('storage/' . $pengaturan->logo_toko) }}" alt="logo" class="logo" />
         Kharisma<span>Tunggal</span>.
     </a>

     <div>
         <div class="navbar-nav">
             <a href="{{ route('users.index') }}">Beranda</a>
             <a href="{{ route('users.about') }}">Tentang Kami</a>
             <a href="{{ route('users.barang') }}">Produk</a>
             <a href="{{ route('users.artikel') }}">Artikel</a>
             <a href="{{ route('users.faq') }}">Faq</a>
             @if (Auth::check())
                 @if (Auth::user()->role == 'admin')
                     <a href="{{ route('admin.dashboard.index') }}">Dasbor Admin</a>
                 @endif
                 <a href="#" onclick="logout()"><span>Keluar</span></a>
             @else
                 <a href="{{ route('auth.view') }}">Masuk</a>
             @endif
             <!-- <a href="#contact">Kontak</a> -->
         </div>

         <div class="navbar-extra">
             <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
             <!-- <a href="#" id="search"><i data-feather="search"></i></a>
        <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a> -->
         </div>
     </div>
 </nav>
 <form id="logoutForm" action="{{ route('auth.logout') }}" method="POST">
    @csrf
</form>
 <script>
     function logout() {
         if (confirm('Are you sure you want to log out?')) {
             document.getElementById('logoutForm').submit();
         }
     }
 </script>
 <!-- navbar end -->

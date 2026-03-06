@extends('users.layout.main')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>

    <!-- hero section start -->
    <section class="hero-nonhome" id="home">
        <main class="content" data-aos="zoom-in" data-aos-offset="300">
            <h1>Produk</h1>
            <p>Pakan ternak Berkualitas Tinggi untuk budidaya Ternak.</p>
        </main>
    </section>
    <!-- hero section end -->

    <!-- products section start -->
    <section class="products" id="products">
        <h1 data-aos="fade-up">Produk</h1>
        <h2 data-aos="fade-up"><span>Produk</span> Kami</h2>
        <p data-aos="fade-up">Berikut adalah beberapa produk terbaik kami.</p>
        <form action="{{ route('users.searchbarang') }}" method="GET">
            <div class="search-container">
                <div class="search-group" data-aos="fade-right">
                    <input type="text" value="{{ Request::get('search') }}" name="search" placeholder="Cari Barang">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                </div>
                <select name="kategori" onchange="submit()" data-aos="fade-left">
                    <option value="">Pilih Berdasarkan tag</option>
                    @foreach ($kategoris as $kategori)
                        <option {{ Request::get('kategori') == $kategori->id_kategori_barang ? 'selected' : '' }}
                            value="{{ $kategori->id_kategori_barang }}">{{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                <select name="urutkan" onchange="submit()" data-aos="fade-left">
                    <option value="">Urutkan</option>
                    <option {{ Request::get('urutkan') == 'asc' ? 'selected' : '' }} value="asc">Ascending</option>
                    <option {{ Request::get('urutkan') == 'desc' ? 'selected' : '' }} value="desc">Descending</option>
                </select>
            </div>
        </form>
        <div class="row" data-aos="fade-up" data-aos-offset="150">
            @foreach ($barangs as $barang)
                <div class="product-card"
                    onclick="window.location.href='{{ route('users.barangdetail', Crypt::encrypt($barang->id_barang)) }}'">
                    <div class="product-image">
                        @if ($barang->gallery->count() >= 1)
                            @php
                                $imagePath = public_path('storage/' . $barang->gallery->first()->path_gambar);
                            @endphp
                            @if (file_exists($imagePath))
                                <img lazy src="{{ asset('storage/' . $barang->gallery->first()->path_gambar) }}"
                                    alt="Gambar Barang">
                            @else
                                <img lazy src="{{ asset('user_assets/img/no_image.png') }}" alt="Gambar Barang">
                            @endif
                        @else
                            <img lazy src="{{ asset('user_assets/img/no_image.png') }}" alt="Gambar Barang">
                        @endif
                    </div>
                    <div class="product-content">
                        <h3>{{ $barang->nama_barang }}</h3>
                        <p>Rp <span>{{ number_format($barang->harga_barang, 0, ',', '.') }}
                            </span></p>
                        <div class="product-des">
                            {{ Str::limit($barang->deskripsi_singkat, 100) }}
                            <a href="{{ route('users.barangdetail', Crypt::encrypt($barang->id_barang)) }}"><span> Lihat
                                    Selengkapnya...</span></a>
                        </div>
                    </div>
                </div>
            @endforeach
            <!--  -->
        </div>
        <br /><br /><br /><br /><br />
    </section>
    <!-- products section end -->

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection

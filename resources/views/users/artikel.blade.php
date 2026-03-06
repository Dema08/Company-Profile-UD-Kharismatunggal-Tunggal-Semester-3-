@extends('users.layout.main')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>

    <!-- hero section start -->
    <section class="hero-nonhome" id="home">
        <main class="content" data-aos="zoom-in" data-aos-offset="300">
            <h1>Artikel</h1>
            <p>Pakan ternak Berkualitas Tinggi untuk budidaya Ternak.</p>
        </main>
    </section>
    <!-- hero section end -->

    <!-- products section start -->
    <section class="products" id="products">
        <h2 data-aos="fade-up">
            <span>Artikel</span> Terbaru
        </h2>
        <p data-aos="fade-up">
            Temukan artikel-artikel terbaru kami di sini.
        </p>
        <form action="{{ route('users.searchartikel') }}" method="GET">
            <div class="search-container">
                <div class="search-group" data-aos="fade-right">
                    <input type="text" name="search" placeholder="Cari Artikel">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                </div>

                <select name="tag" onchange="submit()" data-aos="fade-left">
                    <option value="">Pilih Berdasarkan tag</option>
                    @foreach ($tagartikel as $tag)
                        <option {{ Request::get('tag') == $tag->id_tag_artikel ? 'selected' : '' }}
                            value="{{ $tag->id_tag_artikel }}">{{ $tag->nama_tag }}
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
            @if ($artikels != null)
                @foreach ($artikels as $artikel)
                    <a href="{{ route('users.artikeldetail', Crypt::encrypt($artikel->id_artikel)) }}" class="product-card">
                        <div class="product-image">
                            @if ($artikel->gambar != null)
                                <img lazy src="{{ url('storage/' . $artikel->gambar) }}" alt="" />
                            @else
                                <img lazysrc="{{ asset('user_assets/img/no_image.png') }}" alt="Gambar artikel">
                            @endif

                        </div>
                        <div class="product-content">
                            <h3>{{ $artikel->judul }}</h3>
                            <div class="product-des">
                                <p>{{ Str::limit($artikel->deskripsi_singkat, 50) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </section>
    <!-- products section end -->

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

@endsection

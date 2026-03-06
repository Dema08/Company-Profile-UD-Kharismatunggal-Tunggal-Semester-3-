@extends('users.layout.main')
@section('content')
    @php
        $pengaturan = \App\Models\Pengaturan::where('id_pengaturan', 1)->first();
    @endphp
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    {{-- carousel II start --}}
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>

    <div class="carousel">
        <div class="list">
            @if ($heroimages->count() >= 1)
                @foreach ($heroimages as $heroimage)
                    <div class="item">
                        <img lazy src="{{ asset('storage/' . $heroimage->image) }}">
                        <div class="introduce">
                            <div class="title">Solusi Kesehatan</div>
                            <div class="title">Ternak & Gizi</div>
                            <div class="topic">Berkualitas</div>
                            <div class="des">
                                kebutuhan lengkap untuk memenuhi nutrisi ternak Anda.
                            </div>
                            <button class="seeMore">
                                <a href="{{ route('users.about') }}">LIHAT SELENGKAPNYA &#8599</a>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="item">
                    <img lazy src="{{ asset('user_assets/img/4.png') }}">
                    <div class="introduce">
                        <div class="title">Solusi Kesehatan</div>
                        <div class="title">Ternak & Gizi</div>
                        <div class="topic">Berkualitas</div>
                        <div class="des">
                            kebutuhan lengkap untuk memenuhi nutrisi ternak Anda.
                        </div>
                        <button class="seeMore">
                            <a href="{{ route('users.about') }}">LIHAT SELENGKAPNYA &#8599</a>
                        </button>
                    </div>
                </div>
            @endif

        </div>
        <div class="arrows">
            <button id="prev" class="prev-carousel">
                < </button>
                    <button id="next" class="next-carousel">></button>
                    <button id="back" class="barang-carousel">
                        <a href="{{ route('users.barang') }}">Lihat Semua Produk &#8599
                        </a></button>
        </div>
    </div>
    {{-- carousel II end --}}

    <!-- products section start -->
    <section class="products" id="products">
        <main>
            <h1 data-aos="fade-up" data-aos-offset="200">Produk </h1>
            <h2 data-aos="fade-up" data-aos-offset="200"><span>Produk</span> Kami</h2>
            <p data-aos="fade-up" data-aos-offset="150">Berikut adalah beberapa produk terbaik kami.</p>
        </main>

        <div class="row" data-aos="fade-up" data-aos-offset="300">
            <!--  -->
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
                            {{ Str::limit($barang->deskripsi_singkat, 50) }}
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

    <!-- about section start -->
    <header class="about-header">
        <div class="header-title" data-aos="fade-right" data-aos-offset="300">
            <h2>Kenapa harus Kharisma Tunggal?</h2>
            <h1>Tentang <br> <span>Kharisma Tunggal</span></h1>
        </div>
        <p data-aos="fade-left" data-aos-offset="300">UD Kharisma Tunggal adalah perusahaan yang bergerak di bidang produksi
            pakan ternak dengan misi menyediakan solusi nutrisi</p>
        <p data-aos="fade-left" data-aos-offset="300">Kami mengutamakan kualitas produk melalui pemilihan bahan baku
            berkualitas tinggi dan inovasi teknologi pellet.
        </p>
    </header>
    <section class="features">
        <div class="container" data-aos="fade-up" data-aos-offset="300">
            <div class="feature-item">
                <img lazy src="{{ asset('user_assets/img/about/quality.png') }}" alt="">
                <div class="feature-detail">
                    <h3>Kualitas terjamin</h3>
                    <p>Menggunakan bahan baku berkualitas tinggi dan proses produksi modern.</p>
                </div>
            </div>
            <div class="feature-item">
                <img lazy src="{{ asset('user_assets/img/about/price.png') }}" alt="">
                <div class="feature-detail">
                    <h3>Harga kompetitif</h3>
                    <p>Kami menawarkan harga yang kompetitif tanpa mengorbankan kualitas.</p>
                </div>
            </div>
            <div class="feature-item">
                <img lazy src="{{ asset('user_assets/img/about/formula.png') }}" alt="">
                <div class="feature-detail">
                    <h3>Formulasi lengkap</h3>
                    <p>Pakan kami diformulasikan oleh ahli nutrisi hewan untuk memenuhi kebutuhan nutrisi spesifik setiap
                        jenis hewan.
                    </p>
                </div>
            </div>
            <div class="feature-item">
                <img lazy src="{{ asset('user_assets/img/about/service.png') }}" alt="">
                <div class="feature-detail">
                    <h3>Layanan prima</h3>
                    <p>Tim kami siap memberikan layanan konsultasi dan dukungan teknis kepada peternak.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->

    {{-- testimonial start --}}
    <section class="testimonials">
        <main>
            <h1 data-aos="fade-up">Testimoni</h1>
            <h2 data-aos="fade-up"><span>Ulasan</span> Pelanggan Kami</h2>
        </main>

        <!-- Slider main container -->
        <div class="swiper" data-aos="fade-up">
            @php
                $chunk = collect($ulasans)->chunk(3);
            @endphp
            <div class="swiper-wrapper ">

                @foreach ($chunk as $slide)
                    <div class="swiper-slide">
                        <div class="testimonial-container">
                            @foreach ($slide as $ulasan)
                                <div class="testimonial">
                                    <div class="testimonial-header">
                                        <img lazy src="{{ asset('user_assets/img/user.png') }}" alt=""
                                            class="avatar" />
                                        <div class="details">
                                            <h3 class="name">
                                                {{ $ulasan->nama_pengguna != null ? $ulasan->nama_pengguna : $ulasan->pengguna->nama_pengguna }}                                            </h3>
                                            <div class="product-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $ulasan->jumlah_rating)
                                                        <i data-feather="star" class="star-full"></i>
                                                    @else
                                                        <i data-feather="star" class="star-notfull"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="testimonial-text">
                                        {{ $ulasan->text }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <p class="footer-text" data-aos="fade-up" data-aos-offset="-50" data-aos-duration="1000">Dipercaya oleh lebih
            dari {{ count($ulasans) }} pelanggan</p>
    </section>
    {{-- testimonial end --}}

    <!-- contact section start -->
    <section id="contact" class="contact">
        <div class="row">
            <img lazy src="{{ asset('user_assets/img/sapi.jpg') }}" alt="img" class="image-contact"
                data-aos="fade-right" data-aos-duration="1000" />
            <form action="" data-aos="fade-left" data-aos-duration="1000">
                <div class="title">
                    <h2><span>Hubungi</span> Kami</h2>
                    <p>Mari Kita Budayakan Ternak yang Sehat</p>
                </div>
                <div class="input-group">
                    <input type="text" id="name" placeholder="Nama lengkap" />
                </div>
                <div class="input-group">
                    <textarea id="message" placeholder="Pesan anda"></textarea>
                </div>
                <button type="submit" class="btn" onclick="openWhatsApp()">kirim</button>
            </form>
        </div>
    </section>
    <!-- contact section end -->


    <!-- my javascript -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('user_assets/js/carousel.js') }}"></script>
    <script>
        AOS.init();
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            autoplay: {
                delay: 3000, // in milliseconds
                disableOnInteraction: false, // keep autoplay on user interaction
            },
        });

        function openWhatsApp() {
            var name = document.getElementById("name").value;
            var whatsappNumber = {{ $pengaturan->no_hp_toko }};
            var message = document.getElementById("message").value;

            // Format WhatsApp message
            var whatsappMessage = encodeURIComponent("Halo, saya " + name + ". " + message);

            // Create WhatsApp link
            var whatsappUrl = "https://wa.me/" + whatsappNumber + "?text=" + whatsappMessage;

            // Open WhatsApp link
            window.open(whatsappUrl, '_blank');

            // Clear form fields after sending
            document.getElementById("name").value = "";
            document.getElementById("message").value = "";
        }
    </script>


@endsection

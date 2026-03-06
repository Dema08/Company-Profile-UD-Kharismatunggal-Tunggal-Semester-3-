@extends('users.layout.main')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>

    <!-- hero section start -->
    <section class="hero-nonhome" id="home">
        <main class="content" data-aos="zoom-in" data-aos-offset="300">
            <h1>Tentang Kami</h1>
            <p>Pakan ternak Berkualitas Tinggi untuk budidaya Ternak.</p>
        </main>
    </section>
    <!-- hero section end -->

    {{-- NEW about section start --}}
    {{-- header start --}}
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
        <div class="container" data-aos-offset="300">
            <div class="feature-item" data-aos="fade-right">
                <img lazy src="{{ asset('user_assets/img/about/quality.png') }}" alt="">
                <div class="feature-detail">
                    <h3>Kualitas terjamin</h3>
                    <p>Menggunakan bahan baku berkualitas tinggi dan proses produksi modern.</p>
                </div>
            </div>
            <div class="feature-item" data-aos="fade-up">
                <img lazy src="{{ asset('user_assets/img/about/price.png') }}" alt="">
                <div class="feature-detail">
                    <h3>Harga kompetitif</h3>
                    <p>Kami menawarkan harga yang kompetitif tanpa mengorbankan kualitas.</p>
                </div>
            </div>
            <div class="feature-item" data-aos="fade-up">
                <img lazy src="{{ asset('user_assets/img/about/formula.png') }}" alt="">
                <div class="feature-detail">
                    <h3>Formulasi lengkap</h3>
                    <p>Pakan kami diformulasikan oleh ahli nutrisi hewan untuk memenuhi kebutuhan nutrisi spesifik setiap
                        jenis hewan.
                    </p>
                </div>
            </div>
            <div class="feature-item" data-aos="fade-left">
                <img lazy src="{{ asset('user_assets/img/about/service.png') }}" alt="">
                <div class="feature-detail">
                    <h3>Layanan prima</h3>
                    <p>Tim kami siap memberikan layanan konsultasi dan dukungan teknis kepada peternak.
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- header end --}}


    {{-- image start --}}
    <section class="main-image">
        <div class="container">
            <img lazy class="img-1" src="{{ asset('user_assets/img/tentang-kami.jpg') }}" alt="" data-aos="fade-right">
            <div class="img-des" data-aos="fade-left">
                <h1>UD. Kharisma Tunggal</h1>
                <h2>Inovasi Ternak untuk <span>Produktivitas Optimal.</span></h2>
                <p>UD Kharisma Tunggal merupakan perusahaan yang fokus pada produksi dan distribusi pakan ternak berkualitas tinggi. Kami berkomitmen untuk menghadirkan solusi nutrisi optimal melalui inovasi teknologi dan pemilihan bahan baku unggulan.</p>
            </div>
        </div>
    </section>
    {{-- image end --}}

    {{-- goals start --}}
    <section class="goals">
        <main data-aos="zoom-in-up" data-aos-offset="300">
            <h1>Visi & Misi <span>Perusahaan kami</span></h1>
        </main>
        <div class="container" data-aos="fade-up" data-aos-duration="500">
            <div class="visi" data-aos="fade-right">
                <h3>Visi</h3>
                <p>Menjadi perusahaan pakan ternak terkemuka di Indonesia yang memberikan kontribusi nyata bagi peningkatan
                    kesejahteraan peternak dan konsumen.</p>
            </div>
            <div class="misi" data-aos="fade-left">
                <h3>Misi</h3>
                <p>Menjadi perusahaan pakan ternak terkemuka di Indonesia yang memberikan kontribusi nyata bagi peningkatan
                    kesejahteraan peternak dan konsumen.</p>
            </div>
        </div>
    </section>
    {{-- goals end --}}

    {{-- values start --}}
    <section class="values">
        <main data-aos="zoom-in-up" data-aos-offset="300">
            <h1>Nilai - nilai <span>Perusahaan kami</span></h1>
        </main>
        <div class="container" data-aos="fade-up" data-aos-duration="500">
            <div class="value" data-aos="fade-right">
                <img lazy src="{{ asset('user_assets/img/about/w-integrity.png') }}" alt="">
                <p>Integritas</p>
            </div>
            <div class="value" data-aos="fade-up">
                <img lazy src="{{ asset('user_assets/img/about/w-quality.png') }}" alt="">
                <p>Kualitas</p>
            </div>
            <div class="value" data-aos="fade-up">
                <img lazy src="{{ asset('user_assets/img/about/w-innovation.png') }}" alt="">
                <p>Inovasi</p>
            </div>
            <div class="value" data-aos="fade-left">
                <img lazy src="{{ asset('user_assets/img/about/w-Vector.png') }}" alt="">
                <p>Pelayanan</p>
            </div>
        </div>
    </section>
    {{-- values end --}}
    {{-- NEW about section end --}}

    <!-- partner section start -->
    <section class="products" id="products">
        <main>
            <h1 data-aos="fade-up">Mitra</h1>
            <h2 data-aos="fade-up"><span>Mitra</span> Kami</h2>
            <p data-aos="fade-up">Produk kami telah dipercaya oleh.</p>
        </main>

        <div class="row" data-aos="fade-up" data-aos-offset="300">
            @foreach ($partners as $partner)
                <div class="product-card">
                    <div class="product-image">
                        <img lazy src="{{ asset('storage/' . $partner->gambar) }}" alt="" />
                    </div>
                    <div class="product-content">
                        <h3>{{ $partner->nama }}</h3>
                    </div>
                </div>
            @endforeach
            <!--  -->
        </div>
        <br /><br /><br /><br /><br />
    </section>
    <!-- partner section end -->

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection

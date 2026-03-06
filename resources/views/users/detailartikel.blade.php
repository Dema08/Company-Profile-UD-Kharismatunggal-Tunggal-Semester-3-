@extends('users.layout.main')

@section('content')
    <!-- hero section start -->
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>

    <section class="hero-nonhome" id="home">
        <main class="content" data-aos="fade-right" data-aos-offset="300">
            <h1>{{ $artikel->judul }}</h1>
        </main>
    </section>
    <!-- hero section end -->

    <!-- products section start -->
    <section class="artikel">
        <div class="container">
            <div class="artikel-card">
                <div class="row" style="display: flex">
                    <div class="col-9 mobile">
                        <img lazy src="{{ asset('storage/' . $artikel->gambar) }}" class="img-thumbnail" alt="" />
                        <div class="artikel-content">
                            <p> {!! nl2br($artikel->isi) !!}</p>
                        </div>
                        <div class="button-group">
                            <div class="col-9">
                                @foreach ($artikel->tags as $tag)
                                    <button class="button">{{ $tag->nama_tag }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mobile">
                        <div class="artikel-kategori">
                            <h3 class="artikel-judul">Kategori</h3>
                            <div class="category-list">
                                @foreach ($tagartikels as $tagartikel)
                                    <div class="category-item">{{ $tagartikel->nama_tag }} <span>({{ $tagartikel->artikels_count }})</span></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="artikel-latestpost">
                            <h3 class="artikel-judul">Postingan Terbaru</h3>
                            <div class="latestpost-list">
                                @foreach ($latestposts as $latestpost)
                                    <a href="{{ route('users.artikeldetail', Crypt::encrypt($latestpost->id_artikel)) }}">
                                        <div class="post-item">
                                            <div class="post-title">
                                                {{ $latestpost->judul }}
                                            </div>
                                            <div class="post-meta">
                                                <span
                                                    class="post-date">{{ \Carbon\Carbon::parse($latestpost->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- products section end -->
@endsection

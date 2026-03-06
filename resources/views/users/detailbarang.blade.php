@extends('users.layout.main')

@section('content')
    @php
        $pengaturan = \App\Models\Pengaturan::where('id_pengaturan', 1)->first();
    @endphp
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- hero product section start -->
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>

    <section class="main-detail">
        <div class="default gallery">
            <div class="main-img">
                @php
                    // Check if the gallery relationship is not empty
                    $mainGallery = $barang->gallery->first();
                @endphp

                @if ($mainGallery && file_exists(public_path('storage/' . $mainGallery->path_gambar)))
                    <img lazy class="active" src="{{ asset('storage/' . $mainGallery->path_gambar) }}" alt="Gambar Barang" />
                @else
                    <img lazy class="active" src="{{ asset('user_assets/img/no_image.png') }}" alt="Gambar Barang" />
                @endif

                @if ($barang->gallery && $barang->gallery->count() > 1)
                    @foreach ($barang->gallery->skip(1) as $gallery)
                        @php
                            $otherImagePath = public_path('storage/' . $gallery->path_gambar);
                        @endphp
                        @if (file_exists($otherImagePath))
                            <img lazy src="{{ asset('storage/' . $gallery->path_gambar) }}" alt="Gambar Barang">
                        @else
                            <img lazy src="{{ asset('user_assets/img/no_image.png') }}" alt="Gambar Barang" />
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="thumb-list">
                @if ($barang->gallery && $barang->gallery->count() > 0)
                    <div class="active">
                        @php
                            $mainGallery = $barang->gallery->first(); // Store the first image
                            $mainImagePath = public_path('storage/' . $mainGallery->path_gambar);
                        @endphp

                        @if ($mainGallery && file_exists($mainImagePath))
                            <img src="{{ asset('storage/' . $mainGallery->path_gambar) }}" alt="product-img" />
                        @else
                            <img lazy src="{{ asset('user_assets/img/no_image.png') }}" alt="Gambar Barang"
                                class="main-image" />
                        @endif
                    </div>

                    @if ($barang->gallery->count() > 1)
                        @foreach ($barang->gallery->skip(1) as $gallery)
                            @php
                                $otherImagePath = public_path('storage/' . $gallery->path_gambar);
                            @endphp
                            <div>
                                @if (file_exists($otherImagePath))
                                    <img src="{{ asset('storage/' . $gallery->path_gambar) }}" alt="Gambar Barang">
                                @else
                                    <img src="{{ asset('user_assets/img/no_image.png') }}" alt="Gambar Barang" />
                                @endif
                            </div>
                        @endforeach
                    @endif
                @endif

            </div>
        </div>
        <div class="itemcontent">
            <h2 class="product-name">{{ $barang->nama_barang }}</h2>
            <div class="row">
                <p class="rating-point">{{ $barang->averageRating() ?? 0 }}<small>/5</small></p>
                <div class="product-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $barang->averageRating())
                            <i data-feather="star" class="star-full"></i>
                        @else
                            <i data-feather="star" class="star-notfull"></i>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="price-info">
                <div class="price">
                    <span class="current-price">Rp. {{ number_format($barang->harga_barang, 0, ',', '.') }}</span>
                </div>
            </div>
            <p class="product-desc">
                {{ $barang->deskripsi_singkat }}
            </p>
            <div class="add-to-cart-container">
                <a href="https://wa.me/{{ $pengaturan->no_hp_toko }}" class="btn whatsaap-btn" target="_blank">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"
                                fill="#69707D" fill-rule="nonzero" />
                        </svg>
                    </span>
                    <span>Pesan via WhatsApp</span>
                </a>
                <a href="{{ $barang->link_shopee }}" class="btn shopee-btn" target="_blank">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 20">
                            <path
                                d="M20.925 3.641H3.863L3.61.816A.896.896 0 0 0 2.717 0H.897a.896.896 0 1 0 0 1.792h1l1.031 11.483c.073.828.52 1.726 1.291 2.336C2.83 17.385 4.099 20 6.359 20c1.875 0 3.197-1.87 2.554-3.642h4.905c-.642 1.77.677 3.642 2.555 3.642a2.72 2.72 0 0 0 2.717-2.717 2.72 2.72 0 0 0-2.717-2.717H6.365c-.681 0-1.274-.41-1.53-1.009l14.321-.842a.896.896 0 0 0 .817-.677l1.821-7.283a.897.897 0 0 0-.87-1.114ZM6.358 18.208a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm10.015 0a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm2.021-7.243-13.8.81-.57-6.341h15.753l-1.383 5.53Z"
                                fill="#69707D" fill-rule="nonzero" />
                        </svg>
                    </span>
                    <span>Pesan via Shopee</span>
                </a>
            </div>
        </div>
    </section>
    <!-- hero product section end -->

    <!-- description section start -->
    @php
        $kategoriNames = $barang->kategori->pluck('kategoriBarang.nama')->implode(', ');
    @endphp
    <section class="description">
        <h2>Deskripsi Produk</h2>
        <br>
        <p class="description-kategori">Kategori : <span class="text-primary">{{ $kategoriNames }}</span></p>
        {!! $barang->deskripsi !!}
    </section>
    <!-- description section end -->

    <!-- rating section start -->
    <section id="rating" class="rating">
        <h2>Penilaian Produk</h2>
        <div class="row">
            <div class="rating-container">
                <h2 class="text-primary">{{ $barang->averageRating() ?? '0' }} <small class="text-secondary">/ 5</small>
                </h2>
                <div class="product-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $barang->averageRating())
                            <i data-feather="star" class="star-full"></i>
                        @else
                            <i data-feather="star" class="star-full"></i>
                        @endif
                    @endfor
                </div>
            </div>
            @php
                // Get the collection of approved reviews
                $approvedReviews = $barang->ulasan->where('status', 'terima');

                $ratings = [
                    5 => $approvedReviews->where('jumlah_rating', 5)->count(),
                    4 => $approvedReviews->where('jumlah_rating', 4)->count(),
                    3 => $approvedReviews->where('jumlah_rating', 3)->count(),
                    2 => $approvedReviews->where('jumlah_rating', 2)->count(),
                    1 => $approvedReviews->where('jumlah_rating', 1)->count(),
                ];

                $totalReviews = $approvedReviews->count();
                $collectedValues = [];

                $collectedValues = [];

                if ($totalReviews > 0) {
                    foreach ($ratings as $rating => $value) {
                        $percentage = ($value / $totalReviews) * 100;
                        $collectedValues[] = $percentage;
                    }
                } else {
                    foreach ($ratings as $rating => $value) {
                        $collectedValues[] = 0;
                    }
                }
            @endphp
            <div class="rating-allstars">
                <div class="rating-distribution">
                    <div class="rating-bar">
                        <div class="stars">★★★★★</div>
                        <div class="bar">
                            <div class="bar-fill" style="width: {{ $collectedValues[0] }}%;"></div>
                        </div>
                        <div class="bar-text">{{ $ratings[5] }}</div>
                    </div>
                    <div class="rating-bar">
                        <div class="stars">★★★★☆</div>
                        <div class="bar">
                            <div class="bar-fill" style="width: {{ $collectedValues[1] }}%;"></div>
                        </div>
                        <div class="bar-text">{{ $ratings[4] }}</div>
                    </div>
                    <div class="rating-bar">
                        <div class="stars">★★★☆☆</div>
                        <div class="bar">
                            <div class="bar-fill" style="width: {{ $collectedValues[2] }}%;"></div>
                        </div>
                        <div class="bar-text">{{ $ratings[3] }}</div>
                    </div>
                    <div class="rating-bar">
                        <div class="stars">★★☆☆☆</div>
                        <div class="bar">
                            <div class="bar-fill" style="width: {{ $collectedValues[3] }}%;"></div>
                        </div>
                        <div class="bar-text">{{ $ratings[2] }}</div>
                    </div>
                    <div class="rating-bar">
                        <div class="stars">★☆☆☆☆</div>
                        <div class="bar">
                            <div class="bar-fill" style="width: {{ $collectedValues[4] }}%;"></div>
                        </div>
                        <div class="bar-text">{{ $ratings[1] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="komentar-action">
            <div class="button-group">
                <button id="tambahKomentar" onclick="window.dialog.showModal();" class="btn primary-btn btn-start">
                    <span>Tambah Komentar <i class="fas fa-plus"></i></span>
                </button>
            </div>

            @php
                $ulasanbarangQuery = $barang->ulasan()->where('status', 'terima');
                if ($ulasanbarangQuery->exists()) {
                    $ulasanbarang = $ulasanbarangQuery->paginate(3);
                } else {
                    $ulasanbarang = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 3);
                }
            @endphp
            @foreach ($ulasanbarang as $ulasan)
                <div class="review-container">
                    <div class="review-header">
                        <div class="name-section">
                            <span class="stars">
                                @for ($i = 1; $i <= $ulasan->jumlah_rating; $i++)
                                    <i class="fas fa-star star-full"></i>
                                @endfor
                            </span>
                            <br>
                            <span class="review-author">Oleh:
                                {{ $ulasan->pengguna != null ? $ulasan->pengguna->nama_pengguna : $ulasan->nama_pengguna }}</span>
                        </div>
                        <div class="review-date">{{ \Carbon\Carbon::parse($ulasan->created_at)->format('d/m/Y') }}</div>
                    </div>
                    <div class="review-content">
                        {{ $ulasan->text }}
                    </div>
                    <div class="separator"></div>
                </div>
            @endforeach

            {{ $ulasanbarang->links('users.layout.pagination') }}
        </div>

    </section>
    <!-- rating section end -->
    <!-- others product section start -->
    <section class="more-products" id="products">
        <div class="others-product-section">
            <h2>Produk Lainnya</h2>
        </div>

        <div class="swiper">

            @php
                $chunk = collect($baranglainya)->chunk(3);
            @endphp
            <div class="swiper-wrapper ">
                @foreach ($chunk as $slide)
                    <div class="swiper-slide">

                        <div class="row-detailproduct">
                            @foreach ($slide as $baranglain)
                                <div class="product-card"
                                    onclick="window.location.href='{{ route('users.barangdetail', Crypt::encrypt($baranglain->id_barang)) }}'">
                                    <div class="product-image">
                                        @if ($baranglain->gallery->count() >= 1)
                                            @php
                                                $imagePath = public_path(
                                                    'storage/' . $baranglain->gallery->first()->path_gambar,
                                                );
                                            @endphp
                                            @if (file_exists($imagePath))
                                                <img lazy
                                                    src="{{ asset('storage/' . $baranglain->gallery->first()->path_gambar) }}"
                                                    alt="Gambar Barang">
                                            @else
                                                <img lazy src="{{ asset('user_assets/img/no_image.png') }}"
                                                    alt="Gambar Barang">
                                            @endif
                                        @else
                                            <img lazy src="{{ asset('user_assets/img/no_image.png') }}"
                                                alt="Gambar Barang">
                                        @endif
                                    </div>
                                    <div class="product-content">
                                        <h3>{{ $baranglain->nama_barang }}</h3>
                                        <p>Rp <span>{{ number_format($baranglain->harga_barang, 0, ',', '.') }}
                                            </span></p>
                                        <div class="product-des">
                                            {{ Str::limit($baranglain->deskripsi_singkat, 100) }}
                                            <a href=""><span> Lihat Selengkapnya...</span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
    <div class="modal-container">

        <dialog id="dialog">
            <h2>Berikan Komentar Anda</h2>

            <form action="{{ route('store.ulasan', Crypt::encrypt($barang->id_barang)) }}" method="post">
                @csrf
                <div class="inp-rating">
                    <label>
                        <input checked type="radio" name="jumlah_rating" value="1" />
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="jumlah_rating" value="2" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="jumlah_rating" value="3" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="jumlah_rating" value="4" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="jumlah_rating" value="5" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                </div>
                @if (Auth::user() == null)
                    <div>
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="nama_pengguna" placeholder="Masukkan nama anda"
                            required>
                    </div>
                @endif
                <div>
                    <label for="comment">Komentar:</label>
                    <textarea id="comment" name="komentar" rows="4" placeholder="Tulis komentar anda"></textarea>
                </div>
                <button class="btn whatsaap-btn">Kirim</button>
            </form>
            <button onclick="window.dialog.close();" aria-label="close" class="x">
                ❌
            </button>
        </dialog>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Anda hanya bisa menambahkan komentar 2 menit lagi!",
            });
        </script>
    @endif
    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            autoplay: {
                delay: 3000, // in milliseconds
                disableOnInteraction: false, // keep autoplay on user interaction
            },
        });
    </script>

@endsection

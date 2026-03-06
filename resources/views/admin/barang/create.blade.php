@extends('admin.layout.main')

@section('content')
    @push('style')
        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                color: #000;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/summernote/summernote-bs4.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    @endpush
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Barang</h1>
            <div class="section-header-breadcrumb">
                <!-- Breadcrumb jika diperlukan -->
            </div>
        </div>

        <div class="section-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center">Tambah Data Barang</h4>
                    <form action="{{ route('barang.store') }}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input value="{{ old('nama_barang') }}" required type="text" class="form-control"
                                        name="nama_barang" placeholder="Masukkan Nama Barang">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="harga_barang">Harga Barang</label>
                                    <input value="{{ old('harga_barang') }}" required type="number" step="0.01"
                                        class="form-control" name="harga_barang" placeholder="Masukkan Harga Barang">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="deskripsi_singkat">Deskripsi Singkat</label>
                                    <textarea required class="form-control" name="deskripsi_singkat" placeholder="Masukkan Deskripsi Barang">{{ old('deskripsi_singkat') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="summernote" name="deskripsi" placeholder="Masukkan deskripsi" required>{{ old('deskripsi') }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="link_shopee">Link Shopee</label>
                                    <input value="{{ old('link_shopee') }}" type="url" class="form-control"
                                        name="link_shopee" placeholder="Masukkan Link Shopee">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kategori_id">Kategori Barang</label>
                                    <select class="js-example-basic-multiple form-control" placeholder="Pilih Kategori"
                                        multiple name="id_kategori_barang[]" required>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id_kategori_barang }}"
                                                {{ old('id_kategori_barang') == $kategori->id_kategori_barang ? 'selected' : '' }}>
                                                {{ $kategori->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="images">Gambar</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    <small class="form-text text-muted">Pilih beberapa gambar untuk diunggah.</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="is_visible">Tampilkan Produk</label>
                                    <select name="is_visible" id="" class="form-control">
                                        <option value="1">Tampilkan Produk</option>
                                        <option value="0">Sembunyikan Produk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end text-right">
                            <a href="{{ route('barang.index') }}" class="btn btn-light">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            $(".summernote").summernote({
                dialogsInBody: true,
                minHeight: 250,
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="{{ asset('admin_assets/modules/summernote/summernote-bs4.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({
                    placeholder: "Pilih Kategori",
                });
            });
        </script>
    @endpush
@endsection

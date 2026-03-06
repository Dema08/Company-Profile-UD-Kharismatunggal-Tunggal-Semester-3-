@extends('admin.layout.main')

@section('content')
    @push('style')
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/jquery-selectric/selectric.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    @endpush

    <section class="section">
        <div class="section-header">
            <h1>Tambah Partner</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('partners.index') }}">Partner Kami</a></div>
                <div class="breadcrumb-item">Tambah Partner</div>
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
                    <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Partner</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar Partner</label>
                            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" id="gambar">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_visible">Tampilkan Partner</label>
                            <select name="is_visible" class="form-control" required>
                                <option value="1">Tampilkan Partner</option>
                                <option value="0">Sembunyikan Partner</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('partners.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <!-- JS Libraries -->
        <script src="{{ asset('admin_assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 jika diperlukan
                $('.js-example-basic-multiple').select2({
                    placeholder: "Pilih Kategori",
                });
            });
        </script>
    @endpush
@endsection

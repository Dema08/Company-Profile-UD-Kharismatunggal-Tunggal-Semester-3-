@extends('admin.layout.main')

@section('content')
    @push('style')
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/jquery-selectric/selectric.css') }}">
    @endpush

    <section class="section">
        <div class="section-header">
            <h1>Edit Partner</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('partners.index') }}">Partner Kami</a></div>
                <div class="breadcrumb-item">Edit Partner</div>
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
                    <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama Partner</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $partner->nama) }}">
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
                            @if($partner->gambar)
                                <img src="{{ asset('storage/' . $partner->gambar) }}" class="img-thumbnail mt-2" alt="Gambar Partner" style="max-width: 100px;">
                            @endif
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="is_visible">Tampilkan Partner</label>
                                <select name="is_visible" id="is_visible" class="form-control">
                                    <option value="1" {{ old('is_visible', $partner->is_visible) ? 'selected' : '' }}>Tampilkan Partner</option>
                                    <option value="0" {{ old('is_visible', $partner->is_visible) ? '' : 'selected' }}>Sembunyikan Partner</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Perbarui Partner</button>
                        <a href="{{ route('partners.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script src="{{ asset('admin_assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/page/forms-advanced.js') }}"></script>
    @endpush
@endsection

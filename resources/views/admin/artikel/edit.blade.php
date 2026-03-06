@extends('admin.layout.main')

@section('content')
@push('style')
<link rel="stylesheet" href="{{ asset('admin_assets/modules/summernote/summernote-bs4.css') }}">
<style>  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    color: #000;
}</style>
@endpush
    <section class="section">
        <div class="section-header">
            <h1>Edit Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Artikel</a></div>
                <div class="breadcrumb-item">Edit Artikel</div>
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
                    <h4 class="text-center">Edit Artikel</h4>
                    <form action="{{ route('artikel.update', $artikel->id_artikel) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id_datapengguna" value="{{ Auth::user()->id_datapengguna }}">

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul"
                                value="{{ old('judul', $artikel->judul) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_singkat">deskripsi singkat</label>
                            <textarea class="form-control" name="deskripsi_singkat" placeholder="Masukkan deskripsi_singkat" required>{{ $artikel->deskripsi_singkat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea class="summernote" name="isi" placeholder="Masukkan Isi" required>{{ $artikel->isi }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                            @if ($artikel->gambar)
                                <img src="{{ asset('storage/' . $artikel->gambar) }}" width="100"
                                    alt="{{ $artikel->judul }}" class="mt-2">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select class="js-example-basic-multiple form-control" name="tags[]" multiple>
                                @foreach ($tags as $key => $tag)
                                    <option value="{{ $tag->id_tag_artikel }}"
                                        @if (
                                        ($tagartikel = $artikel->tags[$key] ?? null) &&
                                            $tagartikel->id_tag == $tag->id_tag) selected @endif>
                                    {{ $tag->nama_tag }}
                                </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih satu atau lebih tag.</small>
                        </div>

                        <div class="text-right">
                            <a href="{{ route('artikel.index') }}" class="btn btn-light">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <!-- JS Libraries -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('admin_assets/modules/summernote/summernote-bs4.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush

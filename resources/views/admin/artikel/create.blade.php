@extends('admin.layout.main')

@section('content')
    @push('style')
        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                color: #000;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/summernote/summernote-bs4.css') }}">
        <!-- JS Libraries -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    @endpush
    <section class="section">
        <div class="section-header">
            <h1>Tambah Artikel</h1>
        </div>

        <div class="section-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <div class="alert-body">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
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
                    <h4 class="text-center">Tambah Artikel</h4>
                    <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id_datapengguna" value="{{ Auth::user()->id_datapengguna }}">

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul"
                                value="{{ old('judul') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_singkat">deskripsi singkat</label>
                            <textarea class="form-control" name="deskripsi_singkat" placeholder="Masukkan deskripsi_singkat" required>{{ old('deskripsi_singkat') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea class="summernote" name="isi" placeholder="Masukkan Isi" required>{{ old('isi') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select class="js-example-basic-multiple form-control " placeholder="Pilih Tag" name="tags[]"
                                multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id_tag_artikel }}"
                                        {{ in_array($tag->id_tag_artikel, old('tags', [])) ? 'selected' : '' }}>
                                        {{ $tag->nama_tag }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih satu atau lebih tag.</small>
                        </div>

                        <div class="text-right">
                            <a href="{{ route('artikel.index') }}" class="btn btn-light">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

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
                placeholder: "Pilih Tag",
            });
        });
    </script>
@endpush

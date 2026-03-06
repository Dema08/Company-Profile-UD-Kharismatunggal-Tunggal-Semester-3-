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
            <h1>Tambah Tag Artikel</h1>
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
                    <h4 class="text-center">Tambah Tag Artikel</h4>
                    <form action="{{ route('tags.store') }}" method="POST" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_tag">Nama Tag</label>
                                    <input value="{{ old('nama_tag') }}" required type="text" class="form-control"
                                        name="nama_tag" placeholder="Masukkan Nama Tag">
                                    @if ($errors->has('nama_tag'))
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end text-right">
                            <a href="{{ route('tags.index') }}" class="btn btn-light">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('script')
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
@endsection

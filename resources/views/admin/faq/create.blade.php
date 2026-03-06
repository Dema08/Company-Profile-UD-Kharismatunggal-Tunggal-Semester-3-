@extends('admin.layout.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah FAQ</h1>
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
                <h4 class="text-center">Tambah FAQ</h4>
                <form action="{{ route('faq.store') }}" method="POST" id="form">
                    @csrf
                    <div class="form-group">
                        <label for="pertanyaan">Pertanyaan</label>
                        <textarea required class="form-control" name="pertanyaan" placeholder="Masukkan Pertanyaan">{{ old('pertanyaan') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="jawaban">Jawaban</label>
                        <textarea required class="form-control" name="jawaban" placeholder="Masukkan Jawaban">{{ old('jawaban') }}</textarea>
                    </div>
                    <div class="justify-content-end text-right">
                        <a href="{{ route('faq.index') }}" class="btn btn-light">Kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('admin.layout.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit FAQ</h1>
    </div>

    <div class="section-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('faq.update', $faq->id_faq) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="pertanyaan">Pertanyaan</label>
                        <textarea name="pertanyaan" class="form-control" required>{{ old('pertanyaan', $faq->pertanyaan) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="jawaban">Jawaban</label>
                        <textarea name="jawaban" class="form-control" required>{{ old('jawaban', $faq->jawaban) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('faq.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

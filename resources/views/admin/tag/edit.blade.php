@extends('admin.layout.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Tag Artikel</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('tags.index') }}">Data Tag Artikel</a></div>
            <div class="breadcrumb-item">Edit Tag</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card shadow">
            <div class="card-body">
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

                <form action="{{ route('tags.update', $tag->id_tag_artikel) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_tag">Nama Tag</label>
                        <input type="text" name="nama_tag" id="nama_tag" class="form-control"
                            value="{{ old('nama_tag', $tag->nama_tag) }}" required>
                        @if ($errors->has('nama_tag'))
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

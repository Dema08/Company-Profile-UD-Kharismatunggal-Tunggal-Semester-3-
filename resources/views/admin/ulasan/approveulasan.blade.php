@extends('admin.layout.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Terima Ulasan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('tags.index') }}">Ulasan Artikel</a></div>
            <div class="breadcrumb-item">Terima Ulasan</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card shadow">
            <div class="card-body ">
                <form action="{{ route('ulasan.approveulasan', $ulasan->id_ulasan) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="nama_tag">Terima Ulasan</label>
                        <select name="status" id="status" class="form-control">
                            <option value="terima">Terima Ulasan</option>
                            <option value="tolak">Tolak Ulasan</option>
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <a href="{{ route('ulasan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

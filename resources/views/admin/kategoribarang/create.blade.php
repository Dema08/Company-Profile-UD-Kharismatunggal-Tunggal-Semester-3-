@extends('admin.layout.main')

@section('content')
    @push('style')
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    @endpush

    <section class="section">
        <div class="section-header">
            <h1>Tambah Kategori Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kategori_barang.index') }}">Kategori Barang</a></div>
                <div class="breadcrumb-item">Tambah Kategori Barang</div>
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
                    <form action="{{ route('kategori_barang.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Kategori"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kategori_barang.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <!-- JS Libraries -->
        <script src="{{ asset('admin_assets/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
        </script>
        <script src="{{ asset('admin_assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('admin_assets/js/page/modules-datatables.js') }}"></script>
    @endpush
@endsection

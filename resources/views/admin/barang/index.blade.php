@extends('admin.layout.main')

@section('content')
    @push('style')
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    @endpush

    <section class="section">
        <div class="section-header">
            <h1>Data Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Barang</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card shadow">
                <div class="card-header justify-content-end">
                    <a href="{{ route('barang.create') }}" class="btn btn-primary btn-icon">
                        Tambah Barang <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Barang</th>
                                    <th>Deskripsi Singkat</th>
                                    <th>Deskripsi Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Link Shopee</th>
                                    <th>Gambar</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ Str::limit($barang->deskripsi_singkat, 100, ' Lihat Selengkapnya') }}</td>
                                        <td>{{ Str::limit($barang->deskripsi, 50, ' Lihat Selengkapnya') }}</td>
                                        <td>{{ number_format($barang->harga_barang, 2) }}</td>
                                        <td><a href="{{ $barang->link_shopee }}" target="_blank">Shopee Link</a></td>
                                        <td>
                                            <div class="gallery">
                                                @foreach ($barang->gallery as $image)
                                                    <img src="{{ asset('storage/' . $image->path_gambar) }}" class="img-thumbnail" alt="Gambar Barang" style="max-width: 100px;">
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            @foreach ($barang->kategori as $kategori)
                                                <span class="badge badge-success mb-1">{{ $kategori->KategoriBarang->nama }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($barang->is_visible)
                                                <span class="badge badge-success">Tampil</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Tampil</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-warning btn-icon"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('barang.destroy', $barang->id_barang) }}" data-confirm-delete="true" type="submit" class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <!-- JS Libraries -->
        <script src="{{ asset('admin_assets/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('admin_assets/js/page/modules-datatables.js') }}"></script>
    @endpush
@endsection

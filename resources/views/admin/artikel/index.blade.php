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
            <h1>Data Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Data Artikel</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Daftar Artikel</h4>
                    <div class="card-header-action">
                        <a href="{{ route('artikel.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Artikel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi Singkat</th>
                                    <th>Isi</th>
                                    <th>Gambar</th>
                                    <th>Tags</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artikels as $index => $artikel)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $artikel->judul }}</td>
                                        <td>{{ $artikel->deskripsi_singkat }}</td>
                                        <td><p class="text-sm">{!! nl2br(Str::limit($artikel->isi, 100)) !!}</p></td>
                                        <td>
                                            @if ($artikel->gambar)
                                                <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" width="100">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($artikel->tags as $tag)
                                                <span class="badge badge-info">{{ $tag->nama_tag }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('artikel.edit', $artikel->id_artikel) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('artikel.destroy', $artikel->id_artikel) }}" data-confirm-delete="true" type="submit" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
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
@endsection

@push('script')
    <!-- JS Libraries -->
    <script src="{{ asset('admin_assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/modules/datatables/Select-1.2.4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/page/modules-datatables.js') }}"></script>
@endpush

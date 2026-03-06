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
            <h1>Daftar Partner Kami</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Partner Kami</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card shadow">
                <div class="card-header justify-content-end">
                    <a href="{{ route('partners.create') }}" class="btn btn-primary btn-icon">
                        Tambah Partner <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Partner</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $partner->nama }}</td>
                                        <td>
                                            @if($partner->gambar)
                                                <img src="{{ asset('storage/' . $partner->gambar) }}" class="img-thumbnail" alt="Gambar Partner" style="max-width: 100px;">
                                            @else
                                                <span>Tidak Ada Gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($partner->is_visible)
                                                <span class="badge badge-success">Tampil</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Tampil</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-warning btn-icon"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('partners.destroy', $partner->id) }}" data-confirm-delete="true" type="submit" class="btn btn-danger btn-icon" ><i class="fas fa-trash"></i></a>
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

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
            <h1>Data FAQ</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data FAQ</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card shadow">
                <div class="card-header justify-content-end">
                    <a href="{{ route('faq.create') }}" class="btn btn-primary btn-icon">Tambah FAQ <i
                            class="fas fa-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $faq->pertanyaan }}</td>
                                    <td>{{ $faq->jawaban }}</td>
                                    <td>
                                        <a href="{{ route('faq.edit', $faq->id_faq) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('faq.destroy', $faq->id_faq) }}" data-confirm-delete="true" type="submit" class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></a>
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

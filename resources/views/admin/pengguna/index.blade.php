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
            <h1>Data Pengguna</h1>
            <div class="section-header-breadcrumb">

            </div>
        </div>

        <div class="section-body">

            <div class="card shadow">
                <div class="card-header justify-content-end">
                    <a href="{{ route('pengguna.create') }}" class="btn btn-primary btn-icon">Tambah Pengguna <i
                            class="fas fa-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Pengguna</th>
                                    <th>Email Pengguna</th>
                                    <th>Alamat</th>
                                    <th>Nomor HP</th>
                                    <th>Peran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama_pengguna }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->no_telp }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('pengguna.edit', $user->id_datapengguna) }}"
                                            class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('pengguna.destroy', $user->id_datapengguna) }}" data-confirm-delete="true" type="submit" class="btn btn-danger btn-icon"><i
                                                class="fas fa-trash"></i></a>
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
        <!-- JS Libraies -->
        <script src="{{ asset('admin_assets/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
        </script>
        <script src="{{ asset('admin_assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('admin_assets/js/page/modules-datatables.js') }}"></script>
    @endpush
@endsection

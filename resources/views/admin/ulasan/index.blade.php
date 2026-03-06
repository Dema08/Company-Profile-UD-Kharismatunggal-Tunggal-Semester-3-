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
            <h1>Ulasan Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Ulasan Barang</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card shadow">
                <div class="card-header">
                    <!-- Optional: add a button or other header elements -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Pengguna</th>
                                    <th>Barang</th>
                                    <th>Ulasan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ulasan as $item)
                                {{-- @dd($item) --}}
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ($item->pengguna != null) ? $item->pengguna->nama_pengguna : $item->nama_pengguna }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td>{{ $item->text }}</td>
                                        <td>
                                            @if ($item->status == 'terima')
                                                <span class="badge badge-success">Diterima</span>
                                            @elseif ($item->status == 'tolak')
                                            <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning">pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('ulasan.approvepage', $item->id_ulasan) }}" class="btn btn-primary"><i class="fas fa-check"></i></a>
                                            <a href="{{ route('ulasan.destroy', $item->id_ulasan) }}" data-confirm-delete="true" type="submit" class="btn btn-danger btn-icon" title="Hapus"><i
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
        !--JS Libraries-- >
        <script src = "{{ asset('admin_assets/modules/datatables/datatables.min.js') }}">
            </script>
            <script src="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
            </script>
            <script src="{{ asset('admin_assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
            <script src="{{ asset('admin_assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

            <!-- Page Specific JS File -->
            <script src="{{ asset('admin_assets/js/page/modules-datatables.js') }}"></script>
        @endpush
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Konfirmasi Ulasan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <b>Apakah Anda Setuju Untuk Menampilkan Ulasan Ini?</b><br>
                        <small class="text-danger">Apabila Anda Setuju Maka Ulasan Ini Akan Di Tampilkan Di Halaman
                            Home.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="modal-reject">Tidak Setuju</button>
                        <button type="button" class="btn btn-success" id="modal-approve"><i
                                class="fas fa-check"></i></button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

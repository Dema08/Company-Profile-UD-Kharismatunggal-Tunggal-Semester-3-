@extends('admin.layout.main')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    @endpush
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('pengaturan.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Pengaturan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                <div class="breadcrumb-item active"><a href="#">Pengaturan</a></div>
                <div class="breadcrumb-item">Pengaturan Umum</div>
            </div>
        </div>

        <div class="section-body">

            <h2 class="section-title">Pengaturan</h2>
            <div id="output-status"></div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Navigasi</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4"
                                        role="tab" aria-controls="home" aria-selected="true">Pengaturan Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab"
                                        aria-controls="profile" aria-selected="false">Gambar Halaman Utama</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengaturan</h4>
                        </div>
                        <div class="card-body">
                            <div class="tab-content no-padding" id="myTab2Content">
                                <div class="tab-pane fade show active " id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                    <div class="card">
                                        <div class="card-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible fade show">
                                                    <div class="alert-body">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                            <form id="setting-form"
                                                action="{{ route('pengaturan.update', $settings->id_pengaturan) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('patch')
                                                <div class="form-group row align-items-center">
                                                    <label for="site-title"
                                                        class="form-control-label col-sm-3 text-md-right">Nama
                                                        Toko</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" name="nama_toko" class="form-control"
                                                            value="{{ $settings->nama_toko }}" id="site-title">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label for="alamat_toko"
                                                        class="form-control-label col-sm-3 text-md-right">Alamat
                                                        Toko</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" class="form-control" name="alamat_toko"
                                                            id="alamat_toko" value="{{ $settings->alamat_toko }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label for="site-description"
                                                        class="form-control-label col-sm-3 text-md-right">Nomer
                                                        Telepon Toko</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" value="{{ $settings->no_hp_toko }}"
                                                            name="no_hp_toko" class="form-control" id="site-title">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label for="site-description"
                                                        class="form-control-label col-sm-3 text-md-right">Koordinat
                                                        Toko</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" name="koordinat_toko"
                                                            value="{{ $settings->koordinat_toko }}" class="form-control"
                                                            id="site-title">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="form-control-label col-sm-3 text-md-right">Logo
                                                        Toko</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <div class="custom-file">
                                                            <input type="file" name="logo_toko"
                                                                class="custom-file-input" id="site-logo">
                                                            <label class="custom-file-label">Choose File</label>
                                                        </div>
                                                        <div class="form-text text-muted">The image must have a maximum
                                                            size of 1MB
                                                        </div>
                                                        <img width="50" height="50"
                                                            src="{{ asset('storage/' . $settings->logo_toko) }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="form-control-label col-sm-3 text-md-right">Link
                                                        Shopee</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <div class="custom-file">
                                                            <input type="text"
                                                                value="{{ $settings->linkshopee_toko }}"
                                                                name="linkshopee_toko" class="form-control"
                                                                id="site-title">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="card-footer bg-whitesmoke text-md-right">
                                            <button class="btn btn-primary" type="submit" id="save-btn">Save
                                                Changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="profile4" role="tabpanel"
                                    aria-labelledby="profile-tab4">
                                    <div class="card">
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
                                            <form action="{{ route('pengaturan.storeheroimage') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Gallery</label>
                                                    <input type="file" accept="image/*" name="image"
                                                        class="form-control">
                                                </div>
                                                <div class="text-right mb-3">
                                                    <button type="submit" class="btn btn-primary ">Simpan</button>
                                                </div>
                                            </form>
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>gambar</th>
                                                            <th>tampilkan di about</th>
                                                            <th>aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($heroimages as $heroimage)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td><img src="{{ asset('storage/' . $heroimage->image) }}"
                                                                        class="img-fluid" alt=""></td>
                                                                <td>
                                                                    @if ($heroimage->tampilkandiabout == 1)
                                                                        <span class="badge badge-success">Tampilkan</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Tidak
                                                                            Tampilkan</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <button data-id="{{ $heroimage->id_heroimage }}"
                                                                        data-tampilkan="{{ $heroimage->tampilkandiabout }}"
                                                                        data-toggle="modal" data-target="#editheroimage"
                                                                        class="btn btn-warning btn-icon">
                                                                        <i class="fas fa-pencil-alt"></i></button>
                                                                        <a href="{{ route('pengaturan.deleteheroimage', $heroimage->id_heroimage) }}" data-confirm-delete="true" type="submit"
                                                                            class="btn btn-danger btn-icon"><i
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="editheroimage" tabindex="-1" role="dialog" aria-labelledby="editheroimage"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editheroimageLabel">Edit Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-heroimage-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="heroimage-id">
                        <div class="form-group">
                            <label>Gallery</label>
                            <input type="file" accept="image/*" name="image" class="form-control"
                                id="heroimage-image">
                        </div>
                        <div class="form-group">
                            <label>Show on About Page</label>
                            <select name="tampilkan_di_about" class="form-control" id="heroimage-tampilkan_di_about">
                                <option value="1">Tampilkan</option>
                                <option value="0">Tidak Tampilkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                // Handle the edit button click
                $('button[data-toggle="modal"][data-target="#editheroimage"]').on('click', function() {
                    var heroImageId = $(this).data('id');
                    var heroImageTampilkan = $(this).data('tampilkan'); // Ambil data 'tampilkan'

                    // Generate the full route with the heroImageId dynamically in JavaScript
                    var updateHeroImageUrl = '{{ route('pengaturan.updateheroimage', ':id') }}';
                    updateHeroImageUrl = updateHeroImageUrl.replace(':id', heroImageId);

                    // Set the modal form action using the full route
                    $('#edit-heroimage-form').attr('action', updateHeroImageUrl);

                    // Set values in the modal
                    $('#heroimage-id').val(heroImageId);

                    // Set the value for select
                    $('#heroimage-tampilkan_di_about').val(heroImageTampilkan);
                });
            });
        </script>

        <!-- JS Libraries -->
        <script src="{{ asset('admin_assets/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
        </script>
        <script src="{{ asset('admin_assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('admin_assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    @endpush
@endsection

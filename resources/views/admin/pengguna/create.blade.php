@extends('admin.layout.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Pengguna</h1>
            <div class="section-header-breadcrumb">

            </div>
        </div>

        <div class="section-body">
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
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center">Tambah Data Pengguna</h4>
                    <form action="{{ route('pengguna.store') }}" method="POST" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nama Pengguna</label>
                                    <input value="{{ old('nama_pengguna') }}" required type="text" class="form-control"
                                        name="nama_pengguna" placeholder="Masukkan Nama Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Email Pengguna</label>
                                    <input value="{{ old('email') }}" required type="email" class="form-control"
                                        name="email" placeholder="Masukkan Email Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Alamat Pengguna</label>
                                    <input value="{{ old('alamat') }}" required type="text" class="form-control"
                                        name="alamat" placeholder="Masukkan Alamat Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nomer HP Pengguna</label>
                                    <input value="{{ old('no_telp') }}" required type="number" class="form-control"
                                        name="no_telp" placeholder="Masukkan Nomer HP Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Password Pengguna</label>
                                    <input value="{{ old('password') }}" required type="password" class="form-control"
                                        name="password" placeholder="Masukkan Password Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Role Pengguna</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end text-right">
                            <a href="{{ route('pengguna.index') }}" class="btn btn-light">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#form').submit(function(e) {
                    if ($('#role').val() === '') {
                        alert('Anda harus memilih role');
                        e.preventDefault();
                    }
                });
            });
        </script>
    @endpush
@endsection

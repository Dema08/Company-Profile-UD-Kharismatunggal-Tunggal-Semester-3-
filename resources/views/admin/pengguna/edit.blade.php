@extends('admin.layout.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Pengguna</h1>
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
                    <h4 class="text-center">Edit Data Pengguna</h4>
                    <form action="{{ route('pengguna.update', $datapengguna->id_datapengguna) }}" method="POST" id="form">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nama Pengguna</label>
                                    <input value="{{ $datapengguna->nama_pengguna }}" required type="text" class="form-control"
                                        name="nama_pengguna" placeholder="Masukkan Nama Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Email Pengguna</label>
                                    <input value="{{ $datapengguna->email }}" required type="email" class="form-control"
                                        name="email" placeholder="Masukkan Email Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Alamat Pengguna</label>
                                    <input value="{{ $datapengguna->alamat }}" type="text" class="form-control"
                                        name="alamat" placeholder="Masukkan Alamat Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nomer HP Pengguna</label>
                                    <input value="{{ $datapengguna->no_telp }}" type="number" class="form-control"
                                        name="no_telp" placeholder="Masukkan Nomer HP Pengguna">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Role Pengguna</label>
                                    <select name="role" id="role" class="form-control">
                                        <option {{ ($datapengguna->role == 'user')? 'selected' : '' }} value="user">User</option>
                                        <option {{ ($datapengguna->role == 'admin')? 'selected' : '' }} value="admin">Admin</option>
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
@endsection

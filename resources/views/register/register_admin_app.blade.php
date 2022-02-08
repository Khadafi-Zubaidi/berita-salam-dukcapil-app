@extends('masterlayout.master_layout_backend')
@section('content')
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Register</b> Admin</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register Admin Aplikasi</p>
                    <form action="{{route('simpan_data_baru_admin_app')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukkan NIP" value="{{old('nip')}}">
                            @error('nip')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama" value="{{old('nama')}}">
                            @error('nama')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" value="{{old('password')}}">
                            @error('password')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kode Validasi</label>
                            <input type="text" name="kode_validasi" class="form-control @error('kode_validasi') is-invalid @enderror" placeholder="Masukkan Kode Validasi" value="{{old('kode_validasi')}}">
                            @error('kode_validasi')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
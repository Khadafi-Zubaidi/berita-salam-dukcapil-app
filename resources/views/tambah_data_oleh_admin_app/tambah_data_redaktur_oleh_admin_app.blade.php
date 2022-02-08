@extends('masterlayout.master_layout_backend')
@section('content')
    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-dark">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Dashboard Administrator</a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link">
                    <span class="brand-text font-weight-light">Menu Utama</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{asset('foto_admin_app')}}/{{$LoggedUserInfo->foto}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('tampil_data_redaktur_oleh_admin_app')}}" class="nav-link">
                                    <i class="nav-icon fas fa-arrow-left"></i>
                                    <p>
                                        Sebelumnya
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <h1 class="m-0">Aplikasi Web Berita Salam Dukcapil</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Pemasukan Data Redaktur</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{route('simpan_data_baru_redaktur_oleh_admin_app')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <label>NIP (18 karakter tanpa spasi) *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" onkeypress='return validateQty(event);' maxlength="18" value="{{ old('nip')}}">
                                                        <script>
                                                            function validateQty(event) {
                                                                var key = window.event ? event.keyCode : event.which;
                                                                if (event.keyCode == 8 || event.keyCode == 46
                                                                    || event.keyCode == 37 || event.keyCode == 39) {
                                                                    return true;
                                                                }
                                                                else if ( key < 48 || key > 57 ) {
                                                                    return false;
                                                                }
                                                                else return true;
                                                            };
                                                        </script>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('nip')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Nama *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama')}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('nama')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Jabatan *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan')}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('jabatan')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Pangkat / Golongan *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="pangkat_golongan" class="form-control @error('pangkat_golongan') is-invalid @enderror" value="{{ old('pangkat_golongan')}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('pangkat_golongan')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Password *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password')}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('password')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection

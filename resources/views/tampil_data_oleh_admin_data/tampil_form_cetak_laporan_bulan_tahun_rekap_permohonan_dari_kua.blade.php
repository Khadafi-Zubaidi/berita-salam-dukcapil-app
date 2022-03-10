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
                        <a href="#" class="nav-link">Dashboard Admin Data</a>
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
                            <img src="{{asset('foto_admin_data')}}/{{$LoggedUserInfo->foto}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('dashboard_admin_data')}}" class="nav-link">
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
                                <h1 class="m-0">Aplikasi Salam Dukcapil</h1>
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
                                        <h5 class="card-title">Formulir Rekapitulasi Pengurusan Dokumen Dari KUA</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{route('cetak_laporan_bulan_tahun_rekap_permohonan_dari_kua')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Pilih Bulan *</label><br>
                                                        <select name="bulan_pengajuan">
                                                            <option value="Januari">Januari</option>
                                                            <option value="Februari">Februari</option>
                                                            <option value="Maret">Maret</option>
                                                            <option value="April">April</option>
                                                            <option value="Mei">Mei</option>
                                                            <option value="Juni">Juni</option>
                                                            <option value="Juli">Juli</option>
                                                            <option value="Agustus">Agustus</option>
                                                            <option value="September">September</option>
                                                            <option value="Oktober">Oktober</option>
                                                            <option value="Nopember">Nopember</option>
                                                            <option value="Desember">Desember</option>
                                                        </select>
                                                    </div>
                                                    <label>Tahun *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="tahun_pengajuan" class="form-control @error('tahun_pengajuan') is-invalid @enderror" value="{{ old('tahun_pengajuan')}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('tahun_pengajuan')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <button type="submit" class="btn btn-success btn-block">Pratinjau</button>
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

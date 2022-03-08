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
                        <a href="#" class="nav-link">Dashboard Operator {{$NamaDesa->nama_desa_kelurahan}} Kecamatan {{$NamaKecamatan->nama_kecamatan}}</a>
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
                            <img src="{{asset('foto_operator_desa_kelurahan')}}/{{$LoggedUserInfo->foto}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama_operator}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('tambah_data_berkas_oleh_operator')}}" class="nav-link">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>
                                        Permohonan Baru
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('tampil_data_berkas_permohonan_belum_selesai_oleh_operator')}}" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Belum Selesai
                                        <span class="right badge badge-danger">{{$jumlah_berkas_pengurusan_yang_belum_selesai}}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('tampil_data_berkas_permohonan_sudah_selesai_oleh_operator')}}" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Sudah Selesai
                                        <span class="right badge badge-success">{{$jumlah_berkas_pengurusan_yang_sudah_selesai}}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('logout_operator')}}" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>
                                        Keluar Aplikasi
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
                                        <h5 class="card-title">Deskripsi Aplikasi</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>
                                                    <strong>Aplikasi Salam Dukcapil</strong> adalah sebuah aplikasi berbasis web yang disusun dalam rangka menunjang kegiatan pengurusan dokumen kependudukan yang dilakukan oleh Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sumbawa Barat.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Rekapitulasi Data</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-lg-4 col-6">
                                                        <!-- small box -->
                                                        <div class="small-box bg-info">
                                                            <div class="inner">
                                                                <h3>{{$jumlah_berkas_pengurusan}}</h3>
                                                                <p>Berkas Pengurusan</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="ion ion-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-6">
                                                        <!-- small box -->
                                                        <div class="small-box bg-danger">
                                                            <div class="inner">
                                                                <h3>{{$jumlah_berkas_pengurusan_yang_belum_selesai}}</h3>
                                                                <p>Belum Selesai</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="ion ion-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-6">
                                                        <!-- small box -->
                                                        <div class="small-box bg-success">
                                                            <div class="inner">
                                                                <h3>{{$jumlah_berkas_pengurusan_yang_sudah_selesai}}</h3>
                                                                <p>Sudah Selesai</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="ion ion-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Profile Operator</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card card-primary card-outline">
                                                    <div class="card-body box-profile">
                                                        <div class="text-center">
                                                            <img class="profile-user-img img-fluid img-circle"
                                                                 src="{{asset('foto_operator_desa_kelurahan')}}/{{$LoggedUserInfo->foto}}"
                                                                 alt="User profile picture">
                                                        </div>
                                                        <h5 class="profile-username text-center">{{$LoggedUserInfo->nama_operator}}</h5>
                                                        <p class="text-muted text-center">ID Operator<br>{{$LoggedUserInfo->nip}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="card">
                                                    <div class="card-header p-2">
                                                        <ul class="nav nav-pills">
                                                            <li class="nav-item"><a class="nav-link active" href="#ubah-profile" data-toggle="tab">Ubah Profile</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#ubah-password" data-toggle="tab">Ubah Password</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#ubah-foto" data-toggle="tab">Ubah Foto</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#ubah-berkas" data-toggle="tab">Berkas Kelengkapan</a></li>
                                                        </ul>
                                                    </div><!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="tab-content">
                                                            <div class="active tab-pane" id="ubah-profile">
                                                                <form method="post" action="{{route('simpan_perubahan_data_profil_operator')}}">
                                                                    @csrf
                                                                    <input name="id" type="hidden" class="form-control" value="{{$LoggedUserInfo->id}}">
                                                                    <div class="form-group">
                                                                        <label>ID Operator (tanpa spasi)</label>
                                                                        <input id="nip" name="nip" type="number" class="form-control" placeholder="Masukkan ID Operator" value="{{$LoggedUserInfo->nip}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama</label>
                                                                        <input id="nama_operator" name="nama_operator"type="text" class="form-control @error('nama_operator') is-invalid @enderror" placeholder="Masukkan Nama" value="{{$LoggedUserInfo->nama_operator}}">
                                                                        @error('nama')
                                                                        <div class="invalid-feedback">{{$message}}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>No. Telp/WA</label>
                                                                        <input id="no_wa" name="no_wa"type="number" class="form-control @error('no_wa') is-invalid @enderror" placeholder="Masukkan No. Telp/WA" value="{{$LoggedUserInfo->no_wa}}">
                                                                        @error('no_wa')
                                                                        <div class="invalid-feedback">{{$message}}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-success btn-block">Simpan Perubahan Profil</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane" id="ubah-password">
                                                                <form method="post" action="{{route('simpan_perubahan_data_password_operator')}}">
                                                                    @csrf
                                                                    <input name="id" type="hidden" class="form-control" value="{{$LoggedUserInfo->id}}">
                                                                    <div class="form-group">
                                                                        <label>Password Baru</label>
                                                                        <input name="password_baru" type="text" class="form-control @error('password_baru') is-invalid @enderror" placeholder="Masukkan Password">
                                                                        @error('password_baru')
                                                                        <div class="invalid-feedback">{{$message}}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-danger btn-block">Simpan Perubahan Password</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane" id="ubah-foto">
                                                                <form method="post" action="{{route('simpan_perubahan_data_foto_operator')}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input name="id" type="hidden" class="form-control" value="{{$LoggedUserInfo->id}}">
                                                                    <label>Upload File</label><br>
                                                                    <div class="input-group mb-3">
                                                                        <input type="file" id="file" name="file" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-warning btn-block">Simpan Perubahan Foto</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane" id="ubah-berkas">
                                                                <p>
                                                                    <strong>Penting Untuk Diketahui !!!</strong> Sebelum Anda mengisi formulir ini. 
                                                                    <ol>
                                                                        <li>Pastikan Anda sudah melakukan scan terhadap dokumen-dokumen yang dilampirkan (.JPG) serta melakukan kompres ke dalam bentuk (.ZIP atau .RAR). Silahkan hubungi Admin Data untuk keterangan lebih lanjut.</li>
                                                                        <li>Untuk mengisi berkas, klik pada tombol <button>Choose File</button> lalu pilih file .ZIP atau .RAR sebagaimana dimaksud pada point paling atas.</li>
                                                                    </ol>
                                                                </p>
                                                                <form method="post" action="{{route('simpan_perubahan_data_berkas_operator')}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input name="id" type="hidden" class="form-control" value="{{$LoggedUserInfo->id}}">
                                                                    <label>Upload File (.ZIP atau .RAR)</label><br>
                                                                    <div class="input-group mb-3">
                                                                        <input type="file" id="file2" name="file2" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-warning btn-block">Kirim Berkas</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
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
            </div>
        </div>
@endsection
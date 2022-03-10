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
                        <a href="#" class="nav-link">Dashboard Operator</a>
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
                            <img src="{{asset('foto_operator_fasilitas_kesehatan')}}/{{$LoggedUserInfo->foto}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama_operator}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('dashboard_operator_faskes')}}" class="nav-link">
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
                                <div class="card card-danger">
                                  <div class="card-header">
                                    <h3 class="card-title">Perhatian</h3>
                    
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                    <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">
                                    <p>
                                        <strong>Penting Untuk Diketahui !!!</strong> Sebelum Anda mengisi formulir ini. 
                                        <ol>
                                            <li>Pastikan Anda sudah melakukan scan terhadap dokumen-dokumen yang dilampirkan (.JPG) serta melakukan kompres ke dalam bentuk (.ZIP atau .RAR). Silahkan hubungi Admin Data untuk keterangan lebih lanjut.</li>
                                            <li>Seluruh kolom yang bertanda bintang (*) wajib diisi.</li>
                                            <li>Untuk mengisi berkas, klik pada tombol <button>Choose File</button> lalu pilih file .ZIP atau .RAR sebagaimana dimaksud pada point paling atas.</li>
                                            <li><strong>Untuk Pengurusan Dokumen Terkait Kartu Tanda Penduduk Hanya Bisa Dilayani Secara Langsung di Kantor Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sumbawa Barat.</strong></li>
                                        </ol>
                                    </p>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Pemasukan Data Permohonan</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{route('simpan_data_baru_permohonan_oleh_operator_faskes')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <label>NIK Pemohon *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="nik_pemohon" class="form-control @error('nik_pemohon') is-invalid @enderror" value="{{ old('nik_pemohon')}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('nik_pemohon')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Nama Pemohon *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="nama_pemohon" class="form-control @error('nama_pemohon') is-invalid @enderror" value="{{ old('nama_pemohon')}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('nama_pemohon')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Alamat Pemohon *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="alamat_pemohon" class="form-control @error('alamat_pemohon') is-invalid @enderror" value="{{ old('alamat_pemohon')}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-id-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('alamat_pemohon')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Jenis Permohonan *</label><br>
                                                    <div class="input-group mb-3">
                                                        <div class="col-md-12">
                                                            <textarea name="jenis_permohonan"id="summernote"></textarea>
                                                        </div>
                                                    </div>
                                                    <label>Berkas *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="file" id="file" name="file" class="form-control">
                                                        @error('file')
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

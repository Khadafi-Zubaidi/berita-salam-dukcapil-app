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
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Kembali ke Beranda
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
                                        <h5 class="card-title">Laporan Rekapitulasi Pengurusan Dokumen Dari Desa/Kelurahan</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="invoice p-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5>
                                                              <i class="fas fa-document"></i> Laporan Rekapitulasi Pengurusan Dokumen Bulan {{$bulan}} - {{$tahun}}
                                                              <small class="float-right">Tanggal Cetak : @php echo date("d/m/Y") @endphp</small>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 table-responsive">
                                                            <table id="example1" class="table table-bordered table-striped" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th rowspan="2">No</th>
                                                                        <th rowspan="2">Desa/Kelurahan</th>
                                                                        <th rowspan="2">Kecamatan</th>
                                                                        <th colspan="7">Jumlah</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Pengurusan</th>
                                                                        <th>KK</th>
                                                                        <th>SKP</th>
                                                                        <th>KIA</th>
                                                                        <th>Akta Lahir</th>
                                                                        <th>Akta Mati</th>
                                                                        <th>Lain-Lain</th>    
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php $no = 1; @endphp
                                                                    @foreach($DataTabel as $dt)
                                                                    <tr>
                                                                        <td>{{$no++}}</td>
                                                                        <td>{{$dt->nama_desa_kelurahan}}</td>
                                                                        <td>{{$dt->nama_kecamatan}}</td>
                                                                        <td>{{$dt->jumlah}}</td>
                                                                        <td>{{$dt->jumlah_kk}}</td>
                                                                        <td>{{$dt->jumlah_skp}}</td>
                                                                        <td>{{$dt->jumlah_kia}}</td>
                                                                        <td>{{$dt->jumlah_akta_kelahiran}}</td>
                                                                        <td>{{$dt->jumlah_akta_kematian}}</td>
                                                                        <td>{{$dt->jumlah_lain_lain}}</td>
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
                    </div>
                </section>
            </div>
        </div>
@endsection

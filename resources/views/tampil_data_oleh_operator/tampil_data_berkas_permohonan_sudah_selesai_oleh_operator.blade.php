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
                            <img src="{{asset('foto_operator_desa_kelurahan')}}/{{$LoggedUserInfo->foto}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama_operator}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('dashboard_operator')}}" class="nav-link">
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
                                        <h5 class="card-title">Data Berkas Permohonan Yang Sudah Selesai</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @csrf
                                                <table id="example1" class="table table-bordered table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Pemohon</th>
                                                            <th>Alamat Pemohon</th>
                                                            <th>Jenis Permohonan</th>
                                                            <th>Tanggal Pengajuan</th>
                                                            <th>Status</th>
                                                            <th>No.Pendaftaran</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->nama_pemohon}}</td>
                                                                <td>{{$dt->alamat_pemohon}}</td>
                                                                <td>{!!$dt->jenis_permohonan!!}</td>
                                                                <td>{{$dt->tanggal_pengajuan}}</td>
                                                                <td>
                                                                    @if ($dt->status == 'B')
                                                                        <span class="badge badge-danger">Belum</span>
                                                                    @else
                                                                        <span class="badge badge-success">Sudah</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{$dt->nomor_pendaftaran}}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="lihatDokumenKeluaran({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><small>Daftar Dokumen Hasil</small></a>
                                                                    <a href="/berkas_permohonan_selesai/{{$dt->berkas_selesai}}" class="btn btn-success btn-block btn-sm"><small>Unduh Dokumen Hasil</small></a>
                                                                    <a href="{{action('App\Http\Controllers\OperatorDesaKelurahanController@cetak_bukti_pendaftaran_oleh_operator', $dt->id)}}" class="btn btn-info btn-block btn-sm"><small>Cetak Bukti Pendaftaran</small></a>
                                                                    <a href="{{action('App\Http\Controllers\OperatorDesaKelurahanController@cetak_bukti_pengambilan_oleh_operator', $dt->id)}}" class="btn btn-danger btn-block btn-sm"><small>Cetak Bukti Pengambilan Dokumen</small></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Lihat Dokumen Keluaran -->
                                                            <div class="modal fade" id="ubahDataModal2">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Lihat Daftar Dokumen Hasil</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="ubahDataForm2" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id3"/>
                                                                                <label>Nama Pemohon</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_pemohon3" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Tanggal Pengajuan</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="tanggal_pengajuan3" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Nomor Pendaftaran</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nomor_pendaftaran3" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Dokumen Hasil</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <textarea id="dokumen_hasil3"></textarea>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function lihatDokumenKeluaran(id)
                                                                {
                                                                    $.get('/berkas_pengurusans/'+id,function(berkas_pengurusan){
                                                                        $("#id3").val(berkas_pengurusan.id);
                                                                        $("#nama_pemohon3").val(berkas_pengurusan.nama_pemohon);
                                                                        $("#tanggal_pengajuan3").val(berkas_pengurusan.tanggal_pengajuan);
                                                                        $("#nomor_pendaftaran3").val(berkas_pengurusan.nomor_pendaftaran);
                                                                        $("#dokumen_hasil3").summernote('code', berkas_pengurusan.dokumen_hasil);
                                                                        $("#ubahDataModal2").modal('toggle');
                                                                    })
                                                                }
                                                            </script>
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
                </section>
            </div>
        </div>
@endsection

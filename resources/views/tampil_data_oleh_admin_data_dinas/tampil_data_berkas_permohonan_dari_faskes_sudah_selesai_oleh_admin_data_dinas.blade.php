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
                            <img src="{{asset('foto_admin_data_dinas')}}/{{$LoggedUserInfo->foto}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('dashboard_admin_data_dinas')}}" class="nav-link">
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
                                        <h5 class="card-title">Data Berkas Permohonan Dari Operator Fasilitas Kesehatan</h5>
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
                                                            <th>Bulan Pengajuan</th>
                                                            <th>Berkas Permohonan</th>
                                                            <th>Status</th>
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
                                                                <td>{{$dt->bulan_pengajuan}}</td>
                                                                <td>
                                                                    @if ($dt->berkas_permohonan == 'Fisik Telah Dibackup')
                                                                        <span class="badge badge-danger">File Telah Dibackup</span>
                                                                    @else
                                                                        {{$dt->berkas_permohonan}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($dt->status == 'B')
                                                                        <span class="badge badge-danger">Belum</span>
                                                                    @else
                                                                        <span class="badge badge-success">Sudah</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="/berkas_permohonan_dari_faskes_selesai/{{$dt->berkas_selesai}}" class="btn btn-success btn-block btn-sm"><small>Unduh Dokumen Hasil</small></a>
                                                                    <a href="javascript:void(0)" onclick="ubahDataCanting({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><small>Input Canting & Dokumen Hasil</small></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Ubah Data Canting -->
                                                            <div class="modal fade" id="ubahDataModal">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Input Catatan Penting dan Dokumen Hasil</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="ubahDataForm" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id2"/>
                                                                                <label>Nama Pemohon</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_pemohon2" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Alamat Pemohon</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="alamat_pemohon2" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Tanggal Pengajuan</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="tanggal_pengajuan2" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Catatan Penting *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-md-12">
                                                                                        <textarea id="isi_canting2"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Dokumen Hasil *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-md-12">
                                                                                        <textarea id="dokumen_hasil2"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Input Jumlah Dokumen Hasil *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-md-6">
                                                                                        <label>Jumlah KK</label><br>
                                                                                        <div class="input-group mb-3">
                                                                                            <input type="number" id="jml_kk2" class="form-control">
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text">
                                                                                                    <span class="fas fa-id-card"></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        &nbsp;
                                                                                        <label>Jumlah SKP</label><br>
                                                                                        <div class="input-group mb-3">
                                                                                            <input type="number" id="jml_skp2" class="form-control">
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text">
                                                                                                    <span class="fas fa-id-card"></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        &nbsp;
                                                                                        <label>Jumlah KIA</label><br>
                                                                                        <div class="input-group mb-3">
                                                                                            <input type="number" id="jml_kia2" class="form-control">
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text">
                                                                                                    <span class="fas fa-id-card"></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>Jumlah Akta Kelahiran</label><br>
                                                                                        <div class="input-group mb-3">
                                                                                            <input type="number" id="jml_akta_kelahiran2" class="form-control">
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text">
                                                                                                    <span class="fas fa-id-card"></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        &nbsp;
                                                                                        <label>Jumlah Akta Kematian</label><br>
                                                                                        <div class="input-group mb-3">
                                                                                            <input type="number" id="jml_akta_kematian2" class="form-control">
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text">
                                                                                                    <span class="fas fa-id-card"></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        &nbsp;
                                                                                        <label>Jumlah Dokumen Lainnya (Non KTP)</label><br>
                                                                                        <div class="input-group mb-3">
                                                                                            <input type="number" id="jml_lain_lain2" class="form-control">
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text">
                                                                                                    <span class="fas fa-id-card"></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function ubahDataCanting(id)
                                                                {
                                                                    $.get('/cari_berkas_permohonan_dari_faskes_oleh_admin_data_dinas/'+id,function(berkas_permohonan_dari_faskes){
                                                                        $("#id2").val(berkas_permohonan_dari_faskes.id);
                                                                        $("#nama_pemohon2").val(berkas_permohonan_dari_faskes.nama_pemohon);
                                                                        $("#alamat_pemohon2").val(berkas_permohonan_dari_faskes.alamat_pemohon);
                                                                        $("#tanggal_pengajuan2").val(berkas_permohonan_dari_faskes.tanggal_pengajuan);
                                                                        $("#isi_canting2").summernote('code', berkas_permohonan_dari_faskes.isi_canting);
                                                                        $("#dokumen_hasil2").summernote('code', berkas_permohonan_dari_faskes.dokumen_hasil);
                                                                        $("#jml_kk2").val(berkas_permohonan_dari_faskes.jml_kk);
                                                                        $("#jml_skp2").val(berkas_permohonan_dari_faskes.jml_skp);
                                                                        $("#jml_kia2").val(berkas_permohonan_dari_faskes.jml_kia);
                                                                        $("#jml_akta_kelahiran2").val(berkas_permohonan_dari_faskes.jml_akta_kelahiran);
                                                                        $("#jml_akta_kematian2").val(berkas_permohonan_dari_faskes.jml_akta_kematian);
                                                                        $("#jml_lain_lain2").val(berkas_permohonan_dari_faskes.jml_lain_lain);
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        if($('#jml_kk2').val() == '0'&&
                                                                            $('#jml_skp2').val() == '0'&&
                                                                            $('#jml_kia2').val() == '0'&&
                                                                            $('#jml_akta_kelahiran2').val() == '0'&&
                                                                            $('#jml_akta_kematian2').val() == '0'&&
                                                                            $('#jml_lain_lain2').val() == '0')
                                                                            {
                                                                                alert("Jumlah dokumen hasil tidak boleh kosong");  	
                                                                            }
                                                                        else{
                                                                            let id = $("#id2").val();
                                                                            let isi_canting = $("#isi_canting2").val();
                                                                            let dokumen_hasil = $("#dokumen_hasil2").val();
                                                                            let jml_kk = $("#jml_kk2").val();
                                                                            let jml_skp = $("#jml_skp2").val();
                                                                            let jml_kia = $("#jml_kia2").val();
                                                                            let jml_akta_kelahiran = $("#jml_akta_kelahiran2").val();
                                                                            let jml_akta_kematian = $("#jml_akta_kematian2").val();
                                                                            let jml_lain_lain = $("#jml_lain_lain2").val();
                                                                            let _token = $("input[name=_token]").val();
                                                                            $.ajax({
                                                                                url:"{{route('berkas_permohonan_dari_faskes.isi_canting')}}",
                                                                                type: "PUT",
                                                                                data:{
                                                                                    id:id,
                                                                                    isi_canting:isi_canting,
                                                                                    dokumen_hasil:dokumen_hasil,
                                                                                    jml_kk:jml_kk,
                                                                                    jml_skp:jml_skp,
                                                                                    jml_kia:jml_kia,
                                                                                    jml_akta_kelahiran:jml_akta_kelahiran,
                                                                                    jml_akta_kematian:jml_akta_kematian,
                                                                                    jml_lain_lain:jml_lain_lain,
                                                                                    _token:_token
                                                                                },
                                                                                success:function(response){
                                                                                    $("#ubahDataModal").modal('hide');
                                                                                    window.location = "{{route('tampil_data_berkas_permohonan_dari_faskes_sudah_selesai_oleh_admin_data_dinas')}}";
                                                                                }
                                                                            })
                                                                        }
                                                                        
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

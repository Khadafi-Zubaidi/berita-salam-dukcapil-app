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
                                        <h5 class="card-title">Data Berkas Permohonan Dari Operator Desa</h5>
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
                                                            <th>Desa/Kelurahan</th>
                                                            <th>Kecamatan</th>
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
                                                                <td>{{$dt->jenis_permohonan}}</td>
                                                                <td>{{$dt->tanggal_pengajuan}}</td>
                                                                <td>{{$dt->nama_desa_kelurahan}}</td>
                                                                <td>{{$dt->nama_kecamatan}}</td>
                                                                <td>
                                                                    @if ($dt->status == 'B')
                                                                        <span class="badge badge-danger">Belum</span>
                                                                    @else
                                                                        <span class="badge badge-success">Sudah</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="/berkas_permohonan/{{$dt->berkas_permohonan}}" class="btn btn-info btn-block btn-sm"><small>Unduh Berkas Permohonan</small></a>
                                                                    <a href="javascript:void(0)" onclick="ubahDataCanting({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><small>Input Canting & Dokumen Hasil</small></a>
                                                                    <a href="javascript:void(0)" onclick="unggahBerkasPermohonanSelesai({{$dt->id}})" class="btn btn-success btn-block btn-sm"><small>Unggah Dokumen Hasil</small></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Ubah Foto -->
                                                            <div class="modal fade" id="editDataFotoModal">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content bg-info">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Unggah Berkas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>
                                                                                <strong>Penting Untuk Diketahui !!!</strong> Sebelum Anda mengisi formulir ini. 
                                                                                <ol>
                                                                                    <li>Pastikan bahwa Anda sudah melakukan kompres ke dalam bentuk (.ZIP).</li>
                                                                                    <li>Anda sudah memastikan file yang akan dikirim sesuai dengan permohonan yang bersangkutan.</li>
                                                                                    <li>Untuk mengisi berkas, klik pada tombol <button>Choose File</button> lalu pilih file Zip sebagaimana dimaksud pada point paling atas.</li>
                                                                                </ol>
                                                                            </p>
                                                                            <form id="editDataFotoForm" action="" method="post" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" id="id1" name="id1"/>
                                                                                <label>Nama Pemohon</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_pemohon1" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Alamat Pemohon</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="alamat_pemohon1" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Jenis Permohonan</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="jenis_permohonan1" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Upload File (.ZIP)</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="file" id="file" name="file" class="form-control">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-primary btn-block">Upload Berkas</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function unggahBerkasPermohonanSelesai(id)
                                                                {
                                                                    $.get('/berkas_pengurusans/'+id,function(berkas_pengurusan){
                                                                        $("#id1").val(berkas_pengurusan.id);
                                                                        $("#nama_pemohon1").val(berkas_pengurusan.nama_pemohon);
                                                                        $("#alamat_pemohon1").val(berkas_pengurusan.alamat_pemohon);
                                                                        $("#jenis_permohonan1").val(berkas_pengurusan.jenis_permohonan);
                                                                        $("#editDataFotoModal").modal('toggle');
                                                                    });
                                                                    $.ajaxSetup({
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                        }
                                                                    });
                                                                    $("#editDataFotoForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        var formData = new FormData(this);
                                                                        $.ajax({
                                                                            url:"{{route('berkas_permohonan.upload_berkas_permohonan_selesai')}}",
                                                                            type: "POST",
                                                                            data: formData,
                                                                            cache:false,
                                                                            contentType: false,
                                                                            processData: false,
                                                                            success: (data) =>{
                                                                                this.reset();
                                                                                $("#editDataFotoModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_berkas_permohonan_belum_selesai_oleh_admin_data')}}";
                                                                            }
                                                                        });
                                                                    });
                                                                }
                                                            </script>
                                                            <!-- Ubah Data Canting -->
                                                            <div class="modal fade" id="ubahDataModal">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Input Catatan Penting</h4>
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
                                                                                <label>Jenis Permohonan</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="jenis_permohonan2" class="form-control" disabled>
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
                                                                                    <textarea id="isi_canting2"></textarea>
                                                                                </div>
                                                                                <label>Dokumen Hasil *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <textarea id="dokumen_hasil2"></textarea>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan Catatan Penting</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function ubahDataCanting(id)
                                                                {
                                                                    $.get('/berkas_pengurusans/'+id,function(berkas_pengurusan){
                                                                        $("#id2").val(berkas_pengurusan.id);
                                                                        $("#nama_pemohon2").val(berkas_pengurusan.nama_pemohon);
                                                                        $("#alamat_pemohon2").val(berkas_pengurusan.alamat_pemohon);
                                                                        $("#jenis_permohonan2").val(berkas_pengurusan.jenis_permohonan);
                                                                        $("#tanggal_pengajuan2").val(berkas_pengurusan.tanggal_pengajuan);
                                                                        $("#isi_canting2").summernote('code', berkas_pengurusan.isi_canting);
                                                                        $("#dokumen_hasil2").summernote('code', berkas_pengurusan.dokumen_hasil);
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id2").val();
                                                                        let isi_canting = $("#isi_canting2").val();
                                                                        let dokumen_hasil = $("#dokumen_hasil2").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('berkas_pengurusan.isi_canting')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                isi_canting:isi_canting,
                                                                                dokumen_hasil:dokumen_hasil,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_berkas_permohonan_belum_selesai_oleh_admin_data')}}";
                                                                            }
                                                                        })
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

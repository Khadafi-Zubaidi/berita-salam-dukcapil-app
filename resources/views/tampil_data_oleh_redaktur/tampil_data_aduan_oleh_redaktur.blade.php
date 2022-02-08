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
                        <a href="#" class="nav-link">Dashboard Redaktur</a>
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
                            <img src="{{asset('foto_redaktur')}}/{{$LoggedUserInfo->foto}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('dashboard_redaktur')}}" class="nav-link">
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
                                        <h5 class="card-title">Data Aduan</h5>
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
                                                            <th>NIK</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Isi Aduan</th>
                                                            <th>Tanggapan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->nik}}</td>
                                                                <td>{{$dt->nama}}</td>
                                                                <td>{{$dt->email}}</td>
                                                                <td>@php echo substr($dt->isi_aduan, 0, 100) @endphp ...</td>
                                                                <td>@if ($dt->tanggapan == 'S')
                                                                        <span class="badge badge-success">Sudah</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Belum</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="ubahData({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><i class="fa fa-edit"></i></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Ubah Data -->
                                                            <div class="modal fade" id="ubahDataModal">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Lihat Data Aduan</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="ubahDataForm" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id1"/>
                                                                                <label>NIK *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nik1" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Nama *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama1" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Email *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="email" id="email1" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Isi Aduan *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <textarea id="isi_aduan1"></textarea>
                                                                                </div>
                                                                                <label>Status Tanggapan * (S: Sudah/B: Belum)</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="tanggapan1" class="form-control" required>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan Data</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function ubahData(id)
                                                                {
                                                                    $.get('/aduans1/'+id,function(aduan){
                                                                        $("#id1").val(aduan.id);
                                                                        $("#nik1").val(aduan.nik);
                                                                        $("#nama1").val(aduan.nama);
                                                                        $("#email1").val(aduan.email);
                                                                        $("#isi_aduan1").summernote('code', aduan.isi_aduan);
                                                                        $("#tanggapan1").val(aduan.tanggapan);
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id1").val();
                                                                        let tanggapan = $("#tanggapan1").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('aduan.updatedata')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                tanggapan:tanggapan,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_aduan_oleh_redaktur')}}";
                                                                            }
                                                                        })
                                                                    })
                                                                }
                                                            </script>
                                                            <!-- Hapus Data -->
                                                            <div class="modal fade" id="hapusDataModal">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Hapus Data</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="hapusDataForm" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id6"/>
                                                                                <label>NIP *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nip6" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-danger btn-block">Hapus Data</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function hapusData(id)
                                                                {
                                                                    $.get('/reporters6/'+id,function(reporter){
                                                                        $("#id6").val(reporter.id);
                                                                        $("#nip6").val(reporter.nip);
                                                                        $("#hapusDataModal").modal('toggle');
                                                                    })
                                                                    $("#hapusDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id6").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('reporter.deletedata')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#hapusDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_reporter_oleh_redaktur')}}";
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

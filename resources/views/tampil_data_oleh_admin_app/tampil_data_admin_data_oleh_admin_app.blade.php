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
                                <a href="{{route('tambah_data_admin_data_oleh_admin_app')}}" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>
                                        Tambah Data
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('dashboard_admin_app')}}" class="nav-link">
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
                                        <h5 class="card-title">Data Admin Data</h5>
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
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Jabatan</th>
                                                            <th>Pangkat / Golongan</th>
                                                            <th>Foto</th>
                                                            <th>Aktif</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->nip}}</td>
                                                                <td>{{$dt->nama}}</td>
                                                                <td>{{$dt->jabatan}}</td>
                                                                <td>{{$dt->pangkat_golongan}}</td>
                                                                <td><img src="{{asset('foto_admin_data')}}/{{$dt->foto}}" width="100px" height="100px"  alt="User Image"></td>
                                                                <td>@if ($dt->aktif == 'Y')
                                                                        <span class="badge badge-success">Aktif</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                                    @endif</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="ubahData({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><i class="fa fa-user-edit"></i></a>
                                                                    <a href="javascript:void(0)" onclick="ubahDataPassword({{$dt->id}})" class="btn btn-danger btn-block btn-sm"><i class="fa fa-key"></i></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Ubah Data Pokok -->
                                                            <div class="modal fade" id="ubahDataModal">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Ubah Data</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="ubahDataForm" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id1"/>
                                                                                <label>NIP *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nip1" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Nama *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama1" class="form-control" required>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Jabatan *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="jabatan1" class="form-control" required>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Pangkat / Golongan *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="pangkat_golongan1" class="form-control" required>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Status Keaktifan * (Y/T)</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="aktif1" class="form-control" required>
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
                                                                    $.get('/admindatas/'+id,function(admindata){
                                                                        $("#id1").val(admindata.id);
                                                                        $("#nip1").val(admindata.nip);
                                                                        $("#nama1").val(admindata.nama);
                                                                        $("#jabatan1").val(admindata.jabatan);
                                                                        $("#pangkat_golongan1").val(admindata.pangkat_golongan);
                                                                        $("#aktif1").val(admindata.aktif);
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id1").val();
                                                                        let nip = $("#nip1").val();
                                                                        let nama = $("#nama1").val();
                                                                        let jabatan = $("#jabatan1").val();
                                                                        let pangkat_golongan = $("#pangkat_golongan1").val();
                                                                        let aktif = $("#aktif1").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('admindata.updatedata')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                nip:nip,
                                                                                nama:nama,
                                                                                jabatan:jabatan,
                                                                                pangkat_golongan:pangkat_golongan,
                                                                                aktif:aktif,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_admin_data_oleh_admin_app')}}";
                                                                            }
                                                                        })
                                                                    })
                                                                }
                                                            </script>
                                                            <!-- Ubah Data Password -->
                                                            <div class="modal fade" id="ubahDataModalPassword">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Ubah Data Password</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="ubahDataPasswordForm" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id2"/>
                                                                                <label>NIP *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nip2" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Nama *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama2" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Password *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="password2" class="form-control" required>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan Data Password</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function ubahDataPassword(id)
                                                                {
                                                                    $.get('/admindatas/'+id,function(admindata){
                                                                        $("#id2").val(admindata.id);
                                                                        $("#nip2").val(admindata.nip);
                                                                        $("#nama2").val(admindata.nama);
                                                                        $("#ubahDataModalPassword").modal('toggle');
                                                                    })
                                                                    $("#ubahDataPasswordForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id2").val();
                                                                        let password = $("#password2").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('admindata.updatedatapassword')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                password:password,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_admin_data_oleh_admin_app')}}";
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

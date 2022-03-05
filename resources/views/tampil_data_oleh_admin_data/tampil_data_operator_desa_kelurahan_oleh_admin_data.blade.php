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
                                <a href="{{route('tambah_data_operator_desa_kelurahan_oleh_admin_data')}}" class="nav-link">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>
                                        Tambah Data
                                    </p>
                                </a>
                            </li>
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
                                        <h5 class="card-title">Data Operator Desa / Kelurahan</h5>
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
                                                            <th>ID Operator</th>
                                                            <th>Nama Operator</th>
                                                            <th>Jabatan</th>
                                                            <th>Pangkat/Golongan</th>
                                                            <th>Aktif</th>
                                                            <th>Desa/Kelurahan</th>
                                                            <th>Kecamatan</th>
                                                            <th>Foto</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->nip}}</td>
                                                                <td>{{$dt->nama_operator}}</td>
                                                                <td>{{$dt->jabatan}}</td>
                                                                <td>{{$dt->pangkat_golongan}}</td>
                                                                <td>
                                                                    @if ($dt->aktif == 'Y')
                                                                        <span class="badge badge-success">Aktif</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{$dt->nama_desa_kelurahan}}</td>
                                                                <td>{{$dt->nama_kecamatan}}</td>
                                                                <td><img src="{{asset('foto_operator_desa_kelurahan')}}/{{$dt->foto}}" width="100px" height="100px"  alt="User Image"></td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="ubahData({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><i class="fa fa-edit"></i></a>
                                                                    <a href="javascript:void(0)" onclick="ubahDataPassword({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><i class="fa fa-key"></i></a>
                                                                    <a href="javascript:void(0)" onclick="hapusData({{$dt->id}})" class="btn btn-danger btn-block btn-sm"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Ubah Data -->
                                                            <div class="modal fade" id="ubahDataModal">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Ubah Data Operator Desa/Kelurahan</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="ubahDataForm" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id1"/>
                                                                                <label>ID Operator *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="number" id="nip1" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Nama Operator *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_operator1" class="form-control" required>
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
                                                                                <label>Pangkat/Golongan *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="pangkat_golongan1" class="form-control" required>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Aktif * (Y:Ya, T:Tidak)</label><br>
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
                                                                    $.get('/operator_desa_kelurahans/'+id,function(operator_desa_kelurahan){
                                                                        $("#id1").val(operator_desa_kelurahan.id);
                                                                        $("#nip1").val(operator_desa_kelurahan.nip);
                                                                        $("#nama_operator1").val(operator_desa_kelurahan.nama_operator);
                                                                        $("#jabatan1").val(operator_desa_kelurahan.jabatan);
                                                                        $("#pangkat_golongan1").val(operator_desa_kelurahan.pangkat_golongan);
                                                                        $("#aktif1").val(operator_desa_kelurahan.aktif);    
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id1").val();
                                                                        let nama_operator = $("#nama_operator1").val();
                                                                        let jabatan = $("#jabatan1").val();
                                                                        let pangkat_golongan = $("#pangkat_golongan1").val();
                                                                        let aktif = $("#aktif1").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('operator_desa_kelurahan.updatedata')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                nama_operator:nama_operator,
                                                                                jabatan:jabatan,
                                                                                pangkat_golongan:pangkat_golongan,
                                                                                aktif:aktif,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_operator_desa_kelurahan_oleh_admin_data')}}";
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
                                                                                <input type="hidden" id="id2"/>
                                                                                <label>ID Operator *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nip2" class="form-control" disabled>
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
                                                                    $.get('/operator_desa_kelurahans/'+id,function(operator_desa_kelurahan){
                                                                        $("#id2").val(operator_desa_kelurahan.id);
                                                                        $("#nip2").val(operator_desa_kelurahan.nip);
                                                                        $("#hapusDataModal").modal('toggle');
                                                                    })
                                                                    $("#hapusDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id2 = $("#id2").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('operator_desa_kelurahan.hapus_data')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id2:id2,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#hapusDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_operator_desa_kelurahan_oleh_admin_data')}}";
                                                                            }
                                                                        })
                                                                    })
                                                                }
                                                            </script>
                                                            <!-- Ubah Data Password -->
                                                            <div class="modal fade" id="ubahDataPasswordModal">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Ubah Data Password Operator Desa/Kelurahan</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="ubahDataPasswordForm" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id3"/>
                                                                                <label>ID Operator *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="number" id="nip3" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Nama Operator *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_operator3" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Password *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="password3" class="form-control" required>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan Password</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function ubahDataPassword(id)
                                                                {
                                                                    $.get('/operator_desa_kelurahans/'+id,function(operator_desa_kelurahan){
                                                                        $("#id3").val(operator_desa_kelurahan.id);
                                                                        $("#nip3").val(operator_desa_kelurahan.nip);
                                                                        $("#nama_operator3").val(operator_desa_kelurahan.nama_operator);    
                                                                        $("#ubahDataPasswordModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataPasswordForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id3 = $("#id3").val();
                                                                        let password3 = $("#password3").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('operator_desa_kelurahan.update_password')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id3:id3,
                                                                                password3:password3,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataPasswordModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_operator_desa_kelurahan_oleh_admin_data')}}";
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

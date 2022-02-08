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
                                        <h5 class="card-title">Data Berita</h5>
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
                                                            <th>Judul</th>
                                                            <th>Isi Berita</th>
                                                            <th>Tanggal</th>
                                                            <th>Foto</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->judul}}</td>
                                                                <td>@php echo substr($dt->isi_berita, 0, 100) @endphp ...</td>
                                                                <td>{{$dt->tanggal_berita}}</td>
                                                                <td><img src="{{asset('foto_berita')}}/{{$dt->foto}}" width="250px" height="150px"  alt="User Image"></td>
                                                                <td>
                                                                    @if ($dt->diperiksa_oleh_redaktur == 'S')
                                                                        <span class="badge badge-success">Sudah Diperiksa Redaktur</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Belum Diperiksa Redaktur</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="ubahData({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><i class="fa fa-edit"></i></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Ubah Data -->
                                                            <div class="modal fade" id="ubahDataModal">
                                                                <div class="modal-dialog modal-lg">
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
                                                                                <label>Judul *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="judul1" class="form-control">
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Isi Berita *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <textarea id="isi_berita1" rows="5" cols="100"></textarea>
                                                                                    <!--<textarea id="isi_berita1"></textarea>-->
                                                                                </div>
                                                                                <label>Tanggal Berita *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="tanggal_berita1" class="form-control" required>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Diperiksa Oleh Redaktur * (S:Sudah, B:Belum)</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="diperiksa_oleh_redaktur1" class="form-control" required>
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
                                                                    $.get('/beritas4/'+id,function(berita){
                                                                        $("#id1").val(berita.id);
                                                                        $("#judul1").val(berita.judul);
                                                                        $("#isi_berita1").summernote('code', berita.isi_berita);
                                                                        $("#tanggal_berita1").val(berita.tanggal_berita);
                                                                        $("#diperiksa_oleh_redaktur1").val(berita.diperiksa_oleh_redaktur);
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id1").val();
                                                                        let judul = $("#judul1").val();
                                                                        let isi_berita = $("#isi_berita1").val();
                                                                        let tanggal_berita = $("#tanggal_berita1").val();
                                                                        let diperiksa_oleh_redaktur = $("#diperiksa_oleh_redaktur1").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('berita.updatedata2')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                judul:judul,
                                                                                isi_berita:isi_berita,
                                                                                tanggal_berita:tanggal_berita,
                                                                                diperiksa_oleh_redaktur:diperiksa_oleh_redaktur,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_berita_oleh_redaktur')}}";
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

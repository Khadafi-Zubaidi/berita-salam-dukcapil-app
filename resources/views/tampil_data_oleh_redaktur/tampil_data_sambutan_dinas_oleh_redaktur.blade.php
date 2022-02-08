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
                                        <h5 class="card-title">Data Sambutan Dinas</h5>
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
                                                            <th>Isi Sambutan</th>
                                                            <th>Foto</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->isi_sambutan}}</td>
                                                                <td><img src="{{asset('foto_sambutan_dinas')}}/{{$dt->foto}}" width="250px" height="259px"  alt="User Image"></td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="ubahData({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><i class="fa fa-edit"></i></a>
                                                                    <a href="javascript:void(0)" onclick="editDataFoto({{$dt->id}})" class="btn btn-info btn-block btn-sm"><i class="fa fa-image"></i></a>
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
                                                                                <label>Isi Sambutan *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <textarea id="isi_sambutan1" rows="5" cols="100"></textarea>
                                                                                    <!--<textarea id="isi_berita1"></textarea>-->
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
                                                                    $.get('/sambutandinas1/'+id,function(sambutan){
                                                                        $("#id1").val(sambutan.id);
                                                                        $("#isi_sambutan1").val(sambutan.isi_sambutan);
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id1").val();
                                                                        let isi_sambutan = $("#isi_sambutan1").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('sambutandinas.updatedata1')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                isi_sambutan:isi_sambutan,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_sambutan_dinas_oleh_redaktur')}}";
                                                                            }
                                                                        })
                                                                    })
                                                                }
                                                            </script>
                                                            <!-- Ubah Foto -->
                                                            <div class="modal fade" id="editDataFotoModal">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-info">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Ubah Data Foto</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="editDataFotoForm" action="" method="post" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" id="id4" name="id4"/>
                                                                                <label>Foto Sebelumnya *</label><br>
                                                                                <div align="center">
                                                                                    <img id="foto4" width="160px" height="115px" alt="User Image">
                                                                                </div>
                                                                                &nbsp;
                                                                                <label>Upload File (250px X 250px)</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="file" id="file" name="file" class="form-control">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan Data Foto</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function editDataFoto(id)
                                                                {
                                                                    $.get('/sambutandinas2/'+id,function(sambutandinas){
                                                                        $("#id4").val(sambutandinas.id);
                                                                        $("#foto4").attr('src',"foto_sambutan_dinas/"+sambutandinas.foto);
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
                                                                            url:"{{route('sambutan_dinas.updatedatafoto')}}",
                                                                            type: "POST",
                                                                            data: formData,
                                                                            cache:false,
                                                                            contentType: false,
                                                                            processData: false,
                                                                            success: (data) =>{
                                                                                this.reset();
                                                                                $("#editDataFotoModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_sambutan_dinas_oleh_redaktur')}}";
                                                                            }
                                                                        });
                                                                    });
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

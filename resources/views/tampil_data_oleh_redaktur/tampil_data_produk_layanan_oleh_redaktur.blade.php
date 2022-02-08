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
                                <a href="{{route('tambah_data_produk_layanan_oleh_redaktur')}}" class="nav-link">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>
                                        Tambah Data
                                    </p>
                                </a>
                            </li>
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
                                        <h5 class="card-title">Data Produk Layanan</h5>
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
                                                            <th>Nama Produk Layanan</th>
                                                            <th>Dasar Hukum</th>
                                                            <th>Persyaratan</th>
                                                            <th>Prosedur / Mekanisme</th>
                                                            <th>Waktu Penyelesaian</th>
                                                            <th>Biaya / Tarif</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->nama_produk_layanan}}</td>
                                                                <td>@php echo substr($dt->dasar_hukum, 0, 100) @endphp ...</td>
                                                                <td>@php echo substr($dt->persyaratan, 0, 100) @endphp ...</td>
                                                                <td>@php echo substr($dt->prosedur_mekanisme, 0, 100) @endphp ...</td>
                                                                <td>@php echo substr($dt->waktu_penyelesaian, 0, 100) @endphp ...</td>
                                                                <td>{{$dt->biaya_tarif}}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="ubahData({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><i class="fa fa-edit"></i></a>
                                                                    <a href="javascript:void(0)" onclick="editDataFoto({{$dt->id}})" class="btn btn-info btn-block btn-sm"><i class="fa fa-image"></i></a>
                                                                    <a href="javascript:void(0)" onclick="hapusData({{$dt->id}})" class="btn btn-danger btn-block btn-sm"><i class="fa fa-trash"></i></a>
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
                                                                                <label>Nama Produk Pelayanan *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_produk_pelayanan1" class="form-control">
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Dasar Hukum *</label><br>
                                                                                <div class="input-group mb-3 col-12">
                                                                                    <textarea id="dasar_hukum1"></textarea>
                                                                                </div>
                                                                                <label>Persyaratan *</label><br>
                                                                                <div class="input-group mb-3 col-12">
                                                                                    <textarea id="persyaratan1"></textarea>
                                                                                </div>
                                                                                <label>Prosedur / Mekanisme *</label><br>
                                                                                <div class="input-group mb-3 col-12">
                                                                                    <textarea id="prosedur_mekanisme1"></textarea>
                                                                                </div>
                                                                                <label>Waktu Penyelesaian *</label><br>
                                                                                <div class="input-group mb-3 col-12">
                                                                                    <textarea id="waktu_penyelesaian1"></textarea>
                                                                                </div>
                                                                                <label>Biaya Tarif *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="biaya_tarif1" class="form-control">
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
                                                                    $.get('/produklayanans1/'+id,function(produklayanan){
                                                                        $("#id1").val(produklayanan.id);
                                                                        $("#nama_produk_pelayanan1").val(produklayanan.nama_produk_layanan);
                                                                        $("#dasar_hukum1").summernote('code', produklayanan.dasar_hukum);
                                                                        $("#persyaratan1").summernote('code', produklayanan.persyaratan);
                                                                        $("#prosedur_mekanisme1").summernote('code', produklayanan.prosedur_mekanisme);
                                                                        $("#waktu_penyelesaian1").summernote('code', produklayanan.waktu_penyelesaian);
                                                                        $("#biaya_tarif1").val(produklayanan.biaya_tarif);
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                    $("#ubahDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id1").val();
                                                                        let nama_produk_layanan = $("#nama_produk_pelayanan1").val();
                                                                        let dasar_hukum = $("#dasar_hukum1").val();
                                                                        let persyaratan = $("#persyaratan1").val();
                                                                        let prosedur_mekanisme = $("#prosedur_mekanisme1").val();
                                                                        let waktu_penyelesaian = $("#waktu_penyelesaian1").val();
                                                                        let biaya_tarif = $("#biaya_tarif1").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('produklayanan1.updatedata')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                nama_produk_layanan:nama_produk_layanan,
                                                                                dasar_hukum:dasar_hukum,
                                                                                persyaratan:persyaratan,
                                                                                prosedur_mekanisme:prosedur_mekanisme,
                                                                                waktu_penyelesaian:waktu_penyelesaian,
                                                                                biaya_tarif:biaya_tarif,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#ubahDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_produk_layanan_oleh_redaktur')}}";
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
                                                                                <label>Nama Produk Layanan *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_produk_layanan4" class="form-control" disabled>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Foto Sebelumnya *</label><br>
                                                                                <div align="center">
                                                                                    <img id="foto4" width="160px" height="115px" alt="User Image">
                                                                                </div>
                                                                                &nbsp;
                                                                                <label>Upload File (751px X 521px)</label><br>
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
                                                                    $.get('/produklayanans1/'+id,function(produklayanan){
                                                                        $("#id4").val(produklayanan.id);
                                                                        $("#nama_produk_layanan4").val(produklayanan.nama_produk_layanan);
                                                                        $("#foto4").attr('src',"foto_produk_layanan/"+produklayanan.foto);
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
                                                                            url:"{{route('produklayanan.updatedatafoto')}}",
                                                                            type: "POST",
                                                                            data: formData,
                                                                            cache:false,
                                                                            contentType: false,
                                                                            processData: false,
                                                                            success: (data) =>{
                                                                                this.reset();
                                                                                $("#editDataFotoModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_produk_layanan_oleh_redaktur')}}";
                                                                            }
                                                                        });
                                                                    });
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
                                                                                <label>Nama Produk Pelayanan *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_produk_layanan6" class="form-control" disabled>
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
                                                                    $.get('/produklayanans6/'+id,function(produklayanan){
                                                                        $("#id6").val(produklayanan.id);
                                                                        $("#nama_produk_layanan6").val(produklayanan.nama_produk_layanan);
                                                                        $("#hapusDataModal").modal('toggle');
                                                                    })
                                                                    $("#hapusDataForm").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id6").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('produklayanan6.deletedata')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#hapusDataModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_produk_layanan_oleh_redaktur')}}";
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

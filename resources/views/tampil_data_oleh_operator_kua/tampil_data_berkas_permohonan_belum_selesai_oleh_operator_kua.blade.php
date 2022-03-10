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
                            <img src="{{asset('foto_operator_kua')}}/{{$LoggedUserInfo->foto}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama_operator}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('dashboard_operator_kua')}}" class="nav-link">
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
                                <div class="card card-danger">
                                  <div class="card-header">
                                    <h3 class="card-title">Perhatian</h3>
                    
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                    <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">
                                    <div class="col-md-12">
                                        <p>
                                            <strong>Penting Untuk Diketahui !!!</strong> 
                                            <ol>
                                                <li>Jika status pengurusan permohonan Belum Selesai, maka pastikan Anda untuk mengecek Catatan Penting dengan cara mengklik tombol <button><small>Catatan Penting</small></li>
                                                <li>Untuk mengirim dokumen kelengkapan guna perbaikan, maka Anda dapat menekan tombol <button><small>Unggah Berkas Permohonan Lagi</small></button></li>
                                            </ol> 
                                        </p>
                                    </div>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Data Permohonan Yang Belum Selesai</h5>
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
                                                            <th>NIK Pemohon</th>
                                                            <th>Nama Pemohon</th>
                                                            <th>Alamat Pemohon</th>
                                                            <th>Jenis Permohonan</th>
                                                            <th>Tanggal Pengajuan</th>
                                                            <th>No.Pendaftaran</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->nik_pemohon}}</td>
                                                                <td>{{$dt->nama_pemohon}}</td>
                                                                <td>{{$dt->alamat_pemohon}}</td>
                                                                <td>{!! $dt->jenis_permohonan !!}</td>
                                                                <td>{{$dt->tanggal_pengajuan}}</td>
                                                                <td>{{$dt->nomor_pendaftaran}}</td>
                                                                <td>
                                                                    @if ($dt->status == 'B')
                                                                        <span class="badge badge-danger">Belum Selesai</span>
                                                                    @else
                                                                        <span class="badge badge-success">Sudah Selesai</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="ubahData({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><small>Ubah Data Permohonan</small></a>
                                                                    <a href="/berkas_permohonan_dari_kua/{{$dt->berkas_permohonan}}" class="btn btn-info btn-block btn-sm"><small>Unduh Berkas Permohonan</small></a>
                                                                    <a href="javascript:void(0)" onclick="lihatCanting({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><small>Catatan Penting</small></a>
                                                                    <a href="{{action('App\Http\Controllers\BerkasPermohonanDariKuaController@cetak_bukti_pendaftaran_oleh_operator_kua', $dt->id)}}" class="btn btn-success btn-block btn-sm"><small>Cetak Bukti Pendaftaran</small></a>
                                                                    <a href="javascript:void(0)" onclick="lihatDokumenKeluaran({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><small>Lihat Daftar Dokumen Hasil</small></a>
                                                                    <a href="javascript:void(0)" onclick="unggahBerkasPermohonanLagi({{$dt->id}})" class="btn btn-danger btn-block btn-sm"><small>Unggah Berkas Permohonan Lagi</small></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Ubah Data Permohonan -->
                                                            <div class="modal fade" id="Modal7">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Ubah Data Permohonan</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="Form7" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id7"/>
                                                                                <label>NIK Pemohon</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="number" id="nik_pemohon7" class="form-control">
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Nama Pemohon</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_pemohon7" class="form-control">
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Alamat Pemohon</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="alamat_pemohon7" class="form-control">
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fas fa-id-card"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <label>Jenis Permohonan</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-md-12">
                                                                                        <textarea id="jenis_permohonan"></textarea>
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
                                                                    $.get('/berkas_permohonan_dari_kua/'+id,function(berkas_permohonan_dari_kua){
                                                                        $("#id7").val(berkas_permohonan_dari_kua.id);
                                                                        $("#nik_pemohon7").val(berkas_permohonan_dari_kua.nik_pemohon);
                                                                        $("#nama_pemohon7").val(berkas_permohonan_dari_kua.nama_pemohon);
                                                                        $("#alamat_pemohon7").val(berkas_permohonan_dari_kua.alamat_pemohon);
                                                                        $("#jenis_permohonan").summernote('code', berkas_permohonan_dari_kua.jenis_permohonan);
                                                                        $("#Modal7").modal('toggle');
                                                                    })
                                                                    $("#Form7").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id7").val();
                                                                        let nik_pemohon = $("#nik_pemohon7").val();
                                                                        let nama_pemohon = $("#nama_pemohon7").val();
                                                                        let alamat_pemohon = $("#alamat_pemohon7").val();
                                                                        let jenis_permohonan = $("#jenis_permohonan").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('berkas_permohonan_dari_kua.pembaharuan_data')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                nik_pemohon:nik_pemohon,
                                                                                nama_pemohon:nama_pemohon,
                                                                                alamat_pemohon:alamat_pemohon,
                                                                                jenis_permohonan:jenis_permohonan,
                                                                                _token:_token
                                                                            },
                                                                            success:function(response){
                                                                                $("#Modal7").modal('hide');
                                                                                window.location = "{{route('tampil_data_berkas_permohonan_belum_selesai_oleh_operator_kua')}}";
                                                                            }
                                                                        })
                                                                    })
                                                                }
                                                            </script>
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
                                                                                    <li>Pastikan bahwa Anda sudah melakukan kompres ke dalam bentuk (.ZIP/.RAR).</li>
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
                                                                                <label>Upload File (.ZIP/.RAR)</label><br>
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
                                                                function unggahBerkasPermohonanLagi(id)
                                                                {
                                                                    $.get('/berkas_permohonan_dari_kua/'+id,function(berkas_permohonan_dari_kua){
                                                                        $("#id1").val(berkas_permohonan_dari_kua.id);
                                                                        $("#nama_pemohon1").val(berkas_permohonan_dari_kua.nama_pemohon);
                                                                        $("#alamat_pemohon1").val(berkas_permohonan_dari_kua.alamat_pemohon);
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
                                                                            url:"{{route('berkas_permohonan_dari_kua.upload_berkas_permohonan_lagi')}}",
                                                                            type: "POST",
                                                                            data: formData,
                                                                            cache:false,
                                                                            contentType: false,
                                                                            processData: false,
                                                                            success: (data) =>{
                                                                                this.reset();
                                                                                $("#editDataFotoModal").modal('hide');
                                                                                window.location = "{{route('tampil_data_berkas_permohonan_belum_selesai_oleh_operator_kua')}}";
                                                                            }
                                                                        });
                                                                    });
                                                                }
                                                            </script>
                                                            <!-- Lihat Data Canting -->
                                                            <div class="modal fade" id="ubahDataModal">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content bg-warning">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Catatan Penting</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="ubahDataForm1" action="" method="post">
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
                                                                                <label>Catatan Penting</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-md-12">
                                                                                        <textarea id="isi_canting2"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function lihatCanting(id)
                                                                {
                                                                    $.get('/berkas_permohonan_dari_kua/'+id,function(berkas_permohonan_dari_kua){
                                                                        $("#id2").val(berkas_permohonan_dari_kua.id);
                                                                        $("#nama_pemohon2").val(berkas_permohonan_dari_kua.nama_pemohon);
                                                                        $("#alamat_pemohon2").val(berkas_permohonan_dari_kua.alamat_pemohon);
                                                                        $("#tanggal_pengajuan2").val(berkas_permohonan_dari_kua.tanggal_pengajuan);
                                                                        $("#isi_canting2").summernote('code', berkas_permohonan_dari_kua.isi_canting);
                                                                        $("#ubahDataModal").modal('toggle');
                                                                    })
                                                                }
                                                            </script>
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
                                                                                    <div class="col-md-12">
                                                                                        <textarea id="dokumen_hasil3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function lihatDokumenKeluaran(id)
                                                                {
                                                                    $.get('/berkas_permohonan_dari_kua/'+id,function(berkas_permohonan_dari_kua){
                                                                        $("#id3").val(berkas_permohonan_dari_kua.id);
                                                                        $("#nama_pemohon3").val(berkas_permohonan_dari_kua.nama_pemohon);
                                                                        $("#tanggal_pengajuan3").val(berkas_permohonan_dari_kua.tanggal_pengajuan);
                                                                        $("#nomor_pendaftaran3").val(berkas_permohonan_dari_kua.nomor_pendaftaran);
                                                                        $("#dokumen_hasil3").summernote('code', berkas_permohonan_dari_kua.dokumen_hasil);
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Dinas Kependudukan dan Pencatatan Sipil</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link href="{{asset('beranda')}}/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('beranda')}}/css/mdb.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('beranda')}}/css/addons/datatables.min.css">
  <link rel="stylesheet" href="{{asset('beranda')}}/css/addons/datatables-select.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

</head>

<body class="homepage-v2">

  <!-- Navigation -->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light scrolling-navbar white">
      <div class="container-fluid justify-content-center align-items-center">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
          aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent-4">
          <ul class="navbar-nav">
            <li class="nav-item ml-4 mb-0">
                <a class="nav-link waves-effect waves-light font-weight-bold" href="/">BERANDA
                  <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown ml-4 mb-0">
              <a class="nav-link dropdown-toggle waves-effect waves-light font-weight-bold" id="navbarDropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> PROFIL
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item waves-effect waves-light" href="{{route('tampil_visi_misi')}}">Visi dan Misi</a>
                <a class="dropdown-item waves-effect waves-light" href="{{route('tampil_struktur_organisasi')}}">Struktur Organisasi</a>
                <a class="dropdown-item waves-effect waves-light" href="{{route('tampil_arsip_tupoksi')}}">Tugas Pokok dan Fungsi</a>
              </div>
            </li>
            <li class="nav-item ml-4 mb-0">
                <a class="nav-link waves-effect waves-light font-weight-bold" href="{{route('tampil_arsip_berita')}}">BERITA
                  <span class="sr-only"></span>
                </a>
            </li>
            <li class="nav-item ml-4 mb-0">
              <a class="nav-link waves-effect waves-light font-weight-bold" href="{{route('tampil_arsip_produk_layanan')}}">PRODUK LAYANAN
                <span class="sr-only"></span>
              </a>
            </li>
            <li class="nav-item ml-4 mb-0">
              <a class="nav-link waves-effect waves-light font-weight-bold" href="{{route('tampil_arsip_inovasi')}}">INOVASI
                <span class="sr-only"></span>
              </a>
            </li>
            <li class="nav-item ml-4 mb-0">
              <a class="nav-link waves-effect waves-light font-weight-bold" href="{{route('tampil_arsip_jdih')}}">JDIH
                <span class="sr-only"></span>
              </a>
            </li>
            <li class="nav-item ml-4 mb-0">
              <a class="nav-link waves-effect waves-light font-weight-bold" href="{{route('tampil_arsip_sop')}}">SOP
                <span class="sr-only"></span>
              </a>
            </li>
            <li class="nav-item ml-4 mb-0">
              <a class="nav-link waves-effect waves-light font-weight-bold" href="{{route('tampil_arsip_formulir')}}">UNDUH
                <span class="sr-only"></span>
              </a>
            </li>
            
            <li class="nav-item ml-4 mb-0">
              <a class="nav-link waves-effect waves-light font-weight-bold" href="{{route('tampil_kolom_aduan')}}">HUBUNGI KAMI
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
        </div>

        <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light">
              <i class="fab fa-google-plus-g"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
        </ul>

      </div>

    </nav>    <!-- Navbar -->

  </header>
  <!-- Navigation -->

  <!-- Main Layout -->
  <main>

    <!-- Carousel Wrapper -->
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <!-- Slides -->
        <div class="carousel-inner" role="listbox">
          <!-- First slide -->
          @foreach($DataCarousel as $dc => $slide)
            @if($dc == 0)
            <div class="carousel-item active">
              <div class="view h-100">
                <img class="d-block h-100 w-lg-100" src="{{asset('foto_carousel')}}/{{$slide->foto}}"
                  alt="First slide">
                <div class="mask rgba-indigo-light">
                  <!-- Caption -->
                  <div class="full-bg-img flex-center white-text">
                    <ul class="animated fadeIn col-10 list-unstyled">
                      <li>
                        <h1 class="h1-responsive font-weight-medium">
                          {{$slide->judul}}
                        </h1>
                      </li>
                      <li>
                        <h5>
                          {{$slide->keterangan_singkat}}
                        </h5>
                      </li>
                    </ul>
                  </div>
                  <!-- Caption -->
                </div>
              </div>
            </div>
            @else
            <div class="carousel-item h-100">
              <div class="view h-100">
                <img class="d-block h-100 w-lg-100" src="{{asset('foto_carousel')}}/{{$slide->foto}}"
                  alt="Second slide">
                <div class="mask rgba-stylish-light">
                  <!-- Caption -->
                  <div class="full-bg-img flex-center white-text">
                    <ul class="animated fadeIn col-10 list-unstyled">
                      <li>
                        <h1 class="h1-responsive font-weight-medium">{{$slide->judul}}</h1>
                      </li>
                      <li>
                        <h5>{{$slide->keterangan_singkat}}</h5>
                      </li>
                    </ul>
                  </div>
                  <!-- Caption -->
                </div>
              </div>
            </div>
            @endif

          
          @endforeach
        </div>
        <!-- Slides -->
        <!-- Controls -->
        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        <!-- Controls -->
      </div>
      <!-- Carousel Wrapper -->
    
    <div class="container-fluid mb-5">
        <section>
            <div class="col-md-12">
              <!-- Grid row -->
              <div class="text-center mb-2 mt-2">
                <hr>  
                <h3>Arsip Jaringan Dokumentasi dan Informasi Hukum</h3>
                <hr>  
              </div>
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama JDIH</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($DataJDIH as $djdih)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{!! $djdih->nama_peraturan !!}</td>
                                    <td>
                                        <a href="/jdih/{{$djdih->berkas}}" target="_blank" class="btn btn-success btn-block btn-sm">Lihat Berkas</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
  </main>
  <!-- Main Layout -->

  <!-- Footer -->
  <footer class="page-footer stylish-color-dark text-center text-md-left mt-4 pt-4">

    <!-- Footer Links -->
    <div class="container">

      <div class="row py-3 d-flex align-items-center">

        <!-- Grid column -->
        <div class="col-md-7 col-lg-8">

          <!-- Copyright -->
          <p class="text-center text-md-left grey-text">
            © <?php echo date("Y") ?> Copyright : <a href="#"> Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sumbawa Barat
            </a>
          </p>
          <!-- Copyright -->

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-5 col-lg-4 ml-lg-0">

          <!-- Social buttons -->
          <div class="social-section text-center text-md-left">
            <ul class="list-unstyled list-inline">
              <li class="list-inline-item mx-0">
                <a class="btn-floating btn-sm rgba-white-slight mr-xl-4">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item mx-0">
                <a class="btn-floating btn-sm rgba-white-slight mr-xl-4">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item mx-0">
                <a class="btn-floating btn-sm rgba-white-slight mr-xl-4">
                  <i class="fab fa-google-plus-g"></i>
                </a>
              </li>
              <li class="list-inline-item mx-0">
                <a class="btn-floating btn-sm rgba-white-slight mr-xl-4">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
          <!-- Social buttons -->

        </div>
        <!-- Grid column -->

      </div>

    </div>

  </footer>
  <!-- Footer -->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  
  <script type="text/javascript" src="{{asset('beranda')}}/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="{{asset('beranda')}}/js/popper.min.js"></script>
  <script type="text/javascript" src="{{asset('beranda')}}/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{asset('beranda')}}/js/mdb.min.js"></script>
  <script type="text/javascript" src="{{asset('beranda')}}/js/addons/datatables.min.js"></script>
  <script type="text/javascript" src="{{asset('beranda')}}/js/addons/datatables-select.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript">
    // Animation
    new WOW().init();

    // MDB Lightbox Init
    $(function () {
      $("#mdb-lightbox-ui").load("{{asset('beranda')}}/mdb-addons/mdb-lightbox-ui.html");
    });

  </script>
  <script src="{{asset('adminlte')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>

</body>

</html>

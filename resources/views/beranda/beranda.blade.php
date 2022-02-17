
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

    </nav>
    <!-- Navbar -->

  </header>
  <!-- Navigation -->

  <!-- Main Layout -->
  <main>

    <!-- Carousel Wrapper -->
    <div id="carousel-example-1z" class="carousel slide carousel-fade carousel-multi-item" data-ride="carousel">
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
                  <div class="full-bg-img flex-center white-text ">
                    <ul class="animated fadeIn col-10 list-unstyled">
                      <li>
                        <h1 class="h1-responsive font-weight-medium">
                          {{$slide->judul}}
                        </h1>
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
    <div class="container mt-2 pt-2">

      <!-- Excerpt -->
      
      <h3 class="text-center font-weight-bold dark-grey-text py-3">
        <marquee>Selamat Datang di Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sumbawa Barat</marquee>
      </h3>
      <hr>
      <!-- Grid row -->
      <div class="text-center mb-0">
        <div class="text-center">
          <img src="{{asset('logo_salam_dukcapil')}}/salam-dukcapil.png" width="200px" height="200px" class="img-fluid"
            alt="First sample image">
        </div>
        <h3>Produk Layanan</h3>
        <hr>  
      </div>
      <div class="row text-center mb-2">

        @foreach($DataProdukLayanan as $dpl)
        <div class="col-lg-4 col-md-12 mb-4">
          <!-- Featured image -->
          <div class="view overlay z-depth-1 mb-2">
            <img src="{{asset('foto_produk_layanan')}}/{{$dpl->foto}}" width="751px" height="521px" class="img-fluid"
              alt="First sample image">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>

          <h4 class="mb-2 mt-4 font-weight-bold">{{$dpl->nama_produk_layanan}}</h4>
          <p class="dark-grey-text">Anda ingin tahu tata cara pengurusan {{$dpl->nama_produk_layanan}} ? Klik tombol di bawah ini untuk informasi selengkapnya</p>
          <a class="text-uppercase font-small font-weight-bold spacing" onclick="lihatDetailProdukLayanan({{$dpl->id}})">Klik Disini</a>
          <hr class="mt-1" style="max-width: 90px">
          
        </div>
          
        @endforeach
        <!-- Central Modal Large Info -->
        <div class="modal fade" id="centralModalLGInfoDemo1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-notify modal-success" role="document">
          <!-- Content -->
          <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
              <p class="heading lead">Produk Layanan</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
              </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
              <input type="hidden" id="id2">
              <div class="text-center">
                <h4 class="text-center font-weight-bold dark-grey-text py-3" id="nama_produk_layanan2"></h4>
              </div>
              <h5>Dasar Hukum</h5>
              <p id="dasar_hukum2" class="text-justify">
              </p>
              &nbsp;
              <h5>Persyaratan</h5>
              <p id="persyaratan2" class="text-justify">
              </p>
              &nbsp;
              <h5>Prosedur/Mekanisme</h5>
              <p id="prosedur_mekanisme2" class="text-justify">
              </p>
              &nbsp;
              <h5>Waktu Penyelesaian</h5>
              <p id="waktu_penyelesaian2" class="text-justify">
              </p>
              &nbsp;
              <h5>Biaya Tarif</h5>
              <p id="biaya_tarif2" class="text-justify">
              </p>
              &nbsp;
            </div>

            <!-- Footer -->
            <div class="modal-footer">
              <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Tutup</a>
            </div>
            <script>
              function lihatDetailProdukLayanan(id)
              {
                  $.get('/produklayanans3/'+id,function(produklayanan){
                      $("#id2").val(produklayanan.id);
                      $("#nama_produk_layanan2").text(produklayanan.nama_produk_layanan);
                      $("#dasar_hukum2").html(produklayanan.dasar_hukum);
                      $("#persyaratan2").html(produklayanan.persyaratan);
                      $("#prosedur_mekanisme2").html(produklayanan.prosedur_mekanisme);
                      $("#waktu_penyelesaian2").html(produklayanan.waktu_penyelesaian);
                      $("#biaya_tarif2").html(produklayanan.biaya_tarif);
                      $("#centralModalLGInfoDemo1").modal('toggle');
                  });
              }
          </script>
          </div>
          <!-- Content -->
        </div>

      </div>
      <!-- Grid row -->


      <!-- Blog -->
      <div class="row mt-2 pt-2">

        <!-- Main listing -->
        <div class="col-lg-9 col-12 mt-1">

          <!-- Section: Blog v.3 -->
          <section class="pb-3 text-center text-lg-left">
            <div align="center">
              <h3>Kolom Berita</h3>
              <hr>  
            </div>
            @foreach($DataBerita as $db)

            <!-- Grid row -->
            <div class="row">

              <!-- Grid column -->
              <div class="col-lg-5 mb-4">
                <!-- Featured image -->
                <div class="view overlay z-depth-1">
                  <img src="{{asset('foto_berita')}}/{{$db->foto}}" class="img-fluid"
                    alt="First sample image">
                  <a>
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-lg-6 ml-xl-4 mb-4">
                <!-- Grid row -->
                <div class="row">

                  <!-- Grid column -->
                  <div class="col-xl-2 col-md-6 text-sm-center text-md-right text-lg-left">
                    <p class="orange-text font-small font-weight-bold mb-1 spacing">
                      <a>
                        <strong>BERITA</strong>
                      </a>
                    </p>
                  </div>
                  <!-- Grid column -->

                  <!-- Grid column -->
                  <div class="col-xl-5 col-md-6 text-sm-center text-md-left">
                    <p class="font-small grey-text">
                      <em> {{$db->tanggal_berita}}</em>
                    </p>
                  </div>
                  <!-- Grid column -->

                </div>
                <!-- Grid row -->

                <h4 class="mb-3 dark-grey-text mt-0">
                  <strong>
                    <a>{{$db->judul}}</a>
                  </strong>
                </h4>
                <p class="dark-grey-text">
                  @php echo substr($db->isi_berita, 0, 100) @endphp ...
                </p>

                <!-- Deep-orange -->
                <a href="javascript:void(0)" onclick="lihatDetailBerita({{$db->id}})" class="btn btn-deep-orange btn-rounded btn-sm">Lebih Lanjut</a>
                <!-- Central Modal Large Info -->
                <div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
                  <!-- Content -->
                  <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header">
                      <p class="heading lead">Berita Salam Dukcapil</p>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                      </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body">
                      <div class="text-center">
                        <h4 id="judul4"></h4>
                      </div>
                      <p id="isi_berita4" class="text-justify">
                      </p>
                      <img id="foto4" width="100%">
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                      <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Tutup</a>
                    </div>
                    <script>
                      function lihatDetailBerita(id)
                      {
                          $.get('/beritas3/'+id,function(berita){
                              $("#id4").val(berita.id);
                              $("#judul4").text(berita.judul);
                              $("#isi_berita4").html(berita.isi_berita);
                              $("#foto4").attr('src',"foto_berita/"+berita.foto);
                              $("#centralModalLGInfoDemo").modal('toggle');
                          });
                      }
                  </script>
                  </div>
                  <!-- Content -->
                </div>
              </div>
              <!-- Central Modal Large Info -->
              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->

            <hr class="mb-5">

            @endforeach

          </section>
          <div class="row text-center">

          </div>

          

        </div>
        <!-- Main listing -->

        <!-- Sidebar -->
        <div class="col-lg-3 col-12 px-4 mt-1 blue-grey lighten-5">

          <!-- Author -->
          <section class="mb-4">

            <hr class="mt-4">
            <p class="font-weight-bold dark-grey-text text-center spacing">
              <strong>Sambutan Kepala Dinas</strong>
            </p>
            <hr>
            @foreach($DataSambutan as $ds)
              <!-- Avatar -->
              <div class="flex-center mt-4">
                <img src="{{asset('foto_sambutan_dinas')}}/{{$ds->foto}}" class="img-fluid img-author">
              </div>

              <!-- Description -->
              <p class="mt-3 dark-grey-text font-small text-center">
                <em>{{$ds->isi_sambutan}}</em>
              </p>
            @endforeach

          </section>
          <!-- Author -->
          <hr>
          <p class="font-weight-bold dark-grey-text text-center spacing">
            <strong>Video</strong>
          </p>
          <hr>
          @foreach($DataVideo as $dv)
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="{{$dv->link}}" frameborder="0" allowfullscreen></iframe>
            </div>
          @endforeach
        </div>
        <!-- Sidebar -->

      </div>
      
      
      <!-- Inovasi -->
      <div class="text-center mb-2">
        <h3></h3>
      </div>
      <div class="row text-center mt-3 mb-2">
        @foreach($DataInovasi as $di)
        <div class="col-lg-6 col-md-12 mb-4">
          <div class="card text-left">
            <div class="view overlay">
              <img src="{{asset('foto_inovasi')}}/{{$di->foto}}" class="card-img-top" alt="">
              <a>
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>
            <div class="card-body mx-4">
              <h4 class="card-title">
                <strong>INOVASI {{$di->nama_inovasi}}</strong>
              </h4>
              <hr>
              <p class="dark-grey-text mb-4">@php echo substr($di->deskripsi, 0, 200) @endphp ...</p>
              <p class="text-right mb-0 text-uppercase font-small spacing font-weight-bold">
                <a onclick="lihatDetailInovasi({{$di->id}})">Info Lengkap
                  <i class="fas fa-chevron-right" aria-hidden="true"></i>
                </a>
              </p>
            </div>
          </div>
          
        </div>
          
        @endforeach
        <!-- Central Modal Large Info -->
        <div class="modal fade" id="centralModalLGInfoDemo2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
          <!-- Content -->
          <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
              <p class="heading lead">Inovasi</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
              </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
              <input type="hidden" id="id3">
              <div class="text-center">
                <h4 class="text-center font-weight-bold dark-grey-text py-3" id="nama_inovasi1"></h4>
              </div>
              <p id="deskripsi1" class="text-justify">
              </p>
              &nbsp;
            </div>

            <!-- Footer -->
            <div class="modal-footer">
              <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Tutup</a>
            </div>
            <script>
              function lihatDetailInovasi(id)
              {
                  $.get('/inovasis1/'+id,function(inovasi){
                      $("#id3").val(inovasi.id);
                      $("#nama_inovasi1").text(inovasi.nama_inovasi);
                      $("#deskripsi1").html(inovasi.deskripsi);
                      $("#centralModalLGInfoDemo2").modal('toggle');
                  });
              }
          </script>
          </div>
          <!-- Content -->
        </div>

      </div><!-- Blog -->

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

</body>

</html>

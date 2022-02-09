<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dinas Kependudukan dan Pencatatan Sipil</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/summernote/summernote-bs4.min.css">
</head>
@yield('content')
    <!-- Make sure you put this AFTER Leaflet's CSS -->

    <script src="{{asset('adminlte')}}/plugins/jquery/jquery.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="{{asset('adminlte')}}/dist/js/adminlte.js"></script>
    <script src="{{asset('adminlte')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{asset('adminlte')}}/plugins/raphael/raphael.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function () {
          $('#summernote').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#summernote1').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#summernote2').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#summernote3').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#summernote4').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#summernote5').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#isi_aduan1').summernote({
                focus: true,
                width: 800,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#isi_berita1').summernote({
                focus: true,
                width: 800,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#nama_peraturan1').summernote({
                focus: true,
                width: 800,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#deskripsi1').summernote({
                focus: true,
                width: 800,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#dasar_hukum1').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#persyaratan1').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#prosedur_mekanisme1').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
    <script>
        $(function () {
          $('#waktu_penyelesaian1').summernote({
                focus: true,
                height: 250,
            });
        });
    </script>
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
    <script>
        $(function (){
            $('.select2').select2()
        })
    </script>
</body>
</html>

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
@yield('content')
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
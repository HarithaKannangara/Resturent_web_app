<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cook</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('user/asset/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/asset/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/asset/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('user/asset/css/style.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <video autoplay loop muted playsinline class="video-background">
            <source src="{{ asset('user/asset/images/logo.mp4') }}" type="video/mp4">
        </video>
    </div> --}}

    <!-- Navbar -->
    @yield('navbar', view('user.componets.nav'))
    <!-- /.navbar -->

    @yield('content')

    <!-- /.content-wrapper -->
    @yield('footer', view('user.componets.footer'))

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('user/asset/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('user/asset/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('user/asset/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('user/asset/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('user/asset/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('user/asset/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('user/asset/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('user/asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('user/asset/js/main.js') }}"></script>
</body>
</html>

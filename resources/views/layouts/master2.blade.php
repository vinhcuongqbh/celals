<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Googlebot-News" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="robots" content="noindex, nofollow">
    <meta name="robots" content="noimageindex">
    <title>CELALS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href={{ asset('dist/css/asabo.css') }}>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="/img/logo2.png" alt="Celals">
                    <span class="brand-text font-weight-light"></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">                       
                        <li class="nav-item">
                            <label><a href="/gioi-thieu" class="nav-link text-nowrap" style="color:#03396c ">GIỚI
                                    THIỆU</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/diem-khac-biet" class="nav-link text-nowrap" style="color:#03396c ">ĐIỂM
                                    KHÁC
                                    BIỆT</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/khoa-hoc" class="nav-link text-nowrap" style="color:#03396c ">KHÓA
                                    HỌC</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/dang-ky-hoc-thu" class="nav-link text-nowrap" style="color:#03396c ">ĐĂNG KÝ
                                    HỌC THỬ</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/co-so-dao-tao" class="nav-link text-nowrap" style="color:#03396c ">CƠ SỞ ĐÀO
                                    TẠO</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/du-hoc" class="nav-link text-nowrap" style="color:#03396c ">DU
                                    HỌC</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/tin-tuc" class="nav-link text-nowrap" style="color:#03396c ">TIN TỨC & SỰ
                                    KIỆN</a></label>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">{{ __('language') }}</a>
                            <div class="dropdown-menu dropdown-menu-sm-left dropdown-menu-right">
                                <a href="/language/en" class="dropdown-item text-center">{{ __('english') }}</a>
                                <a href="/language/jp" class="dropdown-item text-center">{{ __('japanese') }}</a>
                            </div>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                            href="#">Đăng nhập</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="row">
                <div class="col-12 col-sm-4" style="margin-bottom:30px">
                    <b style="color:#d30404">TRỤ SỞ CHÍNH</b><br>
                    Số 35 Ngô Quyền, P. Đồng Phú, Đồng Hới, Quảng Bình.<br>
                    <br>
                    <b>CHI NHÁNH BỐ TRẠCH</b><br>
                    Số 04 Lê Đại Hành, Tiểu khu 3, TT. Hoàn Lão, Quảng Bình.<br>
                    <br>
                    <b>Hotline:</b> 0888108855 / 0918920106
                </div>
                <div class="col-12 col-sm-4" style="margin-bottom:30px">
                    <b style="color:#d30404">KHÓA HỌC</b><br>
                    <a href="/khoa-hoc">Chương trình Beginner</a><br>
                    <a href="/khoa-hoc">Chương trình IELTS 9.0</a><br>
                    <a href="/khoa-hoc">Chương trình cấp tốc 3 tháng</a><br>
                    <a href="/khoa-hoc">Chương trình Summer Camp</a>
                </div>
                <div class="col-12 col-sm-4">
                    <b style="color:#d30404">THEO DÕI CHÚNG TÔI</b><br>
                    <a href="https://www.facebook.com/celals.cshv" target="_blank"><img src="/img/fb_logo.png" alt="" style="width:8%"></a><br>                    
                </div>
            </div>
            {{-- <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved. --}}
        </footer>
    </div>
    <!-- ./wrapper -->





    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>

    @yield('css')
    @yield('js')
</body>

</html>

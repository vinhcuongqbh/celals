<!DOCTYPE html>
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
    <!-- SweetAlert2 -->
    <script src="/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href={{ asset('dist/css/asabo.css') }}>

    <script src="/js/jquery-3.7.0.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.buttons.min.js"></script>
    <script src="/js/jszip.min.js"></script>
    <script src="/js/pdfmake.min.js"></script>
    <script src="/js/vfs_fonts.js"></script>
    <script src="/js/buttons.html5.min.js"></script>
    <script src="/js/buttons.print.min.js"></script>
    <script src="/js/dataTables.rowReorder.min.js"></script>
    <script src="/js/dataTables.responsive.min.js"></script>

    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="/css/responsive.dataTables.min.css">

</head>

<body class="sidebar-mini layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        {{ csrf_field() }}
                        <input class="btn btn-danger btn-sm" type="submit" value="{{ __('Log Out') }}">
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-light-teal">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="/img/logo.jpg" alt="Logo" class="brand-image img-size-64">
                <a class="brand-text font-weight-light"
                    href="{{ route('user.show', Auth::user()->user_id) }}">{{ Auth::user()->name }}</a>
            </div>

            <!-- Sidebar -->
            <div class="sidebar os-theme-light">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/admin" class="nav-link">
                                <i class="nav-icon fa-solid fa-gauge-high"></i>
                                <p>{{ __('dash_board') }}</p>
                            </a>
                        </li>
                        @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 2 or Auth::user()->role_id == 3)
                            <li class="nav-header">QUẢN TRỊ HỆ THỐNG</li>
                            @if (Auth::user()->role_id == 1)
                                <li class="nav-item">
                                    <a href="/admin/user" class="nav-link">
                                        <i class="nav-icon fa-solid fa-user"></i>
                                        <p>{{ __('user_management') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/post" class="nav-link">
                                        <i class="nav-icon fas fa-newspaper"></i>
                                        <p>{{ __('post_management') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-warehouse"></i>
                                        <p>{{ __('listening') }}</p>
                                        <i class="fas fa-angle-left right"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/admin/class/listening/lesson_list" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('lesson-list') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/admin/class/listening/test_list" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('test-list') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/admin/class/listening/block_list" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('block-list') }}</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 2 or Auth::user()->role_id == 3)
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-warehouse"></i>
                                        <p>{{ __('referral_management') }}</p>
                                        <i class="fas fa-angle-left right"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/admin/referral/customer" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('customer') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/admin/referral/referrer" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('referrer') }}</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endif
                        @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 6)
                            <li class="nav-header">QUẢN LÝ LỚP HỌC</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>{{ __('vocabulary') }}</p>
                                    <i class="fas fa-angle-left right"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/class/vocabulary/test_create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('test-create') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/class/vocabulary/test_list" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('test_list') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>{{ __('listening') }}</p>
                                    <i class="fas fa-angle-left right"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/class/listening/teacher_test_list" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('test_list') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/class/listening/student_list" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('change_block') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 4 or Auth::user()->role_id == 1)
                            <li class="nav-header">GIÁO VIÊN</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>{{ __('listening') }}</p>
                                    <i class="fas fa-angle-left right"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/class/listening/teacher_test_list" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('test_list') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 5 or Auth::user()->role_id == 1)
                            <li class="nav-header">HỌC VIÊN</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>{{ __('listening') }}</p>
                                    <i class="fas fa-angle-left right"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/class/listening/student_block_show" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('self_studing_list') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/class/listening/student_history_study" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('history_study') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('heading')</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                @if (session()->has('msg_success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            text: `{{ session()->get('msg_success') }}`,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    </script>
                @elseif (session()->has('msg_error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            text: `{{ session()->get('msg_error') }}`,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    </script>
                @endif
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/2bc23cb792.js" crossorigin="anonymous"></script>

    @yield('css')
    @yield('js')
</body>

</html>

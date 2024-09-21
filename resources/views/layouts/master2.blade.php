<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CELALS</title>
    <link rel="icon" href="img/book-icon.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- SweetAlert2 -->
    <script src="/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href={{ asset('dist/css/asabo.css') }}>


    <!-- Bootstrap JS và Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    @yield('head')
</head>

<body class="hold-transition layout-top-nav">
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
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="/img/logo.png" alt="Celals" style="width: 250px">
                    <span class="brand-text font-weight-light"></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse"">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
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
                            <label><a href="/dang-ky" class="nav-link text-nowrap" style="color:#03396c ">ĐĂNG
                                    KÝ</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/co-so-dao-tao" class="nav-link text-nowrap" style="color:#03396c ">CƠ
                                    SỞ</a></label>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <label>KIẾN THỨC</label>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="/post_catalogue/tieng_anh">Tiếng Anh</a></li>
                                    <li><a class="dropdown-item" href="/post_catalogue/tieng_han">Tiếng Hàn</a></li>
                                    <li><a class="dropdown-item" href="/post_catalogue/du_hoc">Du học</a></li>
                                    <li><a class="dropdown-item" href="/post_catalogue/khac">Khác</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <label><a href="/su-kien" class="nav-link text-nowrap" style="color:#03396c ">SỰ KIỆN NỔI
                                    BẬT</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/tin-tuc" class="nav-link text-nowrap" style="color:#03396c ">TIN
                                    TỨC</a></label>
                        </li>
                        <li class="nav-item">
                            <label><a href="/gioi-thieu" class="nav-link text-nowrap" style="color:#03396c ">GIỚI
                                    THIỆU</a></label>
                        </li>

                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="btn text-white text-nowrap" style="background-color:#03396c"
                                    href="/admin">{{ Auth::user()->name }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn text-white text-nowrap" style="background-color:#03396c" href="/login"
                                    target="_blank">Đăng
                                    nhập</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if (Auth::check())
                @if (Auth::user()->role_id == 3)
                    <div class="alert m-0 p-2" role="alert"
                        style="border-radius: 0px; color: white; background-color: #03396c; text-align:center">
                        Link Giới thiệu:
                        <label id="referral_link">
                            {{ url()->current() . '/ref=' . Auth::user()->user_id }}
                        </label>
                        <i class="fa-regular fa-copy fa-beat fa-lg" onclick="copyText()"
                            style="margin-left:10px; padding:3px;"></i>
                    </div>
                @endif
            @endif
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="color: #03396c">
            <div class="row" style="text-align:justify">
                <div class="col-12 col-sm-4" style="margin-bottom:20px; padding-left:20px; padding-right:20px">
                    <b style="color:#d30404">Anh ngữ CELALS (Du học Philippines tại Việt Nam)</b><br>
                    <p style="font-style:italic">Chương trình bản quyền từ IELTS Niner, thành lập
                        năm 2007 tại
                        Philippines. Đoạt trên 50 giải thưởng
                        quốc tế, là đơn vị đào tạo IELTS hàng đầu thế giới do Hội đồng Anh (BC) và Tổ chức giáo dục của
                        Úc
                        (IDP) xếp hạng hàng năm. Trên 80% học viên đạt IELTS 7.0 trở lên và hàng nghìn học viên đạt điểm
                        8.0-9.0 trong thời gian học từ 3-6 tháng.</p>
                    <b>Hotline:</b> 090.171.4555
                </div>
                <div class="col-12 col-sm-5" style="margin-bottom:20px; padding-left:20px; padding-right:20px">
                    <b style="color:#d30404">Học viên IELTS có thể học online hoặc trực tiếp tại các cơ sở:</b><br>
                    Cơ sở 1: Nhà C5 Đại học Thủy Lợi Hà Nội.<br>
                    Cơ sở 2: Trường Cao đẳng Long Biên, Sài Đồng, Long Biên, Hà Nội.<br>
                    Cơ sở 3: Trung tâm Ngoại ngữ, Tin học – Trường Đại học Lâm Nghiệp, Hà Nội.<br>
                    Cơ sở 4: Trung tâm giáo dục thường xuyên Ngoại ngữ, Tin học tỉnh Hải Dương.<br>
                    Cơ sở 5: Tân Dân, Việt Trì, Phú Thọ.<br>
                    Cơ sở 6: Số 35 Ngô Quyền, Đồng Hới, Quảng Bình.<br>
                    Cơ sở 7: KP1, Thành phố Biên Hòa, Đồng Nai.<br>
                </div>
                <div class="col-12 col-sm-3" style="margin-bottom:20px; padding-left:20px; padding-right:20px">
                    <b style="color:#d30404">KHÓA HỌC</b><br>
                    <a href="/khoa-hoc">Chương trình Beginner</a><br>
                    <a href="/khoa-hoc">Chương trình IELTS 9.0</a><br>
                    <a href="/khoa-hoc">Chương trình cấp tốc 3 tháng</a><br>
                    <a href="/khoa-hoc">Chương trình Trại hè Tiếng Anh</a><br>
                    <br>
                    <b style="color:#d30404">THEO DÕI CHÚNG TÔI</b><br>
                    <a href="https://www.facebook.com/celals.cshv" target="_blank"><i
                            class="fa-brands fa-square-facebook fa-beat fa-xl" style="color: #03396c;"></i></a><br>
                </div>
            </div>
        </footer>

        <!-- Quick Contact -->
        <div class="quick-contact">
            <ul>
                <li>
                    <a href="tel:0901714555" data-toggle="tooltip" data-placement="left"
                        title="Hotline: 0901.714.555">
                        <img src="/img/call-icon.png" alt="call"><label>Gọi điện</label>
                    </a>
                </li>
                <li>
                    <a href="https://zalo.me/3047264741897118092" target="_blank">
                        <img src="/img/zalo-icon.png" alt="zalo"><label>Zalo</label>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/2bc23cb792.js" crossorigin="anonymous"></script>

    <script>
        function copyText() {
            // Get the text field
            var copyText = document.getElementById("referral_link");

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.innerText).then(() => {
                    Swal.fire({
                        icon: 'success',
                        text: 'Đã Copy Link Giới thiệu',
                        showConfirmButton: false,
                        timer: 3000
                    })

                })
                .catch(() => {
                    alert("Copy bị lỗi");
                });
        }
    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <style>
        body {
            font-size: 16 px;
            font-family: "BuenosAires-Light";
            font-family: 'BuenosAiresVN', sans-serif;
            font-weight: 300;
            color: #474a57;
        }

        i:hover {
            cursor: pointer;
        }

        .quick-contact {
            position: fixed;
            right: 10px;
            bottom: 300px;
            border-radius: 5px;
            width: auto;
            z-index: 150;
            padding: 10px 0;
        }

        .quick-contact ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .quick-contact ul li {
            list-style: none !important;
            padding-bottom: 35px;
        }

        .quick-contact ul li a {
            border: none;
            padding: 3px;
            display: block;
            border-radius: 5px;
            text-align: center;

            line-height: 15px;
            color: #515151;
            font-weight: 700;
            max-width: 70px;
            max-height: 54px;
            text-decoration: none;
        }

        .quick-contact ul li img {
            max-width: 70px;
            max-height: 54px;
        }

        .quick-contact ul li label {
            color: #03396c;
            font-size: 14px;
        }

        @media only screen and (max-width: 768px) {
            .quick-contact {
                position: fixed;
                bottom: 0px;
                border-radius: 5px;
                width: auto;
                z-index: 150;
                padding: 10px 0;
            }

            .quick-contact ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .quick-contact ul li {
                list-style: inline !important;
                padding-bottom: 35px;
                display: inline-block;
            }
        }
    </style>

    @yield('css')
    @yield('js')
</body>

</html>

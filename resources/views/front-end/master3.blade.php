<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
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

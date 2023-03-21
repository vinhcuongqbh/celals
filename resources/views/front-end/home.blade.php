@extends('layouts.master2')

@section('title', 'Store')

@section('content')
    <div class="container-fluid">
        {{-- Slideshow --}}
        <div id="gioi-thieu" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#gioi-thieu" data-slide-to="0" class="active"></li>
                <li data-target="#gioi-thieu" data-slide-to="1"></li>
                <li data-target="#gioi-thieu" data-slide-to="2"></li>
                <li data-target="#gioi-thieu" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/img/slide1.png" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 style="color: #03396c ">TRUNG TÂM ANH NGỮ CELALS - IELTS 9.0</h1>
                        <p style="color: #03396c ">BẢN QUYỀN TỪ IELTS NINER - TOP 1 PHILIPPINES</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/img/slide2.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <a href="/du-hoc"><img class="d-block w-100" src="/img/slide3.png" alt="Third slide"></a>
                    <div class="carousel-caption d-none d-md-block" style="text-align:right">
                        <a class="btn" style="background-color: #03396c; color:white" href="/du-hoc">
                            Tìm hiểu thêm
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/img/slide4.png" alt="Fourth slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#gioi-thieu" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#gioi-thieu" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        {{-- Tự hào --}}
        <div id="tu-hao" class="row" style="padding: 50px 10px; background-color: #03396c; color: white;">
            <div class="col-12 col-sm-3" style="text-align:center">
                <h3>CELALS - IELTS 9.0 <br>TỰ HÀO</h3>
            </div>
            <div class="col-12 col-sm-3" style="text-align:center">
                <img src="/img/tuhao1.png" alt="" style="height: 80px !important; object-fit: cover;">
                <h6>Hơn 50 giải thưởng từ BC, IDP</h6>
            </div>
            <div class="col-12 col-sm-3" style="text-align:center">
                <img src="/img/tuhao2.png" alt="" style="height: 80px !important; object-fit: cover;">
                <h6>Được bình chọn là đơn vị đào tạo IELTS hàng đầu Philippines, cũng như châu Á
                </h6>
            </div>
            <div class="col-12 col-sm-3" style="text-align:center">
                <img src="/img/tuhao3.png" alt="" style="height: 80px !important; object-fit: cover;">
                <h6>Hàng nghìn học viên đạt điểm 6.5+</h6>
            </div>
        </div>

        {{-- Điểm khác biệt --}}
        <div id="diem-khac-biet" class="row" style="padding: 50px 10px; background-color: #ffffff;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                <h3>ĐIỂM KHÁC BIỆT TẠI CELALS - IELTS 9.0</h3>
            </div>
        </div>

        {{-- Các khóa học --}}
        <div id="khoa-hoc" class="row" style="padding: 50px 10px 10px 10px; background-color: #03396c">
            <div class="col-12" style="color:white; text-align:center; padding-bottom: 20px">
                <h3>CÁC KHÓA HỌC TẠI CELALS - IELTS 9.0 (Trực tuyến - Trực tiếp kết nối song song)</h3>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Chương trình Beginner</b>
                    </div>
                    <img class="card-img-top" src="/img/khoahoc1.png" alt="Card image cap"
                        style="width: 100%; height: 200px!important; object-fit: cover;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Đầu ra: Cam kết đầu ra >= 4.0+</li>
                        <li class="list-group-item">Đầu vào: Các bạn chưa có hoặc thiếu kiến thức cơ bản</li>
                        <li class="list-group-item">Thời gian: 03 tháng - 12 tháng</li>
                    </ul>
                    <div class="card-body">
                        <a href="/dang-ky-hoc-thu" class="btn btn-primary" style="background-color: #03396c">Đăng ký</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Chương trình IELTS 9.0</b>
                    </div>
                    <img class="card-img-top" src="/img/khoahoc2.png" alt="Card image cap"
                        style="width: 100%; height: 200px!important; object-fit: cover;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Đầu ra: Cam kết đầu ra >= 6.5+</li>
                        <li class="list-group-item">Đầu vào: Các bạn đã có kiến thức cơ bản, điểm IELTS từ 4.0-9.0</li>
                        <li class="list-group-item">Thời gian: 01 năm</li>
                    </ul>
                    <div class="card-body">
                        <a href="/dang-ky-hoc-thu" class="btn btn-primary" style="background-color: #03396c">Đăng ký</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Chương trình Cấp tốc 3 tháng</b>
                    </div>
                    <img class="card-img-top" src="/img/khoahoc3.png" alt="Card image cap"
                        style="width: 100%; height: 200px!important; object-fit: cover;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Đầu ra: Tăng 1.5 - 3 band điểm</li>
                        <li class="list-group-item">Đầu vào: Đối với các bạn cần luyện thi cấp tốc đã có căn bản</li>
                        <li class="list-group-item">Thời gian: 12 tuần</li>
                    </ul>
                    <div class="card-body">
                        <a href="/dang-ky-hoc-thu" class="btn btn-primary" style="background-color: #03396c">Đăng ký</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Chương trình Summer Camp</b>
                    </div>
                    <img class="card-img-top" src="/img/khoahoc4.png" alt="Card image cap"
                        style="width: 100%; height: 200px!important; object-fit: cover;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Đầu ra: Tăng 1.5 - 3 band điểm</li>
                        <li class="list-group-item">Đầu vào: Học IELTS trong các trại hè đạt chuẩn từ các trường đại học
                        </li>
                        <li class="list-group-item">Thời gian: IELTS 9.0 summer (Tháng 6 - 8)</li>
                    </ul>
                    <div class="card-body">
                        <a href="/dang-ky-hoc-thu" class="btn btn-primary" style="background-color: #03396c">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cảm nghĩ học viên --}}
        <div id="cam-nghi-hoc-vien" class="row" style="padding: 50px 10px; background-color: #ffffff;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                <h3>CÁC HỌC VIÊN NGHĨ GÌ VỀ CHƯƠNG TRÌNH CELALS - ILETS 9.0</h3>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Bạn Vũ Cường Thịnh</b>
                    </div>
                    <img class="card-img-top" src="/img/camnghi1.png" alt="Card image cap"
                        style="width: 100%; object-fit: cover;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Thành tích: Đạt IELTS 8.0 sau 2 tháng</li>
                        <li class="list-group-item">Với bản tính hay ngại và xấu hổ của mình thì mình chỉ muốn học 1
                            thầy
                            và 1 trò thôi…Vì là học ở nhà nên rất tiện, mình có thể học vào những khoảng thời gian mà
                            bạn
                            rảnh. Và vì muốn học cấp tốc nên mình 1 tuần 5 buổi luôn, đây là điều mà khó có trung tâm
                            nào có
                            thể dạy các bạn được</li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Bạn Nguyễn Văn Hiếu</b>
                    </div>
                    <img class="card-img-top" src="/img/camnghi2.png" alt="Card image cap"
                        style="width: 100%; object-fit: cover;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Thành tích: 03 tháng tăng 3 điểm IELTS</li>
                        <li class="list-group-item">Với kết quả này em đủ điều kiện để đi du học và em dự kiến học
                            trong
                            vòng 1 tháng tới. Đến với IELTS 9.0 là chương trình không giới hạn về thời gian học, bạn có
                            thể
                            học từ 8:00 sáng đến 21h tối. Như các trung tâm khác bị giới hạn bới tiết học. Nhưng đến với
                            IELTS 9.0 giờ học không bị giới hạn và bạn có thể sắp xếp thời gian học bất cứ lúc nào thời
                            thời
                            gian biểu của bạn. Đối với em, thì em dành hầu hết thời gian học ở trung tâm bất cứ khi nào
                            em
                            rảnh và em đã đạt kết quả như mong muốn</li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Bạn Trương Việt Tùng</b>
                    </div>
                    <img class="card-img-top" src="/img/camnghi3.png" alt="Card image cap"
                        style="width: 100%; object-fit: cover;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Thành tích: Đạt IELTS 8.0 sau 2.5 tháng</li>
                        <li class="list-group-item">Em đã đi du học Canada sau 2.5 tháng học tại IELTS 9.0. Có lẽ em ấn
                            tượng nhất với mô hình Coaching 1:1, giúp em tăng band điểm rất nhanh</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Hoạt động --}}
        <div id="hoat-dong" class="row d-flex justify-content-center"
            style="padding: 50px 10px; background-color: #03396c;">
            <div class="col-12" style="color:white; text-align:center; padding-bottom: 20px">
                <h3>CÁC HOẠT ĐỘNG TẠI CELALS - IELTS 9.0</h3>
            </div>
            <div id="slide-hoat-dong" class="carousel slide col-12 col-sm-6" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slide-hoat-dong" data-slide-to="0" class="active"></li>
                    <li data-target="#slide-hoat-dong" data-slide-to="1"></li>
                    <li data-target="#slide-hoat-dong" data-slide-to="2"></li>
                    <li data-target="#slide-hoat-dong" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="/img/hoatdong1.png" alt="First slide"
                            style="width:100%; height: 400px;">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: white ">Trại hè Tiếng Anh</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="/img/hoatdong2.png" alt="Second slide"
                            style="width:100%; height: 400px;">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: white ">Trại hè Tiếng Anh</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="/img/hoatdong3.png" alt="Third slide"
                            style="width:100%; height: 400px;">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: white ">Thi thử hàng tuần</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="/img/hoatdong4.png" alt="Fourth slide"
                            style="width:100%; height: 400px;">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: white ">Lịch học hàng ngày</h3>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#slide-hoat-dong" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#slide-hoat-dong" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        {{-- Tin tức --}}
        {{-- <div id="tin-tuc" class="row" style="padding: 50px 10px; background-color: #ffffff;">

        </div> --}}
    </div><!-- /.container-fluid -->
@stop

@section('js')
@stop

@section('css')
@stop

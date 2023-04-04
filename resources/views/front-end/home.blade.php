@extends('layouts.master2')

@section('title', 'Store')

@section('content')
    <div class="container-fluid">        
        {{-- Slideshow --}}
        <div id="gioi-thieu" class="carousel slide" data-ride="carousel" data-interval="3000" style="background-color: white">
            <ol class="carousel-indicators">
                <li data-target="#gioi-thieu" data-slide-to="0" class="active"></li>
                <li data-target="#gioi-thieu" data-slide-to="1"></li>
                <li data-target="#gioi-thieu" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                        <img class="d-block w-100 carousel-img" src="/img/slide2.png" alt="Second slide">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <a href="/du-hoc"><img class="d-block w-100 carousel-img" src="/img/slide3.png"
                                alt="Third slide"></a>
                        <div class="carousel-caption d-none d-md-block" style="text-align:right">
                            <a class="btn" style="background-color: #03396c; color:white" href="/du-hoc">
                                Tìm hiểu thêm
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <img class="d-block w-100 carousel-img" src="/img/slide4.png" alt="Fourth slide">
                    </div>
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
        <div id="diem-khac-biet" class="row"
            style="padding: 50px 10px; background-color: #ffffff; 
            display: flex; align-items: center; justify-content: center;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                <h3>ĐIỂM KHÁC BIỆT TẠI CELALS</h3>
            </div>
            <div id="khac-biet" class="carousel slide col-12 col-sm-10" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#khac-biet" data-slide-to="0" class="active"></li>
                    <li data-target="#khac-biet" data-slide-to="1"></li>
                    <li data-target="#khac-biet" data-slide-to="2"></li>
                    <li data-target="#khac-biet" data-slide-to="3"></li>
                    <li data-target="#khac-biet" data-slide-to="4"></li>
                    <li data-target="#khac-biet" data-slide-to="5"></li>
                    <li data-target="#khac-biet" data-slide-to="6"></li>
                    <li data-target="#khac-biet" data-slide-to="7"></li>
                </ol>
                <div class="carousel-inner" style="width: 100%; border-radius: 5px;">
                    <div class="carousel-item active" style="text-align: center;">
                        <div style="margin:5px; display: flex; align-items: center; justify-content: center;">
                            <h5 class="alert alert-danger col-12 col-sm-6" role="alert" style="margin:5px;">
                                Học không giới hạn - Mô hình du học từ Philippines
                            </h5>
                        </div>
                        <div class="row"
                            style="background-color: #03396c; padding:30px 10px; margin:5px; border-radius: 5px;">
                            <div class="col-12 col-sm-3" style="text-align: center; font-size: 18px; color:white">
                                <p style="text-align: justify;">- Mô hình duy nhất tại Việt Nam có thể: cung cấp giờ học từ
                                    8h-21h mỗi ngày. 10 giờ/ 1
                                    ngày, 50h/1 tuần, 1 tháng học bằng 1 năm thông thường.</p>
                                <p style="text-align: justify;">- Học sinh có thể linh động sắp xếp thời gian học các môn
                                    khác mà không lo phát sinh chi
                                    phí. Không lo bị lỡ bài.</p>
                            </div>
                            <div class="col-12 col-sm-9">
                                <img class="d-block w-100 img-fluid diem-khac-biet" src="/img/diemkhacbiet1.png" alt="1st slide"
                                    style="border-radius: 7px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <div style="margin:5px; display: flex; align-items: center; justify-content: center;">
                            <h5 class="alert alert-danger col-12 col-sm-6" role="alert" style="margin:5px;">
                                Mô hình học độc quyền 3:1
                            </h5>
                        </div>
                        <div class="row"
                            style="background-color: #03396c; padding:30px 10px; margin:5px; border-radius: 5px;">
                            <div class="col-12 col-sm-3" style="text-align: justify; font-size: 16px; color:white">
                                <p>Học đi đôi với hành giúp học viên nhớ từ 75%-95% kiến thức được học.</p>
                                <p>- Lecture- Bài giảng (lý thuyết): Học 4 kỹ năng, ngày 3 ca thứ 3 đến thứ 7,…</p>
                                <p>- Coaching - 01 thầy 01 trò: Nói và viết (thực hành): Học thực hành, sửa trực tiếp và
                                    chữa
                                    lỗi từ giáo viên</p>
                                <p>- Managing - Luyện tập với "Bút đen- Bút đỏ" thuộc bài ngay tại lớp. Nghe chính tả và
                                    cung cấp 30 từ vựng/ 01 ngày.</p>
                            </div>
                            <div class="col-12 col-sm-9">
                                <img class="d-block w-100 img-fluid diem-khac-biet" src="/img/diemkhacbiet2.png" alt="2nd slide"
                                    style="border-radius: 7px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <div style="margin:5px; display: flex; align-items: center; justify-content: center;">
                            <h5 class="alert alert-danger col-12 col-sm-6" role="alert" style="margin:5px;">
                                Chương trình cá nhân hóa - hơn cả học kèm
                            </h5>
                        </div>
                        <div class="row"
                            style="background-color: #03396c; padding:30px 10px; margin:5px; border-radius: 5px;">
                            <div class="col-12 col-sm-3" style="text-align: justify; font-size: 16px; color:white">
                                <p>Chương trình thực hành 1:1 và “bút đen - bút đỏ” giúp cho học viên có thể tăng band
                                    điểm mà không phụ thuộc vào lớp, giáo viên sẽ giúp các bạn tăng theo số điểm mà bạn đang
                                    có. Không phụ thuộc band điểm của các bạn xung quanh như cách truyền thống.</p>
                            </div>
                            <div class="col-12 col-sm-9">
                                <img class="d-block w-100 img-fluid diem-khac-biet" src="/img/diemkhacbiet3.png" alt="3rd slide"
                                    style="border-radius: 7px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <div style="margin:5px; display: flex; align-items: center; justify-content: center;">
                            <h5 class="alert alert-danger col-12 col-sm-6" role="alert" style="margin:5px;">
                                Môi trường 100% nước ngoài
                            </h5>
                        </div>
                        <div class="row"
                            style="background-color: #03396c; padding:30px 10px; margin:5px; border-radius: 5px;">
                            <div class="col-12 col-sm-3" style="text-align: justify; font-size: 16px; color:white">
                                <p>Các học viên sẽ được sống trong môi trường 100% nước ngoài như sinh sống tại đó, từ 8h
                                    -21h mỗi ngày được tiếp xúc hoàn toàn bằng tiếng anh.</p>
                            </div>
                            <div class="col-12 col-sm-9">
                                <img class="d-block w-100 img-fluid diem-khac-biet" src="/img/diemkhacbiet4.png" alt="4th slide"
                                    style="border-radius: 7px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <div style="margin:5px; display: flex; align-items: center; justify-content: center;">
                            <h5 class="alert alert-danger col-12 col-sm-6" role="alert" style="margin:5px;">
                                Giáo viên đạt chuẩn hệ thống IELTS 9.0 </h5>
                        </div>
                        <div class="row"
                            style="background-color: #03396c; padding:30px 10px; margin:5px; border-radius: 5px;">
                            <div class="col-12 col-sm-3" style="text-align: justify; font-size: 16px; color:white">
                                <p>Giáo viên đều phải đào tạo đạt chuẩn từ hệ thống IELTS 9.0, có chứng chỉ giảng dạy quốc
                                    tế và sư phạm, kinh nghiệm giảng dạy IELTS nhiều năm.</p>
                            </div>
                            <div class="col-12 col-sm-9">
                                <img class="d-block w-100 img-fluid diem-khac-biet" src="/img/diemkhacbiet5.png" alt="5th slide"
                                    style="border-radius: 7px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <div style="margin:5px; display: flex; align-items: center; justify-content: center;">
                            <h5 class="alert alert-danger col-12 col-sm-6" role="alert" style="margin:5px;">
                                Quản lý chất lượng KPIS từ Canada
                            </h5>
                        </div>
                        <div class="row"
                            style="background-color: #03396c; padding:30px 10px; margin:5px; border-radius: 5px;">
                            <div class="col-12 col-sm-3" style="text-align: justify; font-size: 16px; color:white">
                                <p>Chấm điểm từng buổi học</p>
                                <p>Thi thử từng tuần học</p>
                                <p>Chấm điểm theo tiêu chuẩn quốc tế IDP, BC giúp học sinh biết ngay điểm trong từng buổi,
                                    từng tuần học</p>
                            </div>
                            <div class="col-12 col-sm-9">
                                <img class="d-block w-100 img-fluid diem-khac-biet" src="/img/diemkhacbiet6.png" alt="6th slide"
                                    style="border-radius: 7px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <div style="margin:5px; display: flex; align-items: center; justify-content: center;">
                            <h5 class="alert alert-danger col-12 col-sm-6" role="alert" style="margin:5px;">
                                Nạp phí 1 lần - Cam kết đầu ra
                            </h5>
                        </div>
                        <div class="row"
                            style="background-color: #03396c; padding:30px 10px; margin:5px; border-radius: 5px;">
                            <div class="col-12 col-sm-3" style="text-align: justify; font-size: 16px; color:white">
                                <p>CELALS - IELTS 9.0 cam kết mạnh mẽ, các em sẽ được học trung bình từ 3-12 tháng để đạt
                                    tối thiểu IELTS 6.5+</p>
                                <p>Các em sẽ được học đến lúc đạt và không phát sinh chi phí.</p>
                            </div>
                            <div class="col-12 col-sm-9">
                                <img class="d-block w-100 img-fluid diem-khac-biet" src="/img/diemkhacbiet7.png" alt="7th slide"
                                    style="border-radius: 7px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <div style="margin:5px; display: flex; align-items: center; justify-content: center;">
                            <h5 class="alert alert-danger col-12 col-sm-6" role="alert" style="margin:5px;">
                                Học trực tuyến cam kết như học tại trung tâm
                            </h5>
                        </div>
                        <div class="row"
                            style="background-color: #03396c; padding:30px 10px; margin:5px; border-radius: 5px;">
                            <div class="col-12 col-sm-3" style="text-align: justify; font-size: 16px; color:white">
                                <p>Chương trình học trực tuyến cũng đảm bảo mọi hoạt động tương tự như trực tiếp tại trung
                                    tâm, các học sinh vẫn đảm bảo 3 mô hình học : lý thuyết, thực hành, bút đen-bút đỏ.</p>
                                <p>Học viên được học 10h / 1 ngày tương tự như trực tiếp và được cam kết đầu ra tương tự như
                                    nhau.</p>
                            </div>
                            <div class="col-12 col-sm-9">
                                <img class="d-block w-100 img-fluid diem-khac-biet" src="/img/diemkhacbiet8.png" alt="8th slide"
                                    style="border-radius: 7px;">
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#khac-biet" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#khac-biet" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


        {{-- Các khóa học --}}
        <div id="khoa-hoc" class="row" style="padding: 50px 10px 10px 10px; background-color: #03396c">
            <div class="col-12" style="color:white; text-align:center; padding-bottom: 20px">
                <h3>CÁC KHÓA HỌC TẠI CELALS (Trực tuyến - Trực tiếp kết nối song song)</h3>
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
                        <a href="/dang-ky" class="btn btn-primary" style="background-color: #03396c">Đăng ký</a>
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
                        <a href="/dang-ky" class="btn btn-primary" style="background-color: #03396c">Đăng ký</a>
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
                        <a href="/dang-ky" class="btn btn-primary" style="background-color: #03396c">Đăng ký</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Chương trình Trại hè Tiếng Anh</b>
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
                        <a href="/dang-ky" class="btn btn-primary" style="background-color: #03396c">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cảm nghĩ học viên --}}
        <div id="cam-nghi-hoc-vien" class="row"
            style="padding: 50px 10px; background-color: #ffffff; display: flex; justify-content: center;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px;">
                <h3>CÁC HỌC VIÊN NGHĨ GÌ VỀ CHƯƠNG TRÌNH CELALS</h3>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Bạn Vũ Cường Thịnh</b>
                        <br>
                        <b>Thành tích: Đạt IELTS 8.0 sau 2 tháng</b>
                    </div>
                    <img class="card-img-top" src="/img/camnghi1.png" alt="Card image cap"
                        style="width: 100%; object-fit: cover;">
                    <a data-toggle="collapse" href="#camnghi1" role="button" aria-expanded="false"
                        aria-controls="camnghi1">
                        <li class="list-group-item">Cảm nghĩ của học viên</li>
                    </a>
                    <div class="collapse" id="camnghi1">
                        <div class="card-body" style="text-align: justify;">
                            Với bản tính hay ngại và xấu hổ của mình thì mình chỉ muốn học 1 thầy và 1 trò thôi…Vì là học ở
                            nhà nên rất tiện, mình có thể học vào những khoảng thời gian mà bạn rảnh. Và vì muốn học cấp tốc
                            nên mình 1 tuần 5 buổi luôn, đây là điều mà khó có trung tâm nào có thể dạy các bạn được
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Bạn Nguyễn Văn Hiếu</b>
                        <br>
                        <b>Thành tích: 03 tháng tăng 3 điểm IELTS</b>
                    </div>
                    <img class="card-img-top" src="/img/camnghi2.png" alt="Card image cap"
                        style="width: 100%; object-fit: cover;">
                    <a data-toggle="collapse" href="#camnghi2" role="button" aria-expanded="false"
                        aria-controls="camnghi2">
                        <li class="list-group-item">Cảm nghĩ của học viên</li>
                    </a>
                    <div class="collapse" id="camnghi2">
                        <div class="card-body" style="text-align: justify;">
                            Với kết quả này em đủ điều kiện để đi du học và em dự kiến học trong vòng 1 tháng tới. Đến với
                            IELTS 9.0 là chương trình không giới hạn về thời gian học, bạn có thể học từ 8:00 sáng đến 21h
                            tối. Như các trung tâm khác bị giới hạn bới tiết học. Nhưng đến với IELTS 9.0 giờ học không bị
                            giới hạn và bạn có thể sắp xếp thời gian học bất cứ lúc nào thời gian biểu của bạn. Đối với em,
                            thì em dành hầu hết thời gian học ở trung tâm bất cứ khi nào em rảnh và em đã đạt kết quả như
                            mong muốn.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <b style="color: #03396c">Bạn Trương Việt Tùng</b>
                        <br>
                        <b>Thành tích: Đạt IELTS 8.0 sau 2.5 tháng</b>
                    </div>
                    <img class="card-img-top" src="/img/camnghi3.png" alt="Card image cap"
                        style="width: 100%; object-fit: cover;">
                    <a data-toggle="collapse" href="#camnghi3" role="button" aria-expanded="false"
                        aria-controls="camnghi3">
                        <li class="list-group-item">Cảm nghĩ của học viên</li>
                    </a>
                    <div class="collapse" id="camnghi3">
                        <div class="card-body" style="text-align: justify;">
                            Em đã đi du học Canada sau 2.5 tháng học tại IELTS 9.0. Có lẽ em ấn
                            tượng nhất với mô hình Coaching 1:1, giúp em tăng band điểm rất nhanh
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hoạt động --}}
        <div id="hoat-dong" class="row d-flex justify-content-center"
            style="padding: 50px 10px; background-color: #03396c;">
            <div class="col-12" style="color:white; text-align:center; padding-bottom: 20px">
                <h3>CÁC HOẠT ĐỘNG TẠI CELALS</h3>
            </div>
            <div id="slide-hoat-dong" class="carousel slide col-12 col-sm-8" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slide-hoat-dong" data-slide-to="0" class="active"></li>
                    <li data-target="#slide-hoat-dong" data-slide-to="1"></li>
                    <li data-target="#slide-hoat-dong" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" style="width: 100%; border-radius: 15px;">
                    <div class="carousel-item active" style="text-align: center;">
                        <h5 style="color:white;">Trại hè tiếng anh</h5>
                        <img class="d-block w-100" src="/img/hoatdong1.png" alt="First slide"
                            style="border-radius: 7px; border: 2px solid white">
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <h5 style="color:white;">Trại hè tiếng anh</h5>
                        <img class="d-block w-100" src="/img/hoatdong2.png" alt="First slide"
                            style="border-radius: 7px; border: 2px solid white">
                    </div>
                    <div class="carousel-item" style="text-align: center;">
                        <h5 style="color:white;">Thi thử hàng tuần</h5>
                        <img class="d-block w-100" src="/img/hoatdong3.png" alt="First slide"
                            style="border-radius: 7px; border: 2px solid white">
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

@section('css')
    <style>
        .card-img-top {
            width: 100%;
            height: 250px;
        }

        .diem-khac-biet {
            width: 100%;
            height: 500px;
        }

        @media only screen and (min-width: 992px) {
            .carousel-img {
                width: 1000px !important;
                height: 450px;
            }
        }

        @media only screen and (max-width: 768px) {
            .carousel-img {
                width: 100%;
                height: 200px;
            }

            .diem-khac-biet {
            width: 100%;
            height: 250px;
        }
        }
    </style>
@stop

@section('js')
@stop

@extends('layouts.master2')

@section('title', 'CELALS')

@section('content')
    <div class="container-fluid">
        {{-- Điểm khác biệt --}}
        <div id="diem-khac-biet" class="row"
            style="padding: 50px 10px; background-color: #ffffff; 
            display: flex; align-items: center; justify-content: center;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                <h3>ĐIỂM KHÁC BIỆT TẠI CELALS - IELTS 9.0</h3>
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
                                <img class="d-block w-100" src="/img/diemkhacbiet1.png" alt="First slide"
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
                                <img class="d-block w-100" src="/img/diemkhacbiet2.png" alt="First slide"
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
                                <img class="d-block w-100" src="/img/diemkhacbiet3.png" alt="First slide"
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
                                <img class="d-block w-100" src="/img/diemkhacbiet4.png" alt="First slide"
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
                                <img class="d-block w-100" src="/img/diemkhacbiet5.png" alt="First slide"
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
                                <img class="d-block w-100" src="/img/diemkhacbiet6.png" alt="First slide"
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
                                <img class="d-block w-100" src="/img/diemkhacbiet7.png" alt="First slide"
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
                                <img class="d-block w-100" src="/img/diemkhacbiet8.png" alt="First slide"
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
    </div><!-- /.container-fluid -->
@stop

@section('js')
@stop

@section('css')
@stop

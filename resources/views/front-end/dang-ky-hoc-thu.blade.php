@extends('layouts.master2')

@section('title', 'CELALS')

@section('heading')
    {{ __('CHÀO MỪNG BẠN ĐẾN VỚI TRUNG TÂM CELALS') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="asabo-main-body">
            <div class="asabo-box">
                <div class="row">
                    <div class="col-md-12 w-100">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 style="color:#03396c">ĐĂNG KÝ HỌC THỬ</h3>
                            </div>
                            <!-- form start -->
                            <form action="{{ route('referral.register') }}" method="post" id="form-validate">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control" id="parent_name"
                                            name="parent_name" placeholder="Họ tên phụ huynh">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control" id="tel"
                                            name="tel" placeholder="Số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control" id="email"
                                            name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control" id="child_age"
                                            name="child_age" placeholder="Độ tuổi của bé">
                                    </div>
                                    <div class="form-group">
                                        <select id="center_id" name="center_id" class="form-control custom-select">
                                            <option selected value="0">Đăng ký học thử và kiểm tra trình độ miễn phí tại Trung tâm
                                            </option>
                                            @foreach ($centers as $center)
                                                <option value="{{ $center->center_id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-lg text-white w-100"
                                                style="position: relative; float: right; background-color: #03396c">Đăng ký</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div><!-- /.container-fluid -->
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#form-validate').validate({
                rules: {
                    parent_name: {
                        required: true,
                    },
                    tel: {
                        required: true,
                    },
                },
                messages: {
                    parent_name: {
                        required: "Vui lòng nhập thông tin",
                    },
                    tel: {
                        required: "Vui lòng nhập thông tin",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);

                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@stop

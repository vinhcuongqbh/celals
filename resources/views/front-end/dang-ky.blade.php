@extends('layouts.master2')

@section('title', 'CELALS')

@section('heading')
    {{ __('CHÀO MỪNG BẠN ĐẾN VỚI TRUNG TÂM CELALS') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row" style="padding: 50px 10px; display: flex; align-items: center; justify-content: center;">
            <div class="col-12 col-sm-4">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 style="color:#03396c">ĐĂNG KÝ TƯ VẤN</h3>
                    </div>
                    @if (session()->has('message'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                text: `{{ session()->get('message') }}`,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        </script>
                    @endif

                    <!-- form start -->
                    <form action="{{ route('referral.register') }}" method="post" id="form-validate">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <select id="advise_type_id" name="advise_type_id" class="form-control custom-select">
                                    <option selected value="0">
                                        Đăng ký học thử & Thi thử miễn phí
                                    </option>
                                    <option value="1">
                                        Tư vấn du học
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control" id="student_name"
                                    name="student_name" placeholder="Họ và tên">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control" id="student_tel" name="student_tel"
                                    placeholder="Số điện thoại">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control" id="student_email"
                                    name="student_email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control" id="student_age" name="student_age"
                                    placeholder="Độ tuổi">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control" id="student_school"
                                    name="student_school" placeholder="Trường đang theo học">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg text-white w-100"
                                        style="position: relative; float: right; background-color: #03396c">Đăng
                                        ký</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    student_name: {
                        required: true,
                    },
                    student_tel: {
                        required: true,
                    },
                },
                messages: {
                    student_name: {
                        required: "Vui lòng nhập thông tin",
                    },
                    student_tel: {
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

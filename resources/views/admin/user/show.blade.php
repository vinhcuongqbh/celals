@extends('layouts.master')

@section('title', 'User Information')

@section('heading')
    {{ __('user_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('user_information') }}</h3>
                    </div>
                    <div class="card-body">                       
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="name">{{ __('name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" value="{{ $user->name }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="user_name">{{ __('user_name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="address">{{ __('address') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="address" name="address" value="{{ $user->address }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="tel">{{ __('tel') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="tel" name="tel" value="{{ $user->tel }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="email">{{ __('email') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="email" name="email" value="{{ $user->email }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="center_name">{{ __('center_name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="center_name" name="center_name" value="{{ $user->center_name }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="role_name">{{ __('role_name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="role_name" name="role_name" value="{{ $user->role_name }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-warning w-100 text-nowrap m-1" href="{{ route('user.edit', $user->user_id) }}">{{ __('edit') }}</a>
                        <a class="btn bg-olive text-white w-100 text-nowrap m-1" href="{{ route('user') }}">{{ __('back') }}</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->    
@stop

@section('css')
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <script>
        //Kiểm tra dữ liệu đầu vào
        $(function() {
            $('#form-resetpass').validate({
                rules: {
                    confirmPassword: {
                        equalTo: "#password"
                    }
                },
                messages: {                    
                    confirmPassword: "{{ __('samePassword') }}",
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('div').append(error);

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

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
                                <label for="referral_link">{{ __('referral_link') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="text" id="referral_link" name="referral_link"
                                        value="http://vinhcuong2023.xyz/ref={{ $user->user_id }}" class="form-control"
                                        disabled>
                                    <div class="input-group-append">
                                        <a onclick="copyText()" class="btn btn-info"><i class="fas fa-copy"></i> Copy</a>
                                    </div>
                                </div>
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
                                <label for="name">{{ __('name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" value="{{ $user->name }}"
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
                        <button type="button" class="btn btn-danger text-white w-100 text-nowrap m-1" data-toggle="modal"
                            data-target="#reset-pass">{{ __('changePassword') }}</button>
                        <a class="btn btn-warning w-100 text-nowrap m-1"
                            href="{{ route('user.edit', $user->user_id) }}">{{ __('edit') }}</a>
                            
                        <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                            href="{{ route('user') }}">{{ __('back') }}</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    {{-- Cấp lại mật mã --}}
    <form action="{{ route('user.resetpass', $user->user_id) }}" method="post" id="form-resetpass">
        @csrf
        <div class="modal fade" id="reset-pass">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('changePassword') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="password" class="col-form-label">{{ __('newPassword') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="confirmPassword" class="col-form-label">{{ __('confirmPassword') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->user_id }}">
                    </div>
                    <div class="modal-footer">                       
                        <button type="submit" class="btn bg-olive text-white text-nowrap">{{ __('update') }}</button>
                        <button type="button" class="btn bg-olive text-white text-nowrap"
                        data-dismiss="modal">{{ __('back') }}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>
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

    <script>
        function copyText() {
            // Get the text field
            var copyText = document.getElementById("referral_link");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Đã copy link giới thiệu: " + copyText.value);
        }
    </script>
@stop

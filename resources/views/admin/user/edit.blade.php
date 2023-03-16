@extends('layouts.master')

@section('title', 'User Edit')

@section('heading')
    {{ __('user_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('user_informantion') }}</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.update', $user->user_id) }}" method="post" id="form-validate">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="name">{{ __('name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                        class="form-control">
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
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="tel">{{ __('tel') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="tel" name="tel" value="{{ $user->tel }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="tel">{{ __('email') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="email" name="email" value="{{ $user->email }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="center_id">{{ __('center_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="center_id" name="center_id" class="form-control custom-select">
                                        <option value=""></option>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->center_id }}"
                                                @if ($center->center_id == $user->center_id) {{ 'selected' }} @endif>
                                                {{ $center->center_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="role_id">{{ __('role_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="role_id" name="role_id" class="form-control custom-select">
                                        @foreach ($userRoles as $userRole)
                                            <option value="{{ $userRole->role_id }}"
                                                @if ($userRole->role_id == $user->role_id) {{ 'selected' }} @endif>
                                                {{ $userRole->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger text-white w-100 text-nowrap m-1"
                                data-toggle="modal" data-target="#reset-pass">{{ __('changePassword') }}</button>
                            <button type="submit"
                                class="btn btn-warning w-100 text-nowrap m-1">{{ __('update') }}</button>
                            <button onclick="javascript:history.back()"
                                class="btn bg-olive text-white w-100 text-nowrap m-1">{{ __('back') }}</button>
                        </div>
                    </form>
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
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn bg-olive text-white text-nowrap"
                            data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit" class="btn bg-olive text-white text-nowrap">{{ __('update') }}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>
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
                    name: {
                        required: true,
                    },
                    user_name: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    role_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "{{ __('enterContent') }}",
                    },
                    user_name: {
                        required: "{{ __('enterContent') }}",
                    },
                    password: {
                        required: "{{ __('enterContent') }}",
                    },
                    role_id: {
                        required: "{{ __('selectContent') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-9').append(error);

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

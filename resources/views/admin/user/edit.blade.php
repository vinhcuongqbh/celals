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
                        <h3 class="card-title text-danger text-uppercase text-bold">{{ __('user_information') }}</h3>
                    </div>
                    <form action="{{ route('user.update', $user->user_id) }}" method="post" id="form-validate">
                        @csrf
                        <div class="card-body">                            
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="user_name">{{ __('user_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="name">{{ __('name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="address">{{ __('address') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="address" name="address" value="{{ $user->address }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tel">{{ __('tel') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="tel" name="tel" value="{{ $user->tel }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tel">{{ __('email') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="email" name="email" value="{{ $user->email }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="center_id">{{ __('center_name') }}</label>
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
                                    <label class="col-form-label" for="role_id">{{ __('role_name') }}</label>
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
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-olive col-sm-2 mx-1">{{ __('update') }}</button>                            
                            <a class="btn btn-secondary col-sm-2"
                                href="{{ route('user.show', $user->user_id) }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

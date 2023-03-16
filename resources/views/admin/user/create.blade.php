@extends('layouts.master')

@section('title', 'User Create')

@section('heading')
    {{ __('user_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('new_user') }}</h3>
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
                    <form action="{{ route('user.store') }}" method="post" id="form-validate">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="name">{{ __('name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="user_name">{{ __('user_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="password">{{ __('password') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" id="password" name="password" value=""
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="address">{{ __('address') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="tel">{{ __('tel') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="tel" name="tel" value="{{ old('tel') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="email">{{ __('email') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="center_id">{{ __('center_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="center_id" name="center_id" class="form-control custom-select">
                                        <option selected disabled></option>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->center_id }}">{{ $center->center_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="role_id">{{ __('user_role') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="role_id" name="role_id" class="form-control custom-select">
                                        <option selected disabled></option>
                                        @foreach ($userRoles as $userRole)
                                            <option value="{{ $userRole->role_id }}">{{ $userRole->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit"
                                class="btn btn-warning w-100 text-nowrap m-1">{{ __('create') }}</button>
                            <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                                href="{{ route('user') }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
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
@stop

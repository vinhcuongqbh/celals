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
                        <h3 class="card-title text-danger text-uppercase text-bold">{{ __('user_information') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="user_name">{{ __('user_name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="name">{{ __('name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" value="{{ $user->name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="address">{{ __('address') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="address" name="address" value="{{ $user->address }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="tel">{{ __('tel') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="tel" name="tel" value="{{ $user->tel }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="email">{{ __('email') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="email" name="email" value="{{ $user->email }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="center_name">{{ __('center_name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="center_name" name="center_name" value="{{ $user->center_name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="role_name">{{ __('role_name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="role_name" name="role_name" value="{{ $user->role_name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-primary col-sm-auto ml-1" data-toggle="modal"
                            data-target="#reset-pass">{{ __('changePassword') }}</button>
                        @if (Auth::user()->role_id == 1)
                            <a class="btn bg-olive col-sm-2 ml-1"
                                href="{{ route('user.edit', $user->user_id) }}">{{ __('edit') }}</a>
                        @endif
                        <a class="btn btn-secondary col-sm-2 ml-1" href="{{ route('user') }}">{{ __('back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                <label class="col-form-label" for="password"
                                    class="col-form-label">{{ __('newPassword') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="col-form-label" for="confirmPassword"
                                    class="col-form-label">{{ __('confirmPassword') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->user_id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-olive text-white text-nowrap">{{ __('update') }}</button>
                    </div>
                </div>
            </div>
        </div>
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
@stop

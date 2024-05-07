@extends('layouts.master')

@section('title', 'Referral Information')

@section('heading')
    {{ __('user_referral') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('user_referral') }}</h3>
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
                    <form action="{{ route('referral.update', $userRef->id) }}" method="post" id="form-validate">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="advise_type_id">{{ __('advise_type_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="advise_type_id" name="advise_type_id"
                                        value="@if ($userRef->advise_type_id == 0) {{'Đăng ký học thử và Thi thử miễn phí'}}
                                            @else {{'Tư vấn du học'}} @endif" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="student_name">{{ __('name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="student_name" name="student_name"
                                        value="{{ $userRef->student_name }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="student_tel">{{ __('tel') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="student_tel" name="student_tel"
                                        value="{{ $userRef->student_tel }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="student_email">{{ __('email') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="student_email" name="student_email"
                                        value="{{ $userRef->student_email }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="student_age">{{ __('age') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="student_age" name="student_age"
                                        value="{{ $userRef->student_age }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="student_school">{{ __('school') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="student_school" name="student_school"
                                        value="{{ $userRef->student_school }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="ref_name">{{ __('ref_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="ref_name" name="ref_name" value="{{ $userRef->name }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="ref_status_name">{{ __('ref_status_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="ref_status_id" name="ref_status_id" class="form-control custom-select"
                                        @if (Auth::user()->role_id != 1) {{ 'disabled' }} @endif>
                                        @foreach ($refStatuses as $refStatus)
                                            <option value="{{ $refStatus->ref_status_id }}"
                                                @if ($refStatus->ref_status_id == $userRef->ref_status_id) {{ 'selected' }} @endif>
                                                {{ $refStatus->ref_status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            @if (Auth::user()->role_id == 1)
                                <button type="submit"
                                    class="btn btn-warning w-100 text-nowrap m-1">{{ __('update') }}</button>
                            @endif
                            <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                                href="{{ route('referral.customer') }}">{{ __('back') }}</a>
                        </div>
                    </form>
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
@stop

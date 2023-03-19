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
                                    <label for="parent_name">{{ __('parent_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="parent_name" name="parent_name"
                                        value="{{ $userRef->parent_name }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="tel">{{ __('tel') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="tel" name="tel" value="{{ $userRef->tel }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="email">{{ __('email') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="email" name="email" value="{{ $userRef->email }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="child_age">{{ __('child_age') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="child_age" name="child_age" value="{{ $userRef->child_age }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="center_name">{{ __('center_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="center_name" name="center_name"
                                        value="{{ $userRef->center_name }}" class="form-control" disabled>
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

@extends('layouts.master')

@section('title', 'Center Information')

@section('heading')
{{ __('center_management') }}
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title text-danger text-uppercase text-bold">{{ __('center_information') }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="center_name">{{ __('center_name') }}</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="center_name" name="center_name" value="{{ $center->center_name }}"
                                class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="address">{{ __('address') }}</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="address" name="address" value="{{ $center->center_address }}"
                                class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="logo">{{ __('logo') }}</label>
                        </div>
                        <div class="col-sm-9">
                            <img src="{{ $center->link_logo }}"
                                alt="Logo Đơn vị"
                                class="img-fluid"
                                style="object-fit: contain; max-height: 150px; max-width: 50%;">
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    @if (Auth::user()->role_id == 1)
                    <a class="btn bg-olive col-sm-2 ml-1"
                        href="{{ route('center.edit', $center->center_id) }}">{{ __('edit') }}</a>
                    @endif
                    <a class="btn btn-secondary col-sm-2 ml-1" href="{{ route('center') }}">{{ __('back') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
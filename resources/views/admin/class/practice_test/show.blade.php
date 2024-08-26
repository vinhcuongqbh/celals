@extends('layouts.master')

@section('title', 'Test Show')

@section('heading')
    {{ __('test_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-9">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="form-group row">
                            <div class="col-auto">
                                <label for="" class="text-uppercase text-danger">{{ __('subject') }}</label>
                            </div>
                            <div class="col-10 text-center">
                                <label class="text-uppercase" for="">{{ $test->subject }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <label for="" class="text-uppercase text-danger ">{{ __('question') }}</label>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-12 ck-content">
                                {!! $test->question !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <label for="" class="text-uppercase text-danger">{{ __('suggested_answer') }}</label>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="holder">
                                <div class="col-12 ck-content">
                                    {!! $test->suggested_answer !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="level">{{ __('level') }}</label>
                                </div>
                                <div class="col-12">
                                    <select id="level_id" name="level_id" class="form-control custom-select" disabled>
                                        <option value="{{ $test->level_id }}">{{ $test->level->level_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="">{{ __('test_type') }}</label>
                                </div>
                                <div class="col-12">
                                    <select id="test_type_id" name="test_type_id" class="form-control custom-select"
                                        disabled>
                                        <option value="{{ $test->test_type_id }}">
                                            {{ $test->test_type->test_type_name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="test_form">{{ __('test_form') }}</label>
                                </div>
                                <div class="col-12">
                                    <input type="text" id="test_form" name="test_form" value="{{ $test->test_form }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="test_duration">{{ __('test_duration') }}</label>
                                </div>
                                <div class="col-12 input-group">
                                    <input type="number" id="test_duration" name="test_duration"
                                        value="{{ $test->test_duration }}" class="form-control" min="0" disabled>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">phút</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn bg-warning text-white w-100 text-nowrap m-1"
                            href="{{ route('practice_test.public', $test->test_id) }}">{{ __('public') }}</a>
                        <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                            href="{{ route('practice_test.edit', $test->test_id) }}">{{ __('edit') }}</a>
                        <a class="btn bg-primary text-white w-100 text-nowrap m-1"
                            href="{{ route('practice_test.index') }}">{{ __('back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="/ckeditor/styles.css" />
    <link rel="stylesheet" type="text/css" href="/ckeditor/ckeditor5.css" />
@endsection

@section('js')
    <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
    <script>
        document.querySelectorAll('oembed[url]').forEach(element => {
            // Create the <a href="..." class="embedly-card"></a> element that Embedly uses
            // to discover the media.
            const anchor = document.createElement('a');

            anchor.setAttribute('href', element.getAttribute('url'));
            anchor.className = 'embedly-card';

            element.appendChild(anchor);
        });
    </script>
@stop

@extends('layouts.master')

@section('title', 'Test Show')

@section('heading')
    {{ __('test_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="level">{{ __('level') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <select id="level_id" name="level_id" class="form-control custom-select" disabled>
                                    <option value="{{ $test->level_id }}">{{ $test->level_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="subject">{{ __('subject') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" id="subject" name="subject" value="{{ $test->subject }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="">{{ __('test_type') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <select id="test_type_id" name="test_type_id" class="form-control custom-select" disabled>
                                    <option value="{{ $test->test_type_id }}">{{ $test->test_type_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="test_form">{{ __('test_form') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" id="test_form" name="test_form" value="{{ $test->test_form }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="test_duration">{{ __('test_duration') }}</label>
                            </div>
                            <div class="col-sm-10 input-group">
                                <input type="number" id="test_duration" name="test_duration"
                                    value="{{ $test->test_duration }}" class="form-control" min="0" readonly>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">phút</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if (isset($test->question))
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="question">{{ __('question') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea id="question" name="question" class="form-control" rows="18" readonly>{{ $test->question }}</textarea>
                                </div>
                            </div>
                        @endif
                        @if (isset($test->link_question))
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="question">{{ __('question') }}</label>
                                </div>
                                <div class="col-12 col-sm-10">
                                    <div class="holder">
                                        <img id="imgPreview" alt="pic" src="{{ $test->link_question }}" />
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($test_details as $td)
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="">{{ __('link_audio') }} {{ $i++ }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <audio controls controlsList="nodownload" src="{{ $td->link_audio }}"></audio>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-end">
                        <a class="btn bg-olive text-white text-nowrap col-2 m-1"
                            href="{{ route('listening.test_edit', $test->test_id) }}">{{ __('edit') }}</a>
                        <a class="btn bg-primary text-white text-nowrap col-2 m-1"
                            href="{{ route('listening.test_list') }}">{{ __('back') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
    <style>
        .holder {
            width: 100%;
        }

        #imgPreview {
            max-width: 100%;
        }
    </style>
@endsection

@section('js')
@stop

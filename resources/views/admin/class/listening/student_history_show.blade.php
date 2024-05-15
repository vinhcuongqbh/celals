@extends('layouts.master')

@section('title', 'Block Show')

@section('heading')
    <label for="subject">{{ __('subject') }}:</label>{{ ' ' . $test->subject }}
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12 col-sm-6">
                <div class="card card-default">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-header">
                        <label for="" class="text-danger">PHẦN ĐỀ BÀI</label>
                    </div>
                    <div class="card-body">
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
                                    @foreach ($test_types as $test_type)
                                        <option value="{{ $test_type->test_type_id }}"
                                            @if ($test_type->test_type_id == $test->test_type_id) selected @endif>
                                            {{ $test_type->test_type_name }}
                                        </option>
                                    @endforeach
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
                                <div class="col-sm-10">
                                    <div class="holder">
                                        <img class="imgPreview" alt="pic" src="{{ $test->link_question }}" />
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
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card card-default">
                    <div class="card-header">
                        <label for="" class="text-danger">PHẦN HỌC VIÊN TRẢ LỜI</label>
                    </div>
                    <div class="card-body">
                        @if (isset($student_answer->answer))
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="student_answer">{{ __('student_answer') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea id="student_answer" name="student_answer" class="form-control" rows="18" readonly>{{ $student_answer->student_answer }}</textarea>
                                </div>
                            </div>
                        @endif
                        @if (isset($student_answer->link_answer))
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="student_answer">{{ __('student_answer') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="holder">
                                        <img class="imgPreview" src="{{ $student_answer->link_answer }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <label for="" class="text-danger">PHẦN GIÁO VIÊN CHẤM ĐIỂM</label>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="comment">{{ __('comment') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <textarea id="comment" name="comment" class="form-control" rows="18" readonly>{{ $student_answer->comment }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="point">{{ __('point') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" id="point" name="point"
                                    value="{{ $student_answer->point }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a class="btn bg-primary text-white text-nowrap col-2"
                            href="{{ route('listening.student_history_study') }}">{{ __('back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('css')
    <style>
        .holder {
            width: 100%;
        }

        .imgPreview {
            max-width: 100%;
        }
    </style>
@endsection

@section('js')
@stop

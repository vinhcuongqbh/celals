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
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="subject">{{ __('subject') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="subject" name="subject" value="{{ $test->subject }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="">{{ __('test_type') }}</label>
                            </div>
                            <div class="col-sm-9">
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
                            <div class="col-sm-3">
                                <label for="test_form">{{ __('test_form') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="test_form" name="test_form" value="{{ $test->test_form }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="test_duration">{{ __('test_duration') }}</label>
                            </div>
                            <div class="col-sm-9 input-group">
                                <input type="number" id="test_duration" name="test_duration"
                                    value="{{ $test->test_duration }}" class="form-control" min="0" readonly>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">phút</div>
                                </div>
                            </div>
                        </div>
                        @if (isset($test->question))
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="question">{{ __('question') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="question" name="question" class="form-control" rows="18" readonly>{{ $test->question }}</textarea>
                                </div>
                            </div>
                        @endif
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($test_details as $td)
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="">{{ __('link_audio') }} {{ $i++ }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <audio controls controlsList="nodownload" src="{{ $td->link_audio }}"></audio>
                                </div>
                            </div>
                        @endforeach
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="student_answer">{{ __('student_answer') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea id="student_answer" name="student_answer" class="form-control" rows="18">{{ old('student_answer') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="">{{ __('link_answer') }}</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="link_answer" name="link_answer"
                                            accept="image/*">
                                        <label class="custom-file-label" for="link_answer"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="test_id" value="{{ $test->test_id }}">
                        <input type="hidden" name="student_id" value="{{ Auth::user()->user_id }}">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning text-nowrap mx-1">{{ __('send') }}</button>
                        <a class="btn bg-olive text-white text-nowrap"
                            href="{{ route('listening.student_block_show') }}">{{ __('back') }}</a>
                    </div>
                </div>
            </div>
            @if (isset($test->link_question))
                <div class="col-xl-6">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="holder">
                                        <img id="imgPreview" alt="pic" src="{{ $test->link_question }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
@endsection

@section('js')
@stop

@extends('layouts.master')

@section('title', 'Block Show')

@section('heading')
    <label for="subject">{{ __('subject') }}:</label>{{ ' ' . $test->subject }}
@stop

@section('content')
    <form action="{{ route('listening.student_test_store') }}" method="post" id="form-validate" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title text-bold text-danger">PHẦN ĐỀ BÀI</h3>
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
                                    <select id="test_type_id" name="test_type_id" class="form-control custom-select"
                                        disabled>
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
                                    <div class="col-12">
                                        <label for="question">{{ __('question') }}</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="holder border">
                                            {!! $test->question !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isset($test->link_question))
                                <div class="form-group row">
                                    <div class="col-sm-2">       
                                        <label for="question">{{ __('question') }}</label>                                 
                                    </div>
                                    <div class="col-10">
                                        <div class="holder">
                                            <img id="link_question" name="link_question" alt="pic"
                                                src="{{ $test->link_question }}" />
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
                            <h3 class="card-title text-bold text-danger">PHẦN HỌC VIÊN LÀM BÀI</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="student_answer">{{ __('student_answer') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea id="student_answer" name="student_answer" class="form-control" rows="18">{{ old('student_answer') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="">{{ __('link_answer') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="link_answer"
                                                name="link_answer" accept="image/*">
                                            <label class="custom-file-label" for="link_answer"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for=""></label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="holder">
                                        <img id="imgPreview" alt="pic" src="/img/blank_2.png" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn bg-olive text-nowrap col-2 mx-1">{{ __('send') }}</button>
                            <a class="btn bg-primary text-white text-nowrap col-2"
                                href="{{ route('listening.student_block_show') }}">{{ __('back') }}</a>
                        </div>
                        <input type="hidden" name="test_id" value="{{ $test->test_id }}">
                        <input type="hidden" name="student_id" value="{{ Auth::user()->user_id }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </form>
@stop

@section('css')
    <style>
        .holder {
            width: 100%;
        }

        #imgPreview {
            max-width: 100%;
        }

        #link_question {
            max-width: 100%;
        }
    </style>
@endsection

@section('js')
    <!-- IMG Preview -->
    <script>
        $(document).ready(() => {
            $('#link_answer').change(function() {
                const file = this.files[0];
                console.log(file);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $('#imgPreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    <!-- Hiển thị tên file khi được upload -->
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@stop

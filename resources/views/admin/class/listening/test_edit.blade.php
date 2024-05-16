@extends('layouts.master')

@section('title', 'Test Show')

@section('heading')
    {{ __('test_management') }}
@stop

@section('content')
    <form action="{{ route('listening.test_update', $test->test_id) }}" method="post" id="form-validate"
        enctype="multipart/form-data">
        @csrf
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
                                    <select id="level_id" name="level_id" class="form-control custom-select">
                                        <option selected></option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->level_id }}"
                                                @if ($level->level_id == $test->level_id) selected @endif>{{ $level->level_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="subject">{{ __('subject') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" id="subject" name="subject" value="{{ $test->subject }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="">{{ __('test_type') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <select id="test_type_id" name="test_type_id" class="form-control custom-select">
                                        <option selected></option>
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
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="test_duration">{{ __('test_duration') }}</label>
                                </div>
                                <div class="col-sm-10 input-group">
                                    <input type="number" id="test_duration" name="test_duration"
                                        value="{{ $test->test_duration }}" class="form-control" min="0">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">phút</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="question">{{ __('question') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea id="question" name="question" class="form-control" rows="18">{{ $test->question }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="">{{ __('link_question') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="link_question"
                                                name="link_question" accept="image/*">
                                            <label class="custom-file-label" for="link_question"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-12 col-sm-10">
                                    <div class="holder">
                                        <img id="imgPreview" alt="pic" src="{{ $test->link_question }}" />
                                    </div>
                                </div>
                            </div>
                            @php
                                $i = 1;
                                $j = 1;
                            @endphp
                            @foreach ($test_details as $td)
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label for="">{{ __('link_audio') }} {{ $i }}</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <audio controls controlsList="nodownload" src="{{ $td->link_audio }}"></audio>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label for=""></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    id="link_audio_{{ $i }}"
                                                    name="link_audio_{{ $i }}" accept="audio/*">
                                                <label class="custom-file-label"
                                                    for="link_audio_{{ $i++ }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ($i < 10)
                                @for ($j = $i; $j <= 10; $j++)
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <label for="">{{ __('link_audio') }} {{ $j }}</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="link_audio_{{ $j }}"
                                                        name="link_audio_{{ $j }}" accept="audio/*">
                                                    <label class="custom-file-label"
                                                        for="link_audio_{{ $j }}"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-olive text-nowrap col-2 m-1">{{ __('update') }}</button>
                            <a class="btn bg-primary text-white text-nowrap col-2 m-1"
                                href="{{ route('listening.test_list') }}">{{ __('back') }}</a>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
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
    </style>
@endsection

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#form-validate').validate({
                rules: {
                    level_id: {
                        required: true,
                    },
                    subject: {
                        required: true,
                    },
                    test_type_id: {
                        required: true,
                    },
                },
                messages: {
                    level_id: {
                        required: "{{ __('selectContent') }}",
                    },
                    subject: {
                        required: "{{ __('enterContent') }}",
                    },
                    test_type_id: {
                        required: "{{ __('selectContent') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-10').append(error);

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

    <!-- IMG Preview -->
    <script>
        $(document).ready(() => {
            $('#link_question').change(function() {
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

@extends('layouts.master')

@section('title', 'Test Edit')

@section('heading')
    {{ __('test_management') }}
@stop

@section('content')
    <form action="{{ route('practice_test.update', $test->test_id) }}" method="post" id="form-validate">
        @csrf
        @method('PUT')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-9">
                    <div class="card card-default">
                        <div class="card-header row">
                            <div class="col-12 col-sm-2">
                                <label for=""
                                    class="col-form-label text-uppercase text-danger">{{ __('subject') }}</label>
                            </div>
                            <div class="col-12 col-sm-10">
                                <input type="text" id="subject" name="subject" value="{{ $test->subject }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <label for=""
                                class="col-form-label text-uppercase text-danger p-0">{{ __('question') }}</label>
                        </div>
                        <div class="card-body p-0">
                            <textarea id="editor1" name="question" class="form-control -" rows="5">{{ $test->question }}</textarea>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <label for=""
                                class="col-form-label text-uppercase text-danger p-0">{{ __('suggested_answer') }}</label>
                        </div>
                        <div class="card-body p-0">
                            <div class="form-group row">
                                <div class="col-12">
                                    <textarea id="editor2" name="suggested_answer" class="form-control" rows="5">{{ $test->suggested_answer }}</textarea>
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
                                        <label for="level" class="col-form-label">{{ __('level') }}</label>
                                    </div>
                                    <div class="col-12">
                                        <select id="level_id" name="level_id" class="form-control custom-select">
                                            <option selected></option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->level_id }}"
                                                    @if ($level->level_id == $test->level_id) selected @endif>
                                                    {{ $level->level_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="" class="col-form-label">{{ __('test_type') }}</label>
                                    </div>
                                    <div class="col-12">
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
                                    <div class="col-12">
                                        <label for="test_form" class="col-form-label">{{ __('test_form') }}</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="test_form" name="test_form"
                                            value="{{ $test->test_form }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="test_duration" class="col-form-label">{{ __('test_duration') }}</label>
                                    </div>
                                    <div class="col-12 input-group">
                                        <input type="number" id="test_duration" name="test_duration"
                                            value="{{ $test->test_duration }}" class="form-control" min="0">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">phút</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit" class="btn bg-olive text-nowrap w-100 m-1">{{ __('update') }}</button>
                            <a class="btn bg-primary text-white text-nowrap w-100 m-1"
                                href="{{ route('practice_test.index') }}">{{ __('back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')    
    <link rel="stylesheet" type="text/css" href="/ckeditor/ckeditor5.css" />
    <link rel="stylesheet" type="text/css" href="/ckeditor/styles.css" />
@endsection

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(function() {
            $('#form-validate').validate({
                rules: {
                    subject: {
                        required: true,
                    },
                    level_id: {
                        required: true,
                    },
                    test_type_id: {
                        required: true,
                    },
                },
                messages: {
                    subject: {
                        required: "{{ __('enterContent') }}",
                    },
                    level_id: {
                        required: "{{ __('selectContent') }}",
                    },

                    test_type_id: {
                        required: "{{ __('selectContent') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-12').append(error);

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

    {{-- Ckeditor --}}
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/ckeditor/ckeditor_admin_config.js"></script>
    <script type="text/javascript" src="/ckfinder_admin/ckfinder.js"></script>    
@stop

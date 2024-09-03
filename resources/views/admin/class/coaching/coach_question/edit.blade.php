@extends('layouts.master')

@section('title', 'Coach Question Edit')

@section('heading')
    {{ __('question_management') }}
@stop

@section('content')
    <form action="{{ route('coach_question.update', $coach_question->id) }}" method="post" id="form"
        enctype="multipart/form-data">
        <div class="container-fluid">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-sm-9">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title text-danger text-uppercase text-bold">{{ __('question') }}</h3> 
                        </div>
                        <div class="card-body p-0">
                            <textarea id="editor1" name="question" class="form-control">{{ $coach_question->question }}</textarea>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title text-danger text-uppercase text-bold">{{ __('suggest_answer') }}</h3>
                        </div>
                        <div class="card-body p-0">
                            <textarea id="editor2" name="suggest_answer" class="form-control">{{ $coach_question->suggest_answer }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="coach_type_id">{{ __('coach_type') }}</label>
                                    </div>
                                    <div class="col-12">
                                        <select id="coach_type_id" name="coach_type_id" class="form-control custom-select">
                                            <option selected></option>
                                            @foreach ($coach_types as $coach_type)
                                                <option value="{{ $coach_type->id }}"
                                                    {{ $coach_question->coach_type_id == $coach_type->id ? 'selected' : '' }}>
                                                    {{ $coach_type->type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="coach_subject_id">{{ __('coach_subject') }}</label>
                                    </div>
                                    <div class="col-12">
                                        <select id="coach_subject_id" name="coach_subject_id"
                                            class="form-control custom-select">
                                            <option selected disabled></option>
                                            @foreach ($coach_subjects as $coach_subject)
                                                <option value="{{ $coach_subject->id }}"
                                                    {{ $coach_question->coach_subject_id == $coach_subject->id ? 'selected' : '' }}>
                                                    {{ $coach_subject->subject_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit" class="btn bg-olive w-100 text-nowrap m-1">{{ __('update') }}</button>
                            <a class="btn bg-primary text-white w-100 text-nowrap m-1"
                                href="{{ route('coach_question.index') }}">{{ __('back') }}</a>
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
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#form').validate({
                rules: {
                    coach_type_id: {
                        required: true,
                    },
                    question: {
                        required: true,
                    },
                },
                messages: {
                    coach_type_id: {
                        required: "{{ __('select_content') }}",
                    },
                    question: {
                        required: "{{ __('enter_content') }}",
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

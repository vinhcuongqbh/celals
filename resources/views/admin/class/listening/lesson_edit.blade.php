@extends('layouts.master')

@section('title', 'Lesson Create')

@section('heading')
    {{ __('lesson_management') }}
@stop

@section('content')
    <form action="{{ route('listening.lesson_update', $lesson->lesson_id) }}" method="post" id="form-validate"
        enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-9">
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
                                                @if ($level->level_id == $lesson->level_id) selected @endif>{{ $level->level_name }}
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
                                    <input type="text" id="subject" name="subject" value="{{ $lesson->subject }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="">{{ __('link_audio') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <audio controls controlsList="nodownload" src="{{ $lesson->link_audio }}"></audio>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="link_audio"
                                                name="link_audio" accept="audio/*">
                                            <label class="custom-file-label" for="link_audio"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">{{ __('question') }}</label>
                                </div>
                                <div class="col-sm-12">
                                    <textarea id="editor1" name="question" class="form-control" rows="18">{{ $lesson->question }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">{{ __('answer') }}</label>
                                </div>
                                <div class="col-sm-12">
                                    <textarea id="editor2" name="answer" class="form-control" rows="18">{{ $lesson->answer }}</textarea>
                                </div>
                            </div>      
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-olive text-nowrap col-2 m-1">{{ __('update') }}</button>
                            <a class="btn bg-primary text-white text-nowrap col-2 m-1"
                                href="{{ route('listening.lesson_list') }}">{{ __('back') }}</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
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
            $('#form-validate').validate({
                rules: {
                    level_id: {
                        required: true,
                    },
                    subject: {
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

    {{-- Ckeditor --}}
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/ckeditor/ckeditor_admin_config.js"></script>
    <script type="text/javascript" src="/ckfinder_admin/ckfinder.js"></script>
@stop

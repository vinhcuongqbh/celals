@extends('layouts.master')

@section('title', 'Lesson Create')

@section('heading')
    {{ __('lesson_management') }}
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
                                    <option value="{{ $lesson->level_id }}">
                                        {{ $lesson->level_name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="subject">{{ __('subject') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" id="subject" name="subject" value="{{ $lesson->subject }}"
                                    class="form-control" readonly>
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
                        @if (isset($lesson->answer))
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="answer">{{ __('answer') }}</label>
                                </div>
                                @if ((stripos($lesson->answer, '<p>') !== false)||(stripos($lesson->answer, '<figure') !== false))
                                    <div class="col-sm-12 ck-content">
                                        {!! $lesson->answer !!}
                                    </div>
                                @else
                                    <div class="col-sm-12">
                                        <textarea id="answer" name="answer" class="form-control" rows="18" readonly>{{ $lesson->answer }}</textarea>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if (isset($lesson->link_answer))
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="answer">{{ __('answer') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="holder">
                                        <img id="imgPreview" alt="pic" src="{{ $lesson->link_answer }}" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-end">
                        <a class="btn bg-olive text-white text-nowrap col-2 m-1"
                            href="{{ route('listening.lesson_edit', $lesson->lesson_id) }}">{{ __('edit') }}</a>
                        <a class="btn bg-primary text-white text-nowrap col-2 m-1"
                            href="{{ route('listening.lesson_list') }}">{{ __('back') }}</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
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
                    subject: {
                        required: true,
                    },
                    link_audio: {
                        required: true,
                    },
                },
                messages: {
                    subject: {
                        required: "{{ __('enterContent') }}",
                    },
                    link_audio: {
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

@extends('layouts.master')

@section('title', 'Block Show')

@section('heading')
    <label for="subject">{{ __('subject') }}:</label>{{ ' ' . $practice_test->subject }}
@stop

@section('content')
    <form action="{{ route('public_test.teacher_test.update', [$public_test->public_test_id, $student_answer->id]) }}"
        method="post" id="form-validate">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <label for="" class="col-form-label text-danger p-0">PHẦN ĐỀ BÀI</label>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-12 ck-content">
                                    {!! $practice_test->question !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <label for="" class="col-form-label text-danger p-0">PHẦN GỢI Ý TRẢ LỜI</label>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-12 ck-content">
                                    {!! $practice_test->suggested_answer !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <label for="" class="col-form-label text-danger p-0">PHẦN HỌC VIÊN TRẢ LỜI</label>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-12 ck-content">
                                    {!! $student_answer->answer !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <label for="" class="col-form-label text-danger p-0">PHẦN GIÁO VIÊN NHẬN XÉT</label>
                        </div>
                        <div class="card-body p-0">
                            <textarea id="comment" name="comment" class="form-control">{!! $student_answer->comment !!}</textarea>
                            <div class="form-group row m-3">
                                <div class="col-12">
                                    <label for="point">{{ __('point') }}</label>
                                </div>
                                <div class="col-12">
                                    <input type="number" id="point" name="point" class="form-control"
                                        value="{{ $student_answer->point }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-olive text-nowrap col-auto mx-1">{{ __('update') }}</button>
                            <a class="btn bg-primary text-white text-nowrap col-auto"
                                href="{{ route('public_text.show', $student_answer->public_test_id) }}">{{ __('back') }}</a>
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
            $('#form-validate').validate({
                rules: {
                    comment: {
                        required: true,
                    },
                    point: {
                        required: true,
                    },
                },
                messages: {
                    comment: {
                        required: "{{ __('enterContent') }}",
                    },
                    point: {
                        required: "{{ __('enterContent') }}",
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

    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/ckfinder_admin/ckfinder.js"></script>
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("comment"), {
            toolbar: {
                items: [
                    'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript',
                    'alignment', '|',
                    'link', 'insertImage',
                ],
                shouldNotGroupWhenFull: true
            },

            ckfinder: {
                uploadUrl: '/ckfinder_guest/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
            },
            removePlugins: [
                'CKBox',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
            ]
        });
    </script>
@stop

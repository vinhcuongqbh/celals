@extends('layouts.master2')

@section('title', 'CELALS')

@section('content')
    <form action="{{ route('public_test.store', $public_test->public_test_id) }}" method="post" id="form">
        @csrf
        <div class="container-fluid">
            <div class="row" style="padding: 50px 10px; display: flex; align-items: center; justify-content: center;">
                <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                    <h4 class="text-bold text-uppercase">{{ $practice_test->subject }}</h4>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-sm-9">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <label class="col-form-label text-uppercase text-danger p-0"
                                                for="question">{{ __('question') }}</label>
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
                                            <label class="col-form-label text-uppercase text-danger p-0"
                                                for="answer">{{ __('answer') }}</label>
                                        </div>
                                        <div class="card-body p-0">
                                            <textarea id="answer" name="answer" class="form-control">{{ old('answer') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <label class="col-form-label text-uppercase text-danger p-0"
                                                for="answer">THÔNG TIN THÍ SINH</label>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-sm-12">Họ và
                                                    tên:</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="name"
                                                        id="name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-sm-12">Độ
                                                    tuổi:</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" name="age"
                                                        id="age">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-sm-12">Điện
                                                    thoại:</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="tel"
                                                        id="tel">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" class="btn bg-olive text-nowrap col-4 col-xl-6">Nộp Bài
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
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
                    name: {
                        required: true,
                    },
                    age: {
                        required: true,
                    },
                    tel: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "{{ __('enterContent') }}",
                    },
                    age: {
                        required: "{{ __('enterContent') }}",
                    },
                    tel: {
                        required: "{{ __('enterContent') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-12').append(error);

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
    <script type="text/javascript" src="/ckfinder_admin/ckfinder.js"></script>

    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("answer"), {
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

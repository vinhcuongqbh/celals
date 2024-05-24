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

<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>
<script type="text/javascript" src="/ckfinder/ckfinder.js"></script>

<script>
    // This sample still does not showcase all CKEditor 5 features (!)
    // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
    CKEDITOR.ClassicEditor.create(document.getElementById("question"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [

                'exportPDF', 'exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'CKFinder', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                'htmlEmbed',
                '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing',
            ],
            shouldNotGroupWhenFull: true
        },

        ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

            // Define the CKFinder configuration (if necessary).
            // options: {
            //     resourceType: 'Images'
            // }
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 3',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 4',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 5',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 6',
                    class: 'ck-heading_heading6'
                }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Welcome to CKEditor 5!',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [{
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true
            }]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [{
                marker: '@',
                feed: [
                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                    '@chocolate', '@cookie', '@cotton', '@cream',
                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                    '@gummi', '@ice', '@jelly-o',
                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                    '@sesame', '@snaps', '@soufflé',
                    '@sugar', '@sweet', '@topping', '@wafer'
                ],
                minimumCharacters: 1
            }]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            // 'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
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
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
        ]
    });
</script>
@stop

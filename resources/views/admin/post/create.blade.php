@extends('layouts.master')

@section('title', 'Post Create')

@section('heading')
    {{ __('post_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('post.store') }}" method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-9">
                            <div class="card card-default">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label class="text-danger" for="post_title">{{ __('post_title') }}</label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" id="post_title" name="post_title"
                                                    value="{{ old('post_title') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label class="text-danger"
                                                    for="post_content">{{ __('post_content') }}</label>
                                            </div>
                                            <div class="col-12" id="container">
                                                <textarea id="editor1" name="post_content"></textarea>
                                            </div>
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
                                                <label for="post_catalogue_id">{{ __('post_catalogue') }}</label>
                                            </div>
                                            <div class="col-12">
                                                <select id="post_catalogue_id" name="post_catalogue_id"
                                                    class="form-control custom-select">
                                                    <option selected disabled></option>
                                                    @foreach ($postCatalogues as $postCatalogue)
                                                        <option value="{{ $postCatalogue->post_catalogue_id }}">
                                                            {{ $postCatalogue->post_catalogue_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label>{{ __('post_img') }}</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="post_img"
                                                            name="post_img" accept="image/*">
                                                        <label class="custom-file-label" for="post_img"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="holder">
                                                    <img id="imgPreview" src="/img/example.jpg" alt="pic" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <button type="submit" class="btn bg-olive col-sm-4 ml-1">{{ __('create') }}</button>
                                    <a class="btn btn-secondary col-sm-4 ml-1"
                                        href="{{ route('post') }}">{{ __('back') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        #imgPreview {
            max-width: 100%;
            aspect-ratio: 3 / 2;
        }
    </style>
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
                    post_title: {
                        required: true,
                    },
                    post_catalogue_id: {
                        required: true,
                    },
                },
                messages: {
                    post_title: {
                        required: "{{ __('enterContent') }}",
                    },
                    post_catalogue_id: {
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

    {{-- CHỌN FILE UPLOAD --}}
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

    {{-- IMAGE PREVIEW --}}
    <script>
        $(document).ready(() => {
            $('#post_img').change(function() {
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

    {{-- CKEDITOR --}}
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/ckeditor/ckeditor_config.js"></script>
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
@stop

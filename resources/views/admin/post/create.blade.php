@extends('layouts.master')

@section('title', 'Post Create')

@section('heading')
    {{ __('post_management') }}
@stop

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('new_post') }}</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('post.store') }}" method="post" id="form-validate">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="post_catalogue_id">{{ __('post_catalogue') }}</label>
                                </div>
                                <div class="col-sm-10">
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
                                <div class="col-sm-2">
                                    <label for="post_img">{{ __('post_img') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="post_img" name="post_img"
                                                accept="image/*">
                                            <label class="custom-file-label" for="post_img"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="post_title">{{ __('post_title') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" id="post_title" name="post_title" value="{{ old('post_title') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="post_content">{{ __('post_content') }}</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea name="post_content" id="container">
                                    </textarea>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit"
                                class="btn btn-warning w-100 text-nowrap m-1">{{ __('create') }}</button>
                            <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                                href="{{ route('post') }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
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

    <script type="module">
        import CKFinder from '@ckeditor/ckeditor5-ckfinder/src/ckfinder';
        
        ClassicEditor
        .create( document.querySelector( '#editor' ), {
            plugins: [ CKFinder, /* ... */ ],

            // Enable the insert image button in the toolbar.
            toolbar: [ 'uploadImage', /* ... */ ],

            ckfinder: {
                // Upload the images to the server using the CKFinder QuickUpload command.
                uploadUrl: 'https://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
            }
        } )
        .then( /* ... */ )
        .catch( /* ... */ );
    </script>
@stop

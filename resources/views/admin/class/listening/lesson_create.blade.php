@extends('layouts.master')

@section('title', 'Lesson Create')

@section('heading')
    {{ __('lesson_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    {{-- <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('new') }}</h3>
                    </div> --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('listening.lesson_store') }}" method="post" id="form-validate"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="subject">{{ __('subject') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">{{ __('link_audio') }}</label>
                                </div>
                                <div class="col-sm-9">
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
                                <div class="col-sm-3">
                                    <label for="answer">{{ __('answer') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="answer" name="answer" class="form-control" rows="18">{{ old('answer') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="">{{ __('link_answer') }}</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="link_answer"
                                                name="link_answer" accept="image/*">
                                            <label class="custom-file-label" for="link_answer"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit"
                                class="btn btn-warning text-nowrap col-2 m-1">{{ __('create') }}</button>
                            <a class="btn bg-olive text-white text-nowrap col-2 m-1"
                                href="{{ route('listening.lesson_list') }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-xl-4">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="holder">
                                    <img id="imgPreview" alt="pic" src="/img/blank.png"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
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
                    element.closest('.col-sm-9').append(error);

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
            $('#link_answer').change(function() {
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

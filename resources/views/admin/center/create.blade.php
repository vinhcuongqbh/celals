@extends('layouts.master')

@section('title', 'Center Create')

@section('heading')
{{ __('center_management') }}
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title text-danger text-uppercase text-bold">{{ __('center_information') }}</h3>
                </div>
                <form action="{{ route('center.store') }}" method="post" id="form-validate" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="center_name">{{ __('center_name') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="center_name" name="center_name" value="{{ old('center_name') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="center_address">{{ __('address') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="center_address" name="center_address" value="{{ old('center_address') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="link_logo">{{ __('logo') }}</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="link_logo"
                                            name="link_logo" accept="image/*">
                                        <label class="custom-file-label" for="link_logo"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-9">
                                <div class="holder">
                                    <img id="imgPreview" 
                                        alt="Logo Đơn vị"
                                        class="img-fluid"
                                        style="object-fit: contain; max-height: 150px; max-width: 50%;" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-olive col-sm-2 mx-1">{{ __('create') }}</button>
                            <a class="btn btn-secondary col-sm-2"
                                href="{{ route('center') }}">{{ __('back') }}</a>
                        </div>
                </form>
            </div>
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
                center_name: {
                    required: true,
                },
            },
            messages: {
                center_name: {
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
        $('#link_logo').change(function() {
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
@stop
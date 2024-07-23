@extends('layouts.master')

@section('title', 'Coach Question Create')

@section('heading')
    {{ __('coach_question_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    {{-- <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('newSubject') }}</h3>
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
                    <form action="{{ route('coach_question.store') }}" method="post" id="form">
                        @csrf
                        <div class="card-body">                            
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="coach_type">{{ __('coach_type') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="coach_type" name="coach_type" class="form-control custom-select">
                                        <option selected disabled></option>
                                        @foreach ($coach_types as $coach_type)
                                            <option value="{{ $coach_type->id }}">{{ $coach_type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">                            
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="coach_subject">{{ __('coach_subject') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="coach_subject" name="coach_subject" class="form-control custom-select">
                                        <option selected disabled></option>
                                        @foreach ($coach_subjects as $coach_subject)
                                            <option value="{{ $coach_subject->id }}">{{ $coach_subject->subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">                            
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="subject_name">{{ __('subject_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="subject_name" name="subject_name" value="{{ old('subject_name') }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit"
                                class="btn btn-warning col-2 text-nowrap m-1">{{ __('create') }}</button>
                            <a class="btn bg-olive text-white col-2 text-nowrap m-1"
                                href="{{ route('coach_subject.index') }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#form').validate({
                rules: {
                    subject_name: {
                        required: true,
                    },
                },
                messages: {
                    subject_name: {
                        required: "{{ __('enter_content') }}",
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
@stop

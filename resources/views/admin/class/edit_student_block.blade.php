@extends('layouts.master')

@section('title', 'User Edit')

@section('heading')
    {{ __('user_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-danger text-uppercase text-bold">{{ __('user_information') }}</h3>
                    </div>
                    <form action="" method="post" id="form-validate">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="user_name">{{ __('user_name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="name">{{ __('name') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="level">{{ __('level') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="level_id" name="level_id" class="form-control custom-select">
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->level_id }}"
                                                @if ($user->level_id == $level->level_id) selected @endif>
                                                {{ $level->level_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="block">{{ __('Block') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="block_id" name="block_id" class="form-control custom-select">
                                        @foreach ($blocks as $block)
                                            <option value="{{ $block->block_id }}"
                                                @if ($user->listening_block_id == $block->block_id) selected @endif>
                                                {{ $block->block_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn bg-olive col-sm-2 mx-1">{{ __('update') }}</button>
                            <a class="btn btn-secondary col-sm-2"
                                href="{{ route('listening.student_list') }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

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
                    block_id: {
                        required: true,
                    }
                },
                messages: {
                    level_id: {
                        required: "{{ __('selectContent') }}",
                    },
                    block_id: {
                        required: "{{ __('selectContent') }}",
                    }
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


    <script>
        $(document).ready(function() {
            $('#level_id').on('change', function() {
                var level_id = this.value;
                $("#block_id").html('');
                $.ajax({
                    url: "{{ url('admin/block/blockList') }}",
                    type: "POST",
                    data: {
                        level_id: level_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {                       
                        $.each(result.block, function(key, value) {
                            $("#block_id").append('<option value="' + value
                                .block_id + '">' + value.block_name + '</option>');                           
                        });
                    }
                });
            });
        });
    </script>
@stop

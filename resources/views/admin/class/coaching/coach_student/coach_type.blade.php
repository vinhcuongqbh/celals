@extends('layouts.master')

@section('title', 'Coach Phỏng vấn')

@section('heading')
    @switch($coach_type_id)
        @case(1)
            {{ __('Coach Phỏng vấn') }}
        @break

        @case(2)
            {{ __('Coach Chủ đề') }}
        @break

        @case(3)
            {{ __('Coach Ngữ pháp Trung cấp') }}
        @break

        @case(4)
            {{ __('Coach Câu 51') }}
        @break

        @case(5)
            {{ __('Coach Câu 52') }}
        @break

        @case(6)
            {{ __('Coach Câu 53') }}
        @break

        @default
    @endswitch

@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <form action="{{ route('coaching.coach_student', $coach_type_id) }}" method="post" id="form">
                        @csrf
                        <div class="card-header">
                            <div class="row">
                                <div class="form-group row">
                                    <div class="col-auto">
                                        <label class="col-form-label" for="student_id">{{ __('student') }}</label>
                                    </div>
                                    <div class="col-auto">
                                        <select id="student_id" name="student_id" class="form-control custom-select"
                                            onchange="this.form.submit()">
                                            <option value="0" selected></option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->user_id }}"
                                                    @if ($student->user_id == $selected_student) selected @endif>
                                                    {{ $student->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @if ($selected_student > 0)
                    <form action="{{ route('coaching.student_result.update', [$selected_student, $coach_type_id]) }}"
                        method="post" id="formSubmit">
                        @csrf
                        <div class="card card-default">
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <colgroup>
                                        <col style="width:5%;">
                                        <col style="width:10%;">
                                        <col style="width:15%;">
                                        <col style="width:30%;">
                                        <col style="width:30%;">
                                        <col style="width:10%;">
                                    </colgroup>
                                    <thead style="text-align: center">
                                        <tr>
                                            <th class="text-center align-middle">{{ __('ID') }}</th>
                                            <th class="text-center align-middle">{{ __('Kết quả') }}</th>
                                            <th class="text-center align-middle">{{ __('coach_subject') }}</th>
                                            <th class="text-center align-middle">{{ __('coach_question') }}</th>
                                            <th class="text-center align-middle">{{ __('suggest_answer') }}</th>
                                            <th class="text-center align-middle">{{ __('point') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coach_questions as $coach_question)
                                            <tr>
                                                <td class="text-center align-top">{{ $coach_question->id }}</td>
                                                <td class="text-center align-top" id="result{{ $coach_question->id }}">
                                                    {{ isset($coach_question->pass) ? $coach_question->pass : 'Chưa đạt' }}
                                                </td>
                                                <td class="text-center align-top">
                                                    {{ $coach_question->coach_subject->subject_name }}
                                                </td>
                                                <td class="text-left ck-content align-top">{!! $coach_question->question !!}</td>
                                                <td class="text-left ck-content align-top">{!! $coach_question->suggest_answer !!}</td>
                                                <td class="text-center align-top"><input type="number"
                                                        id="question{{ $coach_question->id }}"
                                                        name="question{{ $coach_question->id }}" min="0"
                                                        max="10" placeholder="0" value="{{ $coach_question->point }}"
                                                        class="form-control text-center">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </form>
                @endif
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
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
                    student_id: {
                        required: true,
                    },
                },
                messages: {
                    student_id: {
                        required: "{{ __('select_content') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-auto').append(error);

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
        $(function() {
            $("#table").DataTable({
                lengthChange: false,
                pageLength: 20,
                searching: true,
                autoWidth: false,
                ordering: false,
                paging: false,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 500,
                dom: 'Bfrtip',
                buttons: [{
                    text: 'Cập nhật',
                    className: 'bg-olive',
                    action: function(e, dt, node, config) {
                        $('#table').dataTable().fnFilter('');
                        document.forms["formSubmit"].submit();
                    },
                }, ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

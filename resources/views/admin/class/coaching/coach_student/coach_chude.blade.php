@extends('layouts.master')

@section('title', 'Coach Chủ đề')

@section('heading')
    {{ __('Coach Chủ đề') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <form action="{{ route('coaching.coach_chude') }}" method="post" id="form-search">
                        @csrf
                        <div class="card-header">
                            <div class="row">
                                <div class="form-group row">
                                    <div class="col-auto">
                                        <label for="student_id">{{ __('student') }}</label>
                                    </div>
                                    <div class="col-auto">
                                        <select id="student_id" name="student_id" class="form-control custom-select">
                                            <option selected></option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->user_id }}"
                                                    @if ($student->user_id == $selected_student) selected @endif>{{ $student->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit"
                                            class="btn bg-olive text-white text-nowrap"><span>{{ __('search') }}</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                                    <th class="text-center align-middle">{{ __('Đạt/ Không đạt') }}</th>
                                    <th class="text-center align-middle">{{ __('coach_subject') }}</th>
                                    <th class="text-center align-middle">{{ __('coach_question') }}</th>
                                    <th class="text-center align-middle">{{ __('suggest_answer') }}</th>
                                    <th class="text-center align-middle">{{ __('point') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coach_questions as $coach_question)
                                    <tr>
                                        <td class="text-center">{{ $coach_question->id }}</td>
                                        <td class="text-center"></td>
                                        <td class="text-center">{{ $coach_question->subject_name }}</td>
                                        <td class="text-left ck-content">{!! $coach_question->question !!}</td>
                                        <td class="text-left ck-content">{!! $coach_question->suggest_answer !!}</td>
                                        <td><input type="number" min="0" max="10" placeholder="0"
                                                class="form-control text-center"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
    <link rel="stylesheet" href="/css/content-styles.css" type="text/css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
@stop

@section('js')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/vendor/jszip/jszip.min.js"></script>
    <script src="/vendor/pdfmake/pdfmake.min.js"></script>
    <script src="/vendor/pdfmake/vfs_fonts.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
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
                buttons: ["copy", "excel", "pdf", "print"],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

@extends('layouts.master')

@section('title', 'Coach Question Management')

@section('heading')
    {{ __('question_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('coach_question.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100 text-nowrap"><span>{{ __('new') }}</span></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:10%;">
                                <col style="width:15%;">
                                <col style="width:35%;">
                                <col style="width:35%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center align-middle">{{ __('ID') }}</th>
                                    <th class="text-center align-middle">{{ __('coach_type') }}</th>
                                    <th class="text-center align-middle">{{ __('coach_subject') }}</th>
                                    <th class="text-center align-middle">{{ __('coach_question') }}</th>
                                    <th class="text-center align-middle">{{ __('suggest_answer') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coach_questions as $coach_question)
                                    <tr>
                                        <td class="text-center"><a
                                                href="{{ route('coach_question.edit', $coach_question->id) }}">{{ $coach_question->id }}</a>
                                        </td>
                                        <td class="text-center"><a
                                                href="{{ route('coach_question.edit', $coach_question->id) }}">{{ $coach_question->type_name }}</a>
                                        </td>
                                        <td class="text-center"><a
                                                href="{{ route('coach_question.edit', $coach_question->id) }}">{{ $coach_question->subject_name }}</a>
                                        </td>
                                        <td class="text-center ck-content"><a
                                                href="{{ route('coach_question.edit', $coach_question->id) }}">{!! $coach_question->question !!}</a>
                                        </td>
                                        <td class="text-center ck-content"><a
                                                href="{{ route('coach_question.edit', $coach_question->id) }}">{!! $coach_question->suggest_answer !!}</a>
                                        </td>
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
                "responsive": true,
                "lengthChange": false,
                "pageLength": 25,
                "searching": true,
                "autoWidth": false,
                "ordering": true,
                "buttons": ["copy", "excel", "pdf", "print"],
                "language": {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

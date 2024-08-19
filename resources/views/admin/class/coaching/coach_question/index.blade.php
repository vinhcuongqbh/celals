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
                                        <td class="text-center">{{ $coach_question->id }}</td>
                                        <td class="text-center">{{ $coach_question->coach_type->type_name }}</td>
                                        <td class="text-center">{{ $coach_question->coach_subject->subject_name }}</td>
                                        <td class="text-left"><a
                                                href="{{ route('coach_question.edit', $coach_question->id) }}">
                                                <div class="ck-content">{!! $coach_question->question !!}</div>
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <div class="ck-content">{!! $coach_question->suggest_answer !!}</div>
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
@stop

@section('js')
    <script>
        $(function() {
            $("#table").DataTable({
                responsive: true,
                lengthChange: false,
                pageLength: 25,
                searching: true,
                autoWidth: false,
                ordering: true,
                dom: 'Bfrtip',
                buttons: [{
                    text: 'Tạo mới',
                    className: 'bg-olive',
                    action: function(e, dt, node, config) {
                        window.location = '{{ route('coach_question.create') }}';
                    },
                }, ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

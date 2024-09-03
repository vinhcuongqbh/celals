@extends('layouts.master')

@section('title', 'Lesson List')

@section('heading')
    {{ __('lesson_list') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-8">
                <div class="card card-default">
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:10%;">
                                <col style="width:60%;">
                                <col style="width:30%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Chủ đề bài nghe</th>
                                    <th class="text-center">Trình độ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lesson as $ls)
                                    <tr>
                                        <td class="text-center">{{ $ls->id }}</td>
                                        <td><a
                                                href="{{ route('listening.lesson_show', $ls->lesson_id) }}">{{ $ls->subject }}</a>
                                        </td>
                                        <td class="text-center">{{ $ls->level_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')  
@stop

@section('js')
    <script>
        $(function() {
            $("#data-table").DataTable({
                responsive: true,
                searching: true,
                ordering: true,
                pageLength: 15,
                autoWidth: false,
                lengthChange: false,
                dom: 'Bfrtip',
                buttons: [{
                        text: 'Tạo mới',
                        className: 'bg-olive',
                        action: function(e, dt, node, config) {
                            window.location = '{{ route('listening.lesson_create') }}';
                        },
                    },
                ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

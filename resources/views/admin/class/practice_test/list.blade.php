@extends('layouts.master')

@section('title', 'Test List')

@section('heading')
    {{ __('test_list') }}
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
                                    <th class="text-center">Chủ đề bài Test</th>
                                    <th class="text-center">Trình độ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($tests as $test)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td><a
                                                href="{{ route('practice_test.show', $test->test_id) }}">{{ $test->subject }}</a>
                                        </td>
                                        <td class="text-center">{{ $test->level->level_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
    <style>
        .col-xl-2 {
            width: 14.285%;
            flex: 0 0 14.285%;
            max-width: 14.285%;
        }
    </style>
@stop

@section('js')
    <script>
        $(function() {
            $("#data-table").DataTable({
                responsive: true,
                lengthChange: false,
                pageLength: 25,
                searching: true,
                autoWidth: false,
                ordering: false,
                dom: 'Bfrtip',
                buttons: [{
                    text: 'Tạo mới',
                    className: 'bg-olive',
                    action: function(e, dt, node, config) {
                        window.location = '{{ route('practice_test.create') }}';
                    },
                }, ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

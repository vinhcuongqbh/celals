@extends('layouts.master')

@section('title', 'Test List')

@section('heading')
    {{ __('Danh sách kỳ thi') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-default">
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:50%;">
                                <col style="width:15%;">
                                <col style="width:15%;">
                                <col style="width:15%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">ID</th>                                    
                                    <th class="text-center">Chủ đề bài Test</th>
                                    <th class="text-center">Trình độ</th>                                    
                                    <th class="text-center">Người tạo</th>
                                    <th class="text-center">Ngày tạo</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tests as $test)
                                    <tr>
                                        <td class="text-center">{{ $test->id }}</td>
                                        <td>
                                            <a href="{{ route('public_text.show', $test->public_test_id) }}">{{ $test->practice_test->subject }}</a>
                                        </td>
                                        {{-- <td class="text-center">{{ $test->public_test_level->level_name }}</td>--}}
                                        <td></td>
                                        <td class="aligned-middle text-center">{{ $test->user->name }}</td>
                                        <td class="aligned-middle text-center">{{ $test->created_at }}</td>
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

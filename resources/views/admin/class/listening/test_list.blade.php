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
                                <col style="width:5%;">
                                <col style="width:55%;">
                                <col style="width:20%;">
                                <col style="width:20%;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle text-center">Chủ đề bài Test</th>
                                    <th class="align-middle text-center">Trình độ</th>
                                    <th class="align-middle text-center">Hình thức</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tests as $test)
                                    <tr>
                                        <td class="text-center">{{ $test->id }}</td>
                                        <td>
                                            <a
                                                href="{{ route('listening.test_show', $test->test_id) }}">{{ $test->subject }}</a>
                                        </td>
                                        <td class="text-center">{{ $test->level->level_name }}</td>
                                        <td class="text-center">{{ $test->test_type->test_type_name }}</td>
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
                        window.location = '{{ route('listening.test_create') }}';
                    },
                }, ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

@extends('layouts.master')

@section('title', 'Thông tin Bài Kiểm tra')

@section('heading')
    Thông tin Bài Kiểm tra
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-9">
                <div class="card card-default">
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:50%;">
                                <col style="width:15%;">
                                <col style="width:15%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Họ và tên</th>
                                    <th class="text-center">Tuổi</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Giáo viên chấm bài</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($student_test_list as $data)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-left"><a
                                                href="{{ route('public_test.edit', [$data->public_test_id, $data->id]) }}">{{ $data->student_name }}</a>
                                        </td>
                                        <td class="text-center">{{ $data->student_age }}</td>
                                        <td class="text-center">{{ $data->student_tel }}</td>
                                        <td class="text-center">{{ $data->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="text-left text-danger col-sm-12 col-form-label">Link kiểm tra: </label>
                                <div class="col-sm-12">
                                    <a
                                        href="{{ url('/') . '/public_test/' . $test->public_test_id . '/testing' }}">{{ url('/') . '/public_test/' . $test->public_test_id . '/testing' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@endsection

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
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

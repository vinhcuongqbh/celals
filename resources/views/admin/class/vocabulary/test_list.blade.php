@extends('layouts.master')

@section('title', 'Thông tin Bài Kiểm tra')

@section('heading')
    Thông tin Bài Kiểm tra
@stop

@section('content')
    @if (session()->has('msg_success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: `{{ session()->get('msg_success') }}`,
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @elseif (session()->has('msg_error'))
        <script>
            Swal.fire({
                icon: 'error',
                text: `{{ session()->get('msg_error') }}`,
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-9">
                <div class="card card-default">
                    <div class="card-body">
                        <table id="table-create" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:20%;">
                                <col style="width:20%;">
                                <col style="width:20%;">
                                <col style="width:15%;">
                                <col style="width:20%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Mã bài kiểm tra</th>
                                    <th class="text-center">Trình độ</th>
                                    <th class="text-center">Chủ đề</th>
                                    <th class="text-center">Số lượng câu hỏi</th>
                                    <th class="text-center">Thời gian khởi tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($test != null)
                                    @php $i=1; @endphp
                                    @foreach ($test as $test)
                                        <tr>
                                            <td class="text-center">
                                                {{ $i++ }}
                                            </td>
                                            <td class="text-center"><a href="{{ route('vocabulary.test_show', $test->test_id) }}">{{ $test->test_id }}</a></td>
                                            <td class="text-center">{{ $test->level_name }}</td>
                                            <td></td>
                                            <td class="text-justify"></td>
                                            <td class="text-center">{{ $test->created_at }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

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
    <script>
        $(function() {
            $("#table-create").DataTable({
                lengthChange: false,
                pageLength: 20,
                searching: true,
                autoWidth: false,
                ordering: false,
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

@extends('layouts.master')

@section('title', 'Block Show')

@section('heading')
    Danh sách bài tự học
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="form-group row mb-0">
                            <div class="col-sm-2">
                                <label for="block_name">{{ __('block_name') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" id="block_name" name="block_name" value="{{ $block->block_name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                        
                        <table id="data-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:10%;">
                                <col style="width:90%;">
                            </colgroup>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($collection as $cl)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td><a href="
                                            @if ($cl['type_id'] == "L") {{ route('listening.student_lesson_show', $cl['question_id']) }} 
                                            @elseif ($cl['type_id'] == "T") {{ route('listening.student_test_create', $cl['question_id']) }} 
                                            @endif">{{ $cl['subject'] }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')   
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
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#data-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 25,
                "searching": true,
                "autoWidth": false,
                "ordering": false,
                "buttons": ["copy", "excel", "pdf", "print"],
                "language": {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
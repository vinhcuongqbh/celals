@extends('layouts.master')

@section('title', 'Block Show')

@section('heading')
    {{ __('block_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="form-group row mb-0">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-4">
                                <label for="level_id">{{ __('level') }}</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" id="level_id" name="level_id" value="{{ $block->level_name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-4">
                                <label for="block_name">{{ __('block_name') }}</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" id="block_name" name="block_name" value="{{ $block->block_name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
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
                                            @if ($cl['type_id'] == "L") {{ route('listening.lesson_show', $cl['question_id']) }} 
                                            @elseif ($cl['type_id'] == "T") {{ route('listening.test_show', $cl['question_id']) }} 
                                            @endif">{{ $cl['subject'] }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">        
                        <a class="btn bg-olive text-white text-nowrap col-2 m-1"
                            href="{{ route('listening.block_edit', $block->block_id) }}">{{ __('edit') }}</a>               
                        <a class="btn bg-primary text-white text-nowrap col-2 m-1"
                            href="{{ route('listening.block_list') }}">{{ __('back') }}</a>
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

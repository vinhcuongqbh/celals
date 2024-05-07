@extends('layouts.master')

@section('title', 'Block List')

@section('heading')
    {{ __('block_list') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('listening.block_create') }}"
                                    class="btn bg-olive text-white">{{ __('new') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session()->has('message'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            text: `{{ session()->get('message') }}`,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    </script>
                @endif

                <div class="card card-default">
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:95%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Tên Block</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($blocks as $block)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td><a
                                                href="{{ route('listening.block_show', $block->block_id) }}">{{ $block->block_name }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
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
        <style>
            .col-xl-2 {
                width: 14.285%;
                flex: 0 0 14.285%;
                max-width: 14.285%;
            }
        </style>

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

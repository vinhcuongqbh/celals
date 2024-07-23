@extends('layouts.master')

@section('title', 'Coach Subject Management')

@section('heading')
    {{ __('coach_subject_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('coach_subject.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100 text-nowrap"><span>{{ __('new') }}</span></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-body">    
                        <table id="table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:10%;">
                                <col style="width:90%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">{{ __('ID') }}</th>
                                    <th class="text-center">{{ __('subject_name') }}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coach_subjects as $coach_subject)
                                    <tr>
                                        <td class="text-center">{{ $coach_subject->id }}</td>                                
                                        <td><a href="{{ route('coach_subject.edit', $coach_subject->id) }}">{{ $coach_subject->subject_name }}</a></td>                                        
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
    <!-- DataTables -->
    <link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            $("#table").DataTable({
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
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

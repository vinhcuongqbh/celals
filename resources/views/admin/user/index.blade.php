@extends('layouts.master')

@section('title', 'User Management')

@section('heading')
    {{ __('user_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('user.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100 text-nowrap"><span>{{ __('new_user') }}</span></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-body">    
                        <table id="user-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:20%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:30%;">
                                <col style="width:10%;">                                
                                <col style="width:10%;">
                                <col style="width:5%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th>{{ __('user_id') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('user_name') }}</th>
                                    <th>{{ __('tel') }}</th>
                                    <th>{{ __('address') }}</th>                                    
                                    <th>{{ __('center_name') }}</th>
                                    <th>{{ __('user_role') }}</th>
                                    <th>{{ __('enable') }}/{{ __('disable') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td style="text-align: center">{{ $user->user_id }}</td>
                                        <td><a href="{{ route('user.show', $user->user_id) }}">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->user_name }}</td>
                                        <td style="text-align: center">{{ $user->tel }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->center_name }}</td>
                                        <td>{{ $user->role_name }}</td>                                        
                                        <td>
                                            @if ($user->user_status == 1)
                                                <a class="btn bg-danger text-white w-100 text-nowrap"
                                                    href="{{ route('user.delete', $user->user_id) }}"
                                                    onclick="return confirm('{{ __('disable_user') }}')">
                                                    {{ __('disable') }}
                                                </a>
                                            @else
                                                <a class="btn bg-olive text-white w-100 text-nowrap"
                                                    href="{{ route('user.restore', $user->user_id) }}"
                                                    onclick="return confirm('{{ __('enable_user') }}')">
                                                    {{ __('enable') }}
                                                </a>
                                            @endif
                                        </td>
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
            $("#user-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 25,
                "searching": true,
                "autoWidth": false,
                "ordering": false,
                "buttons": ["copy", "excel", "pdf", "print"],                
            }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

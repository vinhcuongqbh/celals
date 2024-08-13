@extends('layouts.master')

@section('title', 'Referral Management')

@section('heading')
    {{ __('referral_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-8">
                <div class="card card-default">
                    <div class="card-header">
                        <form action="{{ route('referral.referrer') }}" method="get" id="validate-form">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-2 my-1">
                                    <label for="{{ __('date_start') }}">{{ __('date_start') }}</label>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <input type="date" class="form-control" id="date_start" name="date_start"
                                        value="{{ $date_start }}">
                                </div>
                                <div class="col-12 col-sm-2 my-1">
                                    <label for="{{ __('date_end') }}">{{ __('date_end') }}</label>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <input type="date" class="form-control" id="date_end" name="date_end"
                                        value="{{ $date_end }}">
                                </div>
                                <div class="col-12 col-sm-auto">
                                    <button type="submit"
                                        class="btn bg-olive text-white w-100">{{ __('search') }}</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:35%;">
                                <col style="width:20%;">
                                <col style="width:20%;">
                                <col style="width:20%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center align-middle">{{ __('no') }}</th>
                                    <th class="text-center align-middle">{{ __('name') }}</th>
                                    <th class="text-center align-middle">{{ __('registed_customer') }}</th>
                                    <th class="text-center align-middle">{{ __('accepted_customer') }}</th>
                                    <th class="text-center align-middle">{{ __('accepted_ratio') }} (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($userRefs as $userRef)
                                    <tr>
                                        <td style="text-align: center">{{ $i++ }}</td>
                                        <td>
                                            @if ($userRef->user_id != null)
                                                <a
                                                    href="{{ route('user.show', $userRef->user_id) }}">{{ $userRef->name }}</a>
                                            @else
                                                Tự đăng ký
                                            @endif
                                        </td>
                                        <td style="text-align: center">{{ $userRef->total }}</td>
                                        <td style="text-align: center">{{ $userRef->acceptedCustomer }}</td>
                                        <td style="text-align: center">{{ $userRef->acceptedRatio }}</td>
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

@extends('layouts.master')

@section('title', 'Referral Management')

@section('heading')
    {{ __('referral_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <form action="{{ route('referral.customer') }}" method="get" id="validate-form">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-1 my-1">
                                    <label for="{{ __('date_start') }}">{{ __('date_start') }}</label>
                                </div>
                                <div class="col-12 col-sm-2">
                                    <input type="date" class="form-control" id="date_start" name="date_start"
                                        value="{{ $date_start }}">
                                </div>
                                <div class="col-12 col-sm-1 my-1">
                                    <label for="{{ __('date_end') }}">{{ __('date_end') }}</label>
                                </div>
                                <div class="col-12 col-sm-2">
                                    <input type="date" class="form-control" id="date_end" name="date_end"
                                        value="{{ $date_end }}">
                                </div>

                                <div class="col-12 col-sm-2">
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
                                <col style="width:20%;">
                                <col style="width:20%;">
                                <col style="width:20%;">
                                <col style="width:5%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-nowrap">{{ __('no') }}</th>
                                    <th class="text-nowrap">{{ __('advise_type_name') }}</th>
                                    <th class="text-nowrap">{{ __('name') }}</th>
                                    <th class="text-nowrap">{{ __('tel') }}</th>
                                    <th class="text-nowrap">{{ __('email') }}</th>
                                    <th class="text-nowrap">{{ __('age') }}</th>
                                    <th class="text-nowrap">{{ __('school') }}</th>
                                    <th class="text-nowrap">{{ __('ref_name') }}</th>
                                    <th class="text-nowrap">{{ __('ref_status_name') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($userRefs as $userRef)
                                    <tr>
                                        <td style="text-align: center">{{ $i++ }}</td>
                                        <td style="text-align: center">
                                            @if ($userRef->advise_type_id == 0)
                                                {{'Đăng ký học thử và Thi thử miễn phí'}}
                                            @else
                                                {{'Tư vấn du học'}}
                                            @endif
                                        </td>
                                        <td><a
                                                href="{{ route('referral.show', $userRef->id) }}">{{ $userRef->student_name }}</a>
                                        </td>
                                        <td style="text-align: center">{{ $userRef->student_tel }}</td>
                                        <td>{{ $userRef->student_email }}</td>
                                        <td style="text-align: center">{{ $userRef->student_age }}</td>
                                        <td style="text-align: center">{{ $userRef->student_school }}</td>
                                        <td style="text-align: center">
                                            @if (isset($userRef->user_id))
                                                <a href="{{ route('user.show', $userRef->user_id) }}">
                                                    {{ $userRef->name }}
                                                </a>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <a
                                                class="btn text-white w-100 text-nowrap @if ($userRef->ref_status_id == 1) bg-warning
                                            @elseif ($userRef->ref_status_id == 2) bg-primary
                                            @elseif ($userRef->ref_status_id == 3) bg-olive
                                            @elseif ($userRef->ref_status_id == 4) bg-danger @endif
                                            ">
                                                {{ $userRef->ref_status_name }}
                                            </a>
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

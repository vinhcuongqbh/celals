@extends('layouts.master')

@section('title', 'Post Management')

@section('heading')
    {{ __('post_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <form action="{{ route('post.search') }}" method="get" id="validate-form">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-2">
                                    <a href="{{ route('post.create') }}"
                                        class="btn bg-olive text-white">{{ __('new_post') }}</a>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
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
                                <col style="width:50%;">
                                <col style="width:15%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-nowrap">{{ __('post_id') }}</th>
                                    <th class="text-nowrap">{{ __('post_title') }}</th>
                                    <th class="text-nowrap">{{ __('post_catalogue') }}</th>
                                    <th class="text-nowrap">{{ __('post_author') }}</th>
                                    <th class="text-nowrap">{{ __('post_status') }}</th>
                                    <th class="text-nowrap">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td style="text-align:center">{{ $post->post_id }}</td>
                                        <td><a href="{{ route('post.edit', $post->post_id) }}">{{ $post->post_title }}</a>
                                        </td>
                                        <td style="text-align:center">{{ $post->post_catalogue_name }}</td>
                                        <td style="text-align:center">{{ $post->name }}</td>
                                        <td style="text-align:center">{{ $post->post_status }}</td>
                                        <td style="text-align:center">
                                            <div class="d-flex justify-content-center">
                                                @if ($post->post_status == 0)
                                                    <a class="w-100 m-1 btn bg-success text-white text-nowrap"
                                                        href="{{ route('post.public', $post->post_id) }}">{{ __('public') }}
                                                    </a>
                                                @else
                                                    <a class="w-100 m-1 btn bg-warning text-white text-nowrap"
                                                        href="{{ route('post.unpublic', $post->post_id) }}">{{ __('unpublic') }}
                                                    </a>
                                                @endif
                                                <a class="w-100 m-1 btn bg-danger text-white text-nowrap destroyedPost"
                                                    href="{{ route('post.destroy', $post->post_id) }}">{{ __('destroy') }}
                                                </a>
                                            </div>
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

    <script>
        document.querySelector(".destroyedPost").addEventListener('click', function() {
            event.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: "Xóa bài viết?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Xóa",
                denyButtonText: "Không"
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });
    </script>
@stop

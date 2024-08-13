@extends('layouts.master')

@section('title', 'Post Management')

@section('heading')
    {{ __('post_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                                    <th class="text-center align-middle">{{ __('ID') }}</th>
                                    <th class="text-center align-middle">{{ __('post_title') }}</th>
                                    <th class="text-center align-middle">{{ __('post_catalogue') }}</th>
                                    <th class="text-center align-middle">{{ __('post_author') }}</th>
                                    <th class="text-center align-middle">{{ __('post_status') }}</th>
                                    <th class="text-center align-middle">{{ __('action') }}</th>
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
                                                    <a class="w-100 m-1 btn bg-olive text-white text-nowrap"
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
    <style>
        .col-xl-2 {
            width: 14.285%;
            flex: 0 0 14.285%;
            max-width: 14.285%;
        }
    </style>
@stop

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
                dom: 'Bfrtip',
                buttons: [{
                        text: 'Tạo mới',
                        className: 'bg-olive',
                        action: function(e, dt, node, config) {
                            window.location = '{{ route('post.create') }}';
                        },
                    },
                    {
                        extend: 'spacer',
                        style: 'bar',
                        text: 'Xuất:'
                    },
                    'excel',
                    'pdf',
                ],
                language: {
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

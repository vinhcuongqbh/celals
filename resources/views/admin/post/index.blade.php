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
                                    <th class="align-middle text-center">{{ __('ID') }}</th>
                                    <th class="align-middle text-center">{{ __('post_title') }}</th>
                                    <th class="align-middle text-center">{{ __('post_catalogue') }}</th>
                                    <th class="align-middle text-center">{{ __('post_author') }}</th>
                                    <th class="align-middle text-center">{{ __('post_status') }}</th>
                                    <th class="align-middle text-center">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="text-center">{{ $post->post_id }}</td>
                                        <td>
                                            <a href="{{ route('post.edit', $post->post_id) }}">{{ $post->post_title }}</a>
                                        </td>
                                        <td class="text-center">{{ $post->catalogue->post_catalogue_name }}</td>
                                        <td class="text-center">{{ $post->user->name }}</td>
                                        <td class="text-center">{{ $post->post_status }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                @if ($post->post_status == 0)
                                                    <a class="btn bg-primary col-sm-6 m-1"
                                                        href="{{ route('post.public', $post->post_id) }}">{{ __('public') }}
                                                    </a>
                                                @else
                                                    <a class="btn bg-secondary col-sm-6 m-1"
                                                        href="{{ route('post.unpublic', $post->post_id) }}">{{ __('unpublic') }}
                                                    </a>
                                                @endif
                                                <a class="btn bg-danger col-sm-6 m-1 destroyedPost"
                                                    href="{{ route('post.destroy', $post->post_id) }}">{{ __('destroy') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $(function() {
            $("#data-table").DataTable({
                responsive: true,
                searching: true,
                ordering: false,                
                pageLength: 15,
                lengthChange: false,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [{
                    text: 'Tạo mới',
                    className: 'bg-olive',
                    action: function(e, dt, node, config) {
                        window.location = '{{ route('post.create') }}';
                    },
                }, ],
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

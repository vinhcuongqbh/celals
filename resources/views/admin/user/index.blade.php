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
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">{{ __('user_id') }}</th>
                                    <th class="text-center align-middle">{{ __('name') }}</th>
                                    <th class="text-center align-middle">{{ __('user_name') }}</th>
                                    <th class="text-center align-middle">{{ __('tel') }}</th>
                                    <th class="text-center align-middle">{{ __('address') }}</th>
                                    <th class="text-center align-middle">{{ __('center_name') }}</th>
                                    <th class="text-center align-middle">{{ __('user_role') }}</th>
                                    <th class="text-center align-middle">{{ __('enable') }}/{{ __('disable') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td><a href="{{ route('user.show', $user->user_id) }}">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->user_name }}</td>
                                        <td class="text-center">{{ $user->tel }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td class="text-center">{{ $user->center->center_name }}</td>
                                        <td class="text-center">{{ $user->role->role_name }}</td>
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
            $("#user-table").DataTable({
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
                            window.location = '{{ route('user.create') }}';
                        },
                    },
                ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

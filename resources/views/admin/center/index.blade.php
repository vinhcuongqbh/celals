@extends('layouts.master')

@section('title', 'Center Management')

@section('heading')
    {{ __('center_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">               
                <div class="card card-default">
                    <div class="card-body">
                        <table id="center-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:25%;">
                                <col style="width:65%;">
                                <col style="width:5%;">                                
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">{{ __('ID') }}</th>                                    
                                    <th class="text-center align-middle">{{ __('center_name') }}</th>                                    
                                    <th class="text-center align-middle">{{ __('address') }}</th>
                                    <th class="text-center align-middle">{{ __('enable') }}/{{ __('disable') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($centers as $center)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td><a href="{{ route('center.show', $center->center_id) }}">{{ $center->center_name }}</a></td>
                                        <td>{{ $center->center_address }}</td>
                                        <td>
                                            @if ($center->center_status == 1)
                                                <a class="btn bg-danger text-white w-100 text-nowrap"
                                                    href="{{ route('center.delete', $center->center_id) }}"
                                                    onclick="return confirm('{{ __('disable_center') }}')">
                                                    {{ __('disable') }}
                                                </a>
                                            @else
                                                <a class="btn bg-olive text-white w-100 text-nowrap"
                                                    href="{{ route('center.restore', $center->center_id) }}"
                                                    onclick="return confirm('{{ __('enable_center') }}')">
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
            $("#center-table").DataTable({
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
                            window.location = '{{ route('center.create') }}';
                        },
                    },
                ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#center-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

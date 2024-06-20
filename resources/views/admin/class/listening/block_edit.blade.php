@extends('layouts.master')

@section('title', 'Block Edit')

@section('heading')
    {{ __('block_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="card card-default">
                    <form action="{{ route('listening.block_edit', $block->block_id) }}" method="get">
                        <div class="card-header">
                            <div class="form-group row mb-0">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-4">
                                    <label for="level">{{ __('level') }}</label>
                                </div>
                                <div class="col-sm-7">
                                    <select id="level_id" name="level_id" class="form-control custom-select"
                                        onchange="this.form.submit()">
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->level_id }}"
                                                @if (!isset($level_id_selected) and $block->level_id == $level->level_id) selected 
                                                @elseif (isset($level_id_selected) and $level_id_selected == $level->level_id) selected @endif>
                                                {{ $level->level_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('listening.block_update', $block->block_id) }}" method="post" id="form-validate"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="level_id"
                                value="@php if (isset($level_id_selected)) echo $level_id_selected;
                            else echo $block->level_id; @endphp">
                            <div class="form-group row">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-4">
                                    <label for="block_name">{{ __('block_name') }}</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" id="block_name" name="block_name" value="{{ $block->block_name }}"
                                        class="form-control">
                                </div>
                            </div>
                            @php
                                $i = 1;
                                $j = 1;
                            @endphp
                            @foreach ($collection as $cl)
                                <div class="form-group row">
                                    <div class="col-sm-1">
                                        <label for="stt">{{ $i }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <select id="type_id_{{ $i }}" name="type_id_{{ $i }}"
                                            class="form-control custom-select">
                                            <option value="L" @if ($cl['type_id'] == 'L') selected @endif>Bài
                                                nghe</option>
                                            <option value="T" @if ($cl['type_id'] == 'T') selected @endif>Bài
                                                test</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" id="stt_{{ $i }}" name="stt_{{ $i }}"
                                            value="{{ $cl['question_id'] }}" class="form-control">
                                    </div>
                                </div>
                                @php $i++ @endphp
                            @endforeach
                            @if ($i < 15)
                                @for ($j = $i; $j <= 15; $j++)
                                    <div class="form-group row">
                                        <div class="col-sm-1">
                                            <label for="stt">{{ $j }}</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="type_id_{{ $j }}" name="type_id_{{ $j }}"
                                                class="form-control custom-select">
                                                <option value="L">Bài nghe</option>
                                                <option value="T">Bài test</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" id="stt_{{ $j }}"
                                                name="stt_{{ $j }}" value="{{ old('stt_' . $j) }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-olive text-nowrap m-1">{{ __('update') }}</button>
                            <a class="btn bg-primary text-white text-nowrap col-2 m-1"
                                href="{{ route('listening.block_list') }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
            <div class="col-12 col-sm-4">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('lesson_list') }}</h3>
                    </div>
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped data-table">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:95%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Chủ đề</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($lessons))
                                    @foreach ($lessons as $lesson)
                                        <tr>
                                            <td class="text-center">{{ $lesson->id }}</td>
                                            <td>{{ $lesson->subject }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('test_list') }}</h3>
                    </div>
                    <div class="card-body">
                        <table id="data-table2" class="table table-bordered table-striped data-table">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:95%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Chủ đề</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($tests))
                                    @foreach ($tests as $test)
                                        <tr>
                                            <td class="text-center">{{ $test->id }}</td>
                                            <td>{{ $test->subject }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .holder {
            width: 100%;
        }

        #imgPreview {
            max-width: 100%;
        }
    </style>
@endsection

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#form-validate').validate({
                rules: {
                    level_id: {
                        required: true,
                    },
                    block_name: {
                        required: true,
                    },
                },
                messages: {
                    level_id: {
                        required: "{{ __('selectContent') }}",
                    },
                    block_name: {
                        required: "{{ __('enterContent') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-7').append(error);

                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

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
            $(".data-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "searching": true,
                "autoWidth": false,
                ordering: false,
                paging: false,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 500,
                "bInfo" : false,
                "buttons": ["copy", "excel", "pdf", "print"],
                "language": {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

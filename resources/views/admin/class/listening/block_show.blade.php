@extends('layouts.master')

@section('title', 'Block Show')

@section('heading')
    {{ __('block_management') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-xl-4">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="form-group row mb-0">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-4">
                                <label for="level_id">{{ __('level') }}</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" id="level_id" name="level_id" value="{{ $block->level_name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-4">
                                <label for="block_name">{{ __('block_name') }}</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" id="block_name" name="block_name" value="{{ $block->block_name }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <table id="data-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:10%;">
                                <col style="width:90%;">
                            </colgroup>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($collection as $cl)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td><a href="
                                            @if ($cl['type_id'] == "L") {{ route('listening.lesson_show', $cl['question_id']) }} 
                                            @elseif ($cl['type_id'] == "T") {{ route('listening.test_show', $cl['question_id']) }} 
                                            @endif">{{ $cl['subject'] }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">        
                        <a class="btn bg-warning text-white text-nowrap col-2 m-1"
                            href="{{ route('listening.block_edit', $block->block_id) }}">{{ __('edit') }}</a>               
                        <a class="btn bg-olive text-white text-nowrap col-2 m-1"
                            href="{{ route('listening.block_list') }}">{{ __('back') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card -->
            {{-- <div class="col-xl-4">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('lesson_list') }}</h3>
                    </div>
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped">
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
                                @foreach ($lessons as $lesson)
                                    <tr>
                                        <td class="text-center">{{ $lesson->id }}</td>
                                        <td>{{ $lesson->subject }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('test_list') }}</h3>
                    </div>
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped">
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
                                @foreach ($tests as $test)
                                    <tr>
                                        <td class="text-center">{{ $test->id }}</td>
                                        <td>{{ $test->subject }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
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
                    block_name: {
                        required: true,
                    },
                },
                messages: {
                    block_name: {
                        required: "{{ __('enterContent') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-9').append(error);

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

    <!-- IMG Preview -->
    <script>
        $(document).ready(() => {
            $('#link_question').change(function() {
                const file = this.files[0];
                console.log(file);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $('#imgPreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    <!-- Hiển thị tên file khi được upload -->
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

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

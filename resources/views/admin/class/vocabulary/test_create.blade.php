@extends('layouts.master')

@section('title', 'Tạo mới Bài Kiểm tra')

@section('heading')
    Tạo mới Bài Kiểm tra
@stop

@section('content')
    @if (session()->has('msg_success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: `{{ session()->get('msg_success') }}`,
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @elseif (session()->has('msg_error'))
        <script>
            Swal.fire({
                icon: 'error',
                text: `{{ session()->get('msg_error') }}`,
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-9">
                <div class="card card-default">
                    <form action="{{ route('vocabulary.test_store') }}" method="post" id="form-store">
                        @csrf
                        <div class="card-body">
                            <table id="table-create" class="table table-bordered table-striped">
                                <colgroup>
                                    <col style="width:5%;">
                                    <col style="width:20%;">
                                    <col style="width:5%;">
                                    <col style="width:15%;">
                                    <col style="width:30%;">
                                    <col style="width:20%;">
                                </colgroup>
                                <thead style="text-align: center">
                                    <tr>
                                        <th class="align-middle text-center">Chọn</th>
                                        <th class="align-middle text-center">Từ vựng</th>
                                        <th class="align-middle text-center">Từ loại</th>
                                        <th class="align-middle text-center">Phát âm</th>
                                        <th class="align-middle text-center">Dịch nghĩa</th>
                                        <th class="align-middle text-center">Chủ đề</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @if ($word != null)
                                        @foreach ($word as $word)
                                            <tr>
                                                <td class="text-center">
                                                    <div>
                                                        <input type="checkbox" id="{{ $word->word_id }}"
                                                            value="{{ $word->word_id }}" name="word_selected_id[]"
                                                            @php $i++; if (($select_mode == 'automatic_select')&&($i <= 20)) echo "checked" @endphp>
                                                    </div>
                                                </td>
                                                <td>{{ $word->word }}</td>
                                                <td class="text-center">{{ $word->word_type_name }}</td>
                                                <td>{{ $word->spelling }}</td>
                                                <td class="text-justify">{{ $word->word_meaning }}</td>
                                                <td class="text-center">{{ $word->topic_name }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                            <label class="text-right text-danger col-3" id="error"></label>
                            <button type="submit" class="btn bg-olive text-nowrap">Tạo Bài KT</button><br>
                        </div>


                        <input type="hidden" name="level_id_selected"
                            value="@php if (isset($level_id_selected)) echo $level_id_selected; else echo "0"; @endphp">
                        <input type="hidden" name="topic_id_1_selected"
                            value="@php if (isset($topic_id_1_selected)) echo $topic_id_1_selected; else echo "0"; @endphp">
                        <input type="hidden" name="topic_id_2_selected"
                            value="@php if (isset($topic_id_2_selected)) echo $topic_id_2_selected; else echo "0"; @endphp">
                        <input type="hidden" name="topic_id_3_selected"
                            value="@php if (isset($topic_id_3_selected)) echo $topic_id_3_selected; else echo "0"; @endphp">
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-sm-3">
                <div class="col-12">
                    <div class="card card-default">
                        <form action="{{ route('vocabulary.test_search') }}" method="post" id="form-search">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="level_id">Trình độ</label>
                                    <div class="col-sm-9">
                                        <select id="level_id" name="level_id" class="form-control custom-select">
                                            <option selected></option>
                                            @foreach ($level as $level)
                                                <option value="{{ $level->level_id }}"
                                                    @if (isset($level_id_selected) && $level_id_selected == $level->level_id) selected @endif>
                                                    {{ $level->level_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="topic_id_1">Chủ đề 1</label>
                                    <div class="col-sm-9">
                                        <select id="topic_id_1" name="topic_id_1" class="form-control custom-select">
                                            <option selected></option>
                                            @foreach ($topic as $topic)
                                                <option value="{{ $topic->topic_id }}"
                                                    @if (isset($topic_id_1_selected) && $topic_id_1_selected == $topic->topic_id) selected @endif>
                                                    {{ $topic->topic_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="topic_id_2">Chủ đề 2</label>
                                    <div class="col-sm-9">
                                        <select id="topic_id_2" name="topic_id_2" class="form-control custom-select">
                                            <option selected></option>
                                            @foreach ($topic2 as $topic2)
                                                <option value="{{ $topic2->topic_id }}"
                                                    @if (isset($topic_id_2_selected) && $topic_id_2_selected == $topic2->topic_id) selected @endif>
                                                    {{ $topic2->topic_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="topic_id_3">Chủ đề 3</label>
                                    <div class="col-sm-9">
                                        <select id="topic_id_3" name="topic_id_3" class="form-control custom-select">
                                            <option selected></option>
                                            @foreach ($topic3 as $topic3)
                                                <option value="{{ $topic3->topic_id }}"
                                                    @if (isset($topic_id_3_selected) && $topic_id_3_selected == $topic3->topic_id) selected @endif>
                                                    {{ $topic3->topic_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer d-flex justify-content-center">
                                <button type="submit" class="btn bg-olive text-nowrap mx-2" name="select"
                                    value="manual_select">Chọn thủ công</button>
                                <button type="submit" class="btn bg-olive text-nowrap mx-2" name="select"
                                    value="automatic_select">Chọn tự động</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group row h4 m-0">
                                <label class="text-center text-danger col-sm-12 col-form-label" id="count">0</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
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
@endsection

@section('js')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
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

    {{-- <script src="/js/jquery-3.7.0.js"></script> --}}
    {{-- <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.buttons.min.js"></script>
    <script src="/js/jszip.min.js"></script>
    <script src="/js/pdfmake.min.js"></script>
    <script src="/js/vfs_fonts.js"></script>
    <script src="/js/buttons.html5.min.js"></script>
    <script src="/js/buttons.print.min.js"></script>
    <script src="/js/dataTables.rowReorder.min.js"></script>
    <script src="/js/dataTables.responsive.min.js"></script>

    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="/css/responsive.dataTables.min.css"> --}}

    <!-- Page specific script -->
    <script>
        $(function() {
            $('#form-search').validate({
                rules: {
                    level_id: {
                        required: true,
                    },
                    topic_id_1: {
                        required: true,
                    },
                },
                messages: {
                    level_id: {
                        required: "Vui lòng chọn thông tin",
                    },
                    topic_id_1: {
                        required: "Vui lòng chọn thông tin",
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
    <script>
        $(function() {
            $('#form-store').validate({
                rules: {
                    'word_selected_id[]': {
                        required: true,
                    },
                },
                messages: {
                    'word_selected_id[]': {
                        required: "Chọn ít nhất một từ vựng",
                    }
                },
                errorLabelContainer: '#error',
            });
        });
    </script>
    <script>
        $(function() {
            $("#table-create").DataTable({
                lengthChange: false,
                pageLength: 20,
                searching: true,
                autoWidth: false,
                ordering: false,
                paging: false,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 500,
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        var count = 0;
        count = $('input[name="word_selected_id[]"]:checked').length;
        $('#count').html("Số từ vựng đã chọn: " + count);

        $('input[type=checkbox]').click(function() {
            if ($(this).is(':checked')) {
                count = count + 1;
            } else {
                count = count - 1;
            }
            $('#count').html("Số từ vựng đã chọn: " + count);
        });
        //$('input[name="word_selected_id[]"]:checked').length;
    </script>
@stop

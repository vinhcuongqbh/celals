@extends('layouts.master')

@section('title', 'Thông tin Bài Kiểm tra')

@section('heading')
    Thông tin Bài Kiểm tra
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
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Từ vựng</th>
                                    <th class="text-center">Từ loại</th>
                                    <th class="text-center">Phát âm</th>
                                    <th class="text-center">Dịch nghĩa</th>
                                    <th class="text-center">Chủ đề</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($word != null)
                                    @php $i=1; @endphp
                                    @foreach ($word as $word)
                                        <tr>
                                            <td class="text-center">
                                                {{ $i++ }}
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
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-sm-3">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="level_id">Trình độ</label>
                                <div class="col-sm-9">
                                    <select id="level_id" name="level_id" class="form-control custom-select" disabled>
                                        <option value="{{ $level->level_id }}">
                                            {{ $level->level_name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="topic_id_1">Chủ đề 1</label>
                                <div class="col-sm-9">
                                    <select id="topic_id_1" name="topic_id_1" class="form-control custom-select" disabled>
                                        <option
                                            value="@php if (isset($topic[0]['topic_id'])) echo $topic[0]['topic_id']; @endphp">
                                            @php
                                                if (isset($topic[0]['topic_id'])) {
                                                    echo $topic[0]['topic_name'];
                                                }
                                            @endphp
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="topic_id_2">Chủ đề 2</label>
                                <div class="col-sm-9">
                                    <select id="topic_id_2" name="topic_id_2" class="form-control custom-select" disabled>
                                        <option
                                            value="@php if (isset($topic[1]['topic_id'])) echo $topic[1]['topic_id']; @endphp">
                                            @php
                                                if (isset($topic[1]['topic_id'])) {
                                                    echo $topic[1]['topic_name'];
                                                }
                                            @endphp
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="topic_id_3">Chủ đề 3</label>
                                <div class="col-sm-9">
                                    <select id="topic_id_3" name="topic_id_3" class="form-control custom-select" disabled>
                                        <option
                                            value="@php if (isset($topic[2]['topic_id'])) echo $topic[2]['topic_id']; @endphp">
                                            @php
                                                if (isset($topic[2]['topic_id'])) {
                                                    echo $topic[2]['topic_name'];
                                                }
                                            @endphp
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="text-left text-danger col-sm-12 col-form-label">Link học:</label>
                                <div class="col-sm-12">
                                    <a href="{{ url('/') . '/test/' . $test->test_id . '/studing' }}">{{ url('/') . '/test/' . $test->test_id . '/studing' }}</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-left text-danger col-sm-12 col-form-label">Link kiểm tra: </label>
                                <div class="col-sm-12">
                                    <a
                                        href="{{ url('/') . '/test/' . $test->test_id . '/testing' }}">{{ url('/') . '/test/' . $test->test_id . '/testing' }}</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-left text-danger col-sm-12 col-form-label">Link
                                    xếp hạng: </label>
                                <div class="col-sm-12">
                                    <a
                                        href="{{ url('/') . '/test/' . $test->test_id . '/ranking' }}">{{ url('/') . '/test/' . $test->test_id . '/ranking' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection

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
    <script>
        $(function() {
            $("#table-create").DataTable({
                lengthChange: false,
                pageLength: 20,
                searching: true,
                autoWidth: false,
                ordering: false,
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

@extends('layouts.master2')

@section('title', 'CELALS')

@section('content')
    <div class="container-fluid">
        <div class="row" style="padding: 50px 10px; display: flex; align-items: center; justify-content: center;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                <h3>Bài học về chủ đề: @php
                    if (isset($topic[0]['topic_id'])) {
                        echo $topic[0]['topic_name'];
                    }
                    if (isset($topic[1]['topic_id'])) {
                        echo ', ' . $topic[1]['topic_name'];
                    }
                    if (isset($topic[2]['topic_id'])) {
                        echo ', ' . $topic[2]['topic_name'];
                    }
                @endphp</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="width: 100%">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-sm-9">
                                            <div class="card card-default">
                                                <div class="card-body p-0">
                                                    <table id="table-create"
                                                        class="table table-bordered table-striped m-0 p-0">
                                                        <colgroup>
                                                            <col style="width:5%;">
                                                            <col style="width:35%;">
                                                            <col style="width:20%;">
                                                            <col style="width:20%;">
                                                            <col style="width:20%;">
                                                        </colgroup>
                                                        <thead style="text-align: center">
                                                            <tr>
                                                                <th class="text-center">STT</th>
                                                                <th class="text-center">Họ và tên</th>
                                                                <th class="text-center">Kết quả</th>
                                                                <th class="text-center">Đánh giá</th>                                                                
                                                                <th class="text-center">Chi tiết bài làm</th>    
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($ranking != null)
                                                                @php $i=1; @endphp
                                                                @foreach ($ranking as $ranking)
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            {{ $i++ }}
                                                                        </td>
                                                                        <td class="text-justify">
                                                                            {{ $ranking->name }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $ranking->right_answer }}/{{ $ranking->total_question }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            @php
                                                                                if ($ranking->pass == 1) {
                                                                                    echo 'Đạt';
                                                                                } else {
                                                                                    echo 'Chưa đạt';
                                                                                }
                                                                            @endphp
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="{{ route('test.result.show', $ranking->test_answer_id) }}">{{ $ranking->test_answer_id }}</a>
                                                                        </td>
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
                                            {{-- <div class="col-12">
                                                <div class="card card-default">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" for="level_id">Trình
                                                                độ</label>
                                                            <div class="col-sm-9">
                                                                <select id="level_id" name="level_id"
                                                                    class="form-control custom-select" disabled>
                                                                    <option value="{{ $level->level_id }}">
                                                                        {{ $level->level_name }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" for="topic_id_1">Chủ đề
                                                                1</label>
                                                            <div class="col-sm-9">
                                                                <select id="topic_id_1" name="topic_id_1"
                                                                    class="form-control custom-select" disabled>
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
                                                            <label class="col-sm-3 col-form-label" for="topic_id_2">Chủ đề
                                                                2</label>
                                                            <div class="col-sm-9">
                                                                <select id="topic_id_2" name="topic_id_2"
                                                                    class="form-control custom-select" disabled>
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
                                                            <label class="col-sm-3 col-form-label" for="topic_id_3">Chủ đề
                                                                3</label>
                                                            <div class="col-sm-9">
                                                                <select id="topic_id_3" name="topic_id_3"
                                                                    class="form-control custom-select" disabled>
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
                                            </div> --}}
                                            <div class="col-12">
                                                <div class="card card-default">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label
                                                                class="text-left text-danger col-sm-12 col-form-label">Link
                                                                học:</label>
                                                            <div class="col-sm-12">
                                                                <a
                                                                    href="{{ url('/') . '/test/' . $test->test_id . '/studing' }}">{{ url('/') . '/test/' . $test->test_id . '/studing' }}</a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="text-left text-danger col-sm-12 col-form-label">Link
                                                                kiểm tra: </label>
                                                            <div class="col-sm-12">
                                                                <a
                                                                    href="{{ url('/') . '/test/' . $test->test_id . '/testing' }}">{{ url('/') . '/test/' . $test->test_id . '/testing' }}</a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="text-left text-danger col-sm-12 col-form-label">Link
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop

@section('css')
@stop

@section('js')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(function() {
            $('#form-validate').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    age: {
                        required: true,
                    },
                    tel: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập thông tin",
                    },
                    age: {
                        required: "Vui lòng nhập thông tin",
                    }
                    tel: {
                        required: "Vui lòng nhập thông tin",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-12').append(error);

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
@stop

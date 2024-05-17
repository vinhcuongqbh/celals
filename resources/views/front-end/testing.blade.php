@extends('layouts.master2')

@section('title', 'CELALS')

@section('content')
    <form action="{{ route('test.testing.store') }}" method="post" id="form">
        @csrf
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
                                    <div class="row">
                                        <div class="col-12 col-sm-9">
                                            <div class="card card-default">
                                                <div class="card-body p-1">
                                                    <div class="">
                                                        <label for="">Danh sách từ vựng trong bài</label>
                                                    </div>
                                                    <div class="row m-0">
                                                        @foreach ($word as $w)
                                                            <button id="cb{{ $w->word_id }}" type="button"
                                                                class="btn col-3 col-sm-2 p-1 border"
                                                                onclick="copyText(this.id)">{{ $w->word }}</button>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <table id="table-create"
                                                        class="table table-bordered table-striped m-0 p-0">
                                                        <colgroup>
                                                            <col style="width:5%;">
                                                            <col style="width:45%;">
                                                            <col style="width:45%;">
                                                            <col style="width:5%;">
                                                        </colgroup>
                                                        <thead style="text-align: center">
                                                            <tr>
                                                                <th class="text-center">STT</th>
                                                                <th class="text-center">Dịch nghĩa</th>
                                                                <th class="text-center">Từ vựng</th>
                                                                <th class="text-center">Dán</th>
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
                                                                        <td class="text-justify">
                                                                            {{ $word->word_meaning }}
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="{{ $word->word_id }}"
                                                                                name="w{{ $word->word_id }}"
                                                                                class="form-control">
                                                                        </td>
                                                                        <td><button type="button"
                                                                                id="pb{{ $word->word_id }}"
                                                                                class="btn btn-secondary"
                                                                                onclick="pasteText(this.id)">Dán</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <input type="hidden" name="test_id" value="{{ $test_id }}">
                                            <input type="hidden" name="word_id_array"
                                                value="@php foreach ($word2 as $value) echo $value->word_id.","; @endphp">
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="col-12">
                                                <div class="card card-default">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label class="text-left col-sm-12 col-form-label">Họ và
                                                                tên:</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="text-left col-sm-12 col-form-label">Độ
                                                                tuổi</label>
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" name="age"
                                                                    id="age">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="text-left col-sm-12 col-form-label">Điện
                                                                thoại</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="tel"
                                                                    id="tel">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer d-flex justify-content-end">
                                                        <button type="submit"
                                                            class="btn bg-olive text-nowrap col-4 col-xl-6">Nộp Bài
                                                        </button><br>
                                                    </div>
                                                </div>
                                            </div>
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
        </div><!-- /.container-fluid -->
    </form>
@stop

@section('css')
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 140px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 150%;
            left: 50%;
            margin-left: -75px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#form').validate({
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
                        required: "{{ __('enterContent') }}",
                    },
                    age: {
                        required: "{{ __('enterContent') }}",
                    },
                    tel: {
                        required: "{{ __('enterContent') }}",
                    },
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

    <script>
        function copyText(clicked_id) {
            // Get the text field
            var copyText = document.getElementById(clicked_id);
            copyText.className = 'btn btn-primary col-3 col-sm-2 p-1 border';

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.innerText);

            setTimeout(function() {
                copyText.className = 'btn bg-white col-3 col-sm-2 p-1 border';
            }, 500);
        }

        function pasteText(clicked_id) {

            clicked_id = clicked_id.replace("pb", "");
            // Get the text field
            var pasteText = document.getElementById(clicked_id);

            // Copy the text inside the text field
            navigator.clipboard.readText().then((clipText) => (pasteText.value = clipText));
        }
    </script>
@stop

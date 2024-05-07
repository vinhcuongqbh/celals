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
                        echo ", ".$topic[1]['topic_name'];
                    }
                    if (isset($topic[2]['topic_id'])) {
                        echo ", ".$topic[2]['topic_name'];
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
                                                            <col style="width:20%;">
                                                            <col style="width:5%;">
                                                            <col style="width:15%;">
                                                            <col style="width:30%;">
                                                        </colgroup>
                                                        <thead style="text-align: center">
                                                            <tr>
                                                                <th class="text-center">STT</th>
                                                                <th class="text-center">Từ vựng</th>
                                                                <th class="text-center">Từ Loại</th>
                                                                <th class="text-center">Phát âm</th>
                                                                <th class="text-center">Dịch nghĩa</th>
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
                                                                        <td class="text-center">{{ $word->word_type_name }}
                                                                        </td>
                                                                        <td>{{ $word->spelling }}</td>
                                                                        <td class="text-justify">{{ $word->word_meaning }}
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
                                                                class="text-left text-danger col-sm-12 col-form-label">Link  học:</label>
                                                            <div class="col-sm-12">
                                                                <a
                                                                    href="{{ url('/') ."/test/". $test->test_id."/studing" }}">{{ url('/') ."/test/". $test->test_id."/studing" }}</a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="text-left text-danger col-sm-12 col-form-label">Link kiểm tra: </label>
                                                            <div class="col-sm-12">
                                                                <a
                                                                    href="{{ url('/') ."/test/". $test->test_id."/testing" }}">{{ url('/') ."/test/". $test->test_id."/testing" }}</a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="text-left text-danger col-sm-12 col-form-label">Link
                                                                xếp hạng: </label>
                                                            <div class="col-sm-12">
                                                                <a
                                                                    href="{{ url('/') ."/test/". $test->test_id."/ranking" }}">{{ url('/') ."/test/". $test->test_id."/ranking" }}</a>
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

@section('js')
@stop

@section('css')
@stop

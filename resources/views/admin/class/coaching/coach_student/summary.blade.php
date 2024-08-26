@extends('layouts.master')

@section('title', 'Coach Phỏng vấn')

@section('heading')
    {{ __('Coach Phỏng vấn') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card card-default">
                    <form action="{{ route('coaching.coach_student.summary') }}" method="post" id="form">
                        @csrf
                        <div class="card-header">
                            <div class="row">
                                <div class="form-group row">
                                    <div class="col-auto">
                                        <label class="col-form-label" for="student_id">{{ __('student') }}</label>
                                    </div>
                                    <div class="col-auto">
                                        <select id="student_id" name="student_id" class="form-control custom-select"
                                            onchange="this.form.submit()">
                                            <option value="0" selected></option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->user_id }}"
                                                    @if ($student->user_id == $selected_student) selected @endif>
                                                    {{ $student->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @if ($selected_student > 0)
                    <div class="card card-default">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <colgroup>
                                    <col style="width:10%;">
                                    <col style="width:50%;">
                                    <col style="width:40%;">
                                </colgroup>
                                <thead style="text-align: center">
                                    <tr>
                                        <th class="text-center align-middle">{{ __('STT') }}</th>
                                        <th class="text-center align-middle">{{ __('Hình thức coach') }}</th>
                                        <th class="text-center align-middle">{{ __('Kết quả đạt') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($data as $data)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td>{{ $data['coach_type_name'] }}</td>
                                            <td class="text-center">
                                                {{ $data['passed_question'] }}/{{ $data['total_question'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $(function() {
            $("#table").DataTable({
                lengthChange: false,
                pageLength: 20,
                searching: false,
                autoWidth: false,
                ordering: false,
                paging: false,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 500,
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop

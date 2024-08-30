@extends('layouts.master')

@section('title', 'Coach Phỏng vấn')

@section('heading')
    <form action="{{ route('coaching.coach_student', $coach_type_id) }}" method="post" id="form">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-6">
                @switch($coach_type_id)
                    @case(1)
                        {{ __('Coach Phỏng vấn') }}
                    @break

                    @case(2)
                        {{ __('Coach Chủ đề') }}
                    @break

                    @case(3)
                        {{ __('Coach Ngữ pháp Trung cấp') }}
                    @break

                    @case(4)
                        {{ __('Coach Câu 51') }}
                    @break

                    @case(5)
                        {{ __('Coach Câu 52') }}
                    @break

                    @case(6)
                        {{ __('Coach Câu 53') }}
                    @break

                    @default
                @endswitch
            </div>
            <div class="col-12 col-sm-6">
                <div class="row justify-content-end">
                    <div class="col-12 col-sm-2">
                        <label class="h6" for="student_id">{{ __('student') }}</label>
                    </div>
                    <div class="col-12 col-sm-auto">
                        <select id="student_id" name="student_id" class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value="0" selected></option>
                            @foreach ($students as $student)
                                <option value="{{ $student->user_id }}" @if ($student->user_id == $selected_student) selected @endif>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ($selected_student > 0)
                    <form action="{{ route('coaching.student_result.update', [$selected_student, $coach_type_id]) }}"
                        method="post" id="formSubmit">
                        @csrf
                        <div id="card-test" class="card card-default">
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <colgroup>
                                        <col style="width:5%;">
                                        <col style="width:5%;">
                                        <col style="width:10%;">
                                        <col style="width:35%;">
                                        <col style="width:35%;">
                                        <col style="width:10%;">
                                    </colgroup>
                                    <thead style="text-align: center">
                                        <tr>
                                            <th class="text-center align-middle">{{ __('ID') }}</th>
                                            <th class="text-center align-middle">{{ __('Kết quả') }}</th>
                                            <th class="text-center align-middle">{{ __('coach_subject') }}</th>
                                            <th class="text-center align-middle">{{ __('coach_question') }}</th>
                                            <th class="text-center align-middle">{{ __('suggest_answer') }}</th>
                                            <th class="text-center align-middle">{{ __('point') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coach_questions as $coach_question)
                                            <tr>
                                                <td class="text-center align-top">
                                                    <input type="checkbox" id="checkbox{{ $coach_question->id }}"
                                                        value="{{ $coach_question->id }}">
                                                </td>
                                                <td class="text-center align-top" id="result{{ $coach_question->id }}">
                                                    {{ isset($coach_question->pass) ? $coach_question->pass : 'Chưa đạt' }}
                                                </td>
                                                <td class="text-center align-top">
                                                    {{ $coach_question->coach_subject->subject_name }}
                                                </td>
                                                <td class="text-left ck-content align-top"
                                                    id="question{{ $coach_question->id }}">
                                                    {!! $coach_question->question !!}</td>
                                                <td class="text-left ck-content align-top">{!! $coach_question->suggest_answer !!}</td>
                                                <td class="text-center align-top"><input type="number"
                                                        id="question{{ $coach_question->id }}"
                                                        name="question{{ $coach_question->id }}" min="0"
                                                        max="10" placeholder="0" value="{{ $coach_question->point }}"
                                                        class="form-control text-center">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="modal1-content" class="modal-body">
                    <img class="modal-content" id="img01">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="modal2-content" class="modal-body p-0">
                    <img class="modal-content" id="img02">
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="btn-preview">Preview</button>
    <a id="btn-download" href="#" class="btn btn-secondary">Download</a>
    <h3>Preview :</h3>
    <div id="previewImage"></div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="/ckeditor/ckeditor5.css" />
    <link rel="stylesheet" type="text/css" href="/ckeditor/styles.css" />
    <style>
        img {
            width: 100%;
        }
    </style>
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#form').validate({
                rules: {
                    student_id: {
                        required: true,
                    },
                },
                messages: {
                    student_id: {
                        required: "{{ __('select_content') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-auto').append(error);

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

    {{-- // Bảng dữ liệu --}}
    <script>
        $(function() {
            $("#table").DataTable({
                lengthChange: false,
                pageLength: 20,
                searching: true,
                autoWidth: false,
                ordering: false,
                paging: false,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 500,
                dom: 'Bfrtip',
                buttons: [{
                        text: 'Cập nhật',
                        className: 'bg-olive',
                        action: function(e, dt, node, config) {
                            $('#table').dataTable().fnFilter('');
                            document.forms["formSubmit"].submit();
                        },
                    },
                    {
                        text: 'Copy',
                        className: 'bg-primary',
                        action: function(e, dt, node, config) {
                            xuatdulieu();
                        },
                    }
                ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>

    {{-- Phóng to ảnh --}}
    <script>
        var images = document.querySelectorAll('.image img')
        var modalImg = document.getElementById("img02");


        for (var i = 0; i < images.length; i++) {
            images[i].setAttribute("data-toggle", "modal");
            images[i].setAttribute("data-target", "#modal2");
            images[i].addEventListener("click", imgClick, false);
        }

        // Get the modal
        function imgClick() {
            modalImg.src = this.src;
        }
    </script>

    <script>
        var checkbox = document.querySelectorAll('input[type=checkbox]')
        var modal1 = new bootstrap.Modal(document.getElementById('modal1'), {});
        var modal1_content = document.getElementById('modal1-content');

        function xuatdulieu() {
            modal1_content.innerHTML = '<div class="text-bold">ĐỀ BÀI</div>';
            for (var i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked == true) {
                    var question = document.getElementById('question' + checkbox[i].value);
                    modal1_content.innerHTML = modal1_content.innerHTML + '<hr>' + question.innerHTML;
                }
            }
            modal1.show();
        }
    </script>

    {{-- <script type="text/javascript" src="/js/html2canvas.js"></script> --}}
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        
            var getCanvas; // global variable
            $('#btn-preview').on('click', function() {                
                html2canvas(document.querySelector('#modal1')).then(canvas => {
                    $('#previewImage').append(canvas);
                    getCanvas = canvas;
                });
            });

        $("#btn-download").on('click', function() {
            var imgageData = getCanvas.toDataURL("image/png");
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            $("#btn-download").attr("download", "your_pic_name.png").attr("href", newData);
        });
    </script>
@stop

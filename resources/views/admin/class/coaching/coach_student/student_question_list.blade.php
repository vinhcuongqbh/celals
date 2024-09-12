@extends('layouts.master')

@section('title', 'Coach Phỏng vấn')

@section('heading')
    COACHING
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div id="card-test" class="card card-default">
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:20%;">
                                <col style="width:75%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center align-middle">{{ __('ID') }}</th>
                                    <th class="text-center align-middle">{{ __('coach_subject') }}</th>
                                    <th class="text-center align-middle">{{ __('coach_question') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td class="text-center align-top">
                                            {{ $question->question->id }}
                                        </td>
                                        <td class="text-center align-top">
                                            {{ $question->coach_subject->subject_name }}
                                        </td>
                                        <td class="text-left ck-content align-top">
                                            {!! $question->question->question !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    {{-- // Bảng dữ liệu --}}
    <script>
        $(function() {
            $("#table").DataTable({
                sorting: false,
                fixedHeader: true,
                paging: false,
                responsive: true,
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
@stop

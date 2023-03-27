@extends('layouts.master2')

@section('title', 'CELALS')

@section('content')
    <div class="container-fluid">
        <div id="su-kien" class="row"
            style="padding: 50px 10px; display: flex; align-items: center; justify-content: center;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                <h3>SỰ KIỆN NỔI BẬT TẠI CELALS - IELTS 9.0</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="card" style="width: 100%">
                            <a href="/su-kien/1">
                                <img class="card-img-top img-fluid" src="/img/sukien1.png" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">THI THỬ MIỄN PHÍ 4 KỸ NĂNG IELTS CHUẨN QUỐC TẾ TẠI ĐỒNG HỚI</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="card" style="width: 100%">
                            <a href="/su-kien/2">
                                <img class="card-img-top img-fluid" src="/img/sukien2.png" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">GẶP GỠ ĐẠI DIỆN TRƯỜNG STANLEY COLLEGE</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop

@section('css')
    <style>
        .card-img-top {
            width: 100%;
            height: 250px;
        }
    </style>
@stop

@section('js')
@stop

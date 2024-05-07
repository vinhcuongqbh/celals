@extends('layouts.master2')

@section('title', 'CELALS')

@section('content')
    <div class="container">
        <div class="row" style="padding: 50px 0px">
            <div class="col-12 col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <b style="color: #03396c">DANH SÁCH CƠ SỞ ĐÀO TẠO</b>
                    </div>
                    <div class="card-body" style="text-align:justify">
                        <b style="color:#d30404">CƠ SỞ 1</b><br>
                        <b>Địa chỉ:</b> Số 35 Ngô Quyền, P. Đồng Phú, Đồng Hới, Quảng Bình.<br>
                        <b>Điện thoại:</b><br>
                        <b>Email:</b><br>
                        <hr>
                        <b style="color:#d30404">CƠ SỞ 2</b><br>
                        <b>Địa chỉ:</b> Số 04 Lê Đại Hành, Tiểu khu 3, TT. Hoàn Lão, Quảng Bình.<br>
                        <b>Điện thoại:</b><br>
                        <b>Email:</b><br>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-8" id="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3805.691600454876!2d106.6173562143045!3d17.47446890488858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314757dc86c5417b%3A0x166b4f7c790ef013!2zVHJ1bmcgVMOibSBBbmggTmfhu68gQ2VsYWxz!5e0!3m2!1svi!2s!4v1679988805826!5m2!1svi!2s"
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>
@stop

@section('js')

@stop

@section('css')

@stop

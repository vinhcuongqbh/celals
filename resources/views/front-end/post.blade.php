@extends('layouts.master2')

@section('title', 'CELALS')

@section('content')
    <div class="container-fluid">
        <div id="su-kien" class="row"
            style="padding: 50px 10px; display: flex; align-items: center; justify-content: center;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                <h3>{{ $post_catalogue->post_catalogue_name}}</h3>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-12 col-sm-4">
                            <div class="card" style="width: 100%">
                                <a href="/tin-tuc/{{ $post->post_id }}">
                                    <img class="card-img-top img-fluid" src="/storage/{{ $post->post_img }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-justify">{{ $post->post_title }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
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

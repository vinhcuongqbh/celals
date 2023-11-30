@extends('layouts.master2')

@section('title', 'CELALS')

@section('content')
    <div class="container-fluid">
        <div class="row" style="padding: 50px 10px; display: flex; align-items: center; justify-content: center;">
            <div class="col-12" style="color: #03396c; text-align:center; padding-bottom: 20px">
                <h3>{{ $post->post_title }}</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="width: 100%">
                            <div class="card-body">
                                {!! $post->post_content !!}
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

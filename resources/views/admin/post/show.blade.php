@extends('layouts.master')

@section('title', 'Post Create')

@section('heading')
    {{ __('post_management') }}
@stop

@section('content')
    <link rel="stylesheet" href="/css/content-styles.css" type="text/css">

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('new_post') }}</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="post_catalogue_id">{{ __('post_catalogue') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <select id="post_catalogue_id" name="post_catalogue_id" class="form-control custom-select">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="post_img">{{ __('post_img') }}</label>
                            </div>
                            {{-- <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="post_img" name="post_img"
                                                accept="image/*">
                                            <label class="custom-file-label" for="post_img"></label>
                                        </div>
                                    </div>
                                </div> --}}
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="post_title">{{ __('post_title') }}</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" id="post_title" name="post_title" value="{{ $post->post_title }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="post_content">{{ __('post_content') }}</label>
                            </div>
                            <div class="col-sm-10">                                
                                {!! $post->post_content !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-warning w-100 text-nowrap m-1"
                            href="{{ route('post.edit', $post->post_id) }}">{{ __('edit') }}</a>
                        <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                            href="{{ route('post') }}">{{ __('back') }}</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
@endsection

@section('js')
@stop

@extends('layouts.master')

@section('title', 'Block Show')

@section('heading')
    <label for="subject">{{ __('subject') }}:</label>{{ ' ' . $lesson->subject }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12 col-sm-6">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                    href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                    aria-selected="true">Phần nghe</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                    aria-selected="false">Đáp án</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-four-messages" role="tab"
                                    aria-controls="custom-tabs-four-messages" aria-selected="false">Tự phát âm</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                                aria-labelledby="custom-tabs-four-home-tab">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="">{{ __('link_audio') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <audio controls controlsList="nodownload" src="{{ $lesson->link_audio }}"></audio>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="student_answer">{{ __('student_answer') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea id="student_answer" name="student_answer" class="form-control" rows="18">{{ old('student_answer') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="">{{ __('link_audio') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <audio controls controlsList="nodownload" src="{{ $lesson->link_audio }}"></audio>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="answer">{{ __('answer') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea id="answer" name="answer" class="form-control" rows="10" readonly>{{ $lesson->answer }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="holder">
                                            <img id="imgPreview" alt="pic" src="{{ $lesson->link_answer }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-four-messages-tab">
                                <h1>Mic Recorder to Mp3 Example</h1>
                                <p>Check your web developer tool console.</p>

                                <hr />

                                <button class="btn btn-primary">Start recording</button>

                                <br />
                                <br />
                                <br />

                                <ul id="playlist"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">                       
                        <a class="btn bg-olive text-white text-nowrap m-1"
                            href="{{ route('listening.student_block_show') }}">{{ __('back') }}</a>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')

@endsection

@section('js')
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <script src="https://unpkg.com/mic-recorder-to-mp3"></script>
    {{-- <script src="../dist/index.js"></script> --}}
    <script>
        const button = document.querySelector('button');
        const recorder = new MicRecorder({
            bitRate: 128
        });

        button.addEventListener('click', startRecording);

        function startRecording() {
            recorder.start().then(() => {
                button.textContent = 'Stop recording';
                button.classList.toggle('btn-danger');
                button.removeEventListener('click', startRecording);
                button.addEventListener('click', stopRecording);
            }).catch((e) => {
                console.error(e);
            });
        }

        function stopRecording() {
            recorder.stop().getMp3().then(([buffer, blob]) => {
                console.log(buffer, blob);
                const file = new File(buffer, 'music.mp3', {
                    type: blob.type,
                    lastModified: Date.now()
                });

                const li = document.createElement('li');
                const player = new Audio(URL.createObjectURL(file));
                player.controls = true;
                li.appendChild(player);
                document.querySelector('#playlist').appendChild(li);

                button.textContent = 'Start recording';
                button.classList.toggle('btn-danger');
                button.removeEventListener('click', stopRecording);
                button.addEventListener('click', startRecording);
            }).catch((e) => {
                console.error(e);
            });
        }
    </script>
@stop

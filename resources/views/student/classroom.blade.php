@extends('default')
@section('title', 'Góc phụ huynh')
@section('content')
    <link href="{{ asset('web/css/room.css') }}" type="text/css" rel="stylesheet" media="all">
    <div class="bg-cl-eee">
        <div class="container py-md-5 pt-md-3 pb-sm-5">
            <div class="row">
                <div class="col-md-3 my-tp-5">
                    <div class="sec-main">
                        <a id="lop1">
                            <span class="sub-line">Mục lục</span>
                        </a>
                    </div>
                    <ul class="room-nav">
                        @foreach($classroom->theory as $theory)
                            <li class="room-nav-lesson border-bottom">{{ $theory->name }}
                                <div class="room-nav-lesson-name">{{ $theory->content }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-9 my-tp-5">
                    <div class="sec-main">
                        <a id="lop1">
                            <span class="sub-line">{{ $classroom->theory[0]->name }}: {{ $classroom->theory[0]->content }}</span>
                        </a>
                    </div>
                    <div class="bg-cl-fff">
                        <div class="container-fluid pt-4 pbt-4">
                            <div class="card-header">
                                <span class="sub-line">Video</span>
                            </div>
                            <div class="lesson-video">
                                <iframe width="560" height="315" src="{{ $classroom->theory[0]->video_link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="complete-button">
                                <button class="btn bg-theme mt-4 w3_pvt-link-bnr scroll bg-theme3 text-white">Học xong</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-cl-fff">
                        <div class="container-fluid pt-4 pbt-4">
                            <div class="card-header">
                                <span class="sub-line">Bài tập</span>
                            </div>
                            <div class="lesson-exercise">
                                <img src="{{ asset('web/images\exercise\0002.jpg') }}">
                                <img src="{{ asset('web/images\exercise\0003.jpg') }}">
                            </div>
                            <div class="list-lesson-answer">
                                <form id="question-1" class="lesson-answer">
                                    <span>Câu 1: </span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                        <label class="form-check-label" for="exampleRadios1">A</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">B</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">C</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">D</label>
                                    </div>
                                </form>
                                <form id="question-2" class="lesson-answer">
                                    <span>Câu 2: </span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                        <label class="form-check-label" for="exampleRadios1">A</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">B</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">C</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">D</label>
                                    </div>
                                </form>
                                <form id="question-3" class="lesson-answer">
                                    <span>Câu 3: </span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                        <label class="form-check-label" for="exampleRadios1">A</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">B</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">C</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">D</label>
                                    </div>
                                </form>
                                <form id="question-4" class="lesson-answer">
                                    <span>Câu 4: </span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                        <label class="form-check-label" for="exampleRadios1">A</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">B</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">C</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">D</label>
                                    </div>
                                </form>
                                <form id="question-5" class="lesson-answer">
                                    <span>Câu 5: </span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                        <label class="form-check-label" for="exampleRadios1">A</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">B</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">C</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">D</label>
                                    </div>
                                </form>
                                <form id="question-6" class="lesson-answer">
                                    <span>Câu 6: </span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                        <label class="form-check-label" for="exampleRadios1">A</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">B</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">C</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">D</label>
                                    </div>
                                </form>
                                <form id="question-7" class="lesson-answer">
                                    <span>Câu 7: </span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                        <label class="form-check-label" for="exampleRadios1">A</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">B</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">C</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">D</label>
                                    </div>
                                </form>
                            </div>
                            <div class="complete-button">
                                <button class="btn bg-theme mt-4 w3_pvt-link-bnr scroll bg-theme3 text-white">Nộp bài</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection



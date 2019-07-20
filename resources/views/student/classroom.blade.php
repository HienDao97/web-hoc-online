@extends('default')
@section('title', 'Danh sách khoá học')
@section('content')
    <?php
    if(count($theories) > 0){
        foreach ($theories as $theory) {
            if ($theory->id == $id_baihoc) {
                $theory_detail = $theory;
                preg_match('#https?://(?:www\.)?youtube\.com/watch\?v=#', $theory->video_link, $matches);
                $id = str_replace($matches, "", $theory->video_link);
            }
        }
    }else{
        $theory_detail = "";
    }


    ?>
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
                        @if(count($theories) > 0)
                            @foreach($theories as $key => $value)
                                @if($value->id != $id_baihoc)
                                    <a href="{{ route('student.classroom.exercise', ['id'=> $theory->classroom_id, 'id_baihoc' => $value->id]) }}">
                                        <li class="room-nav-lesson border-bottom">{{ $value->name }}
                                            {{--<div class="room-nav-lesson-name">{{ $value->content }}</div>--}}
                                        </li>
                                    </a>
                                @else
                                    <li class="room-nav-lesson border-bottom">{{ $value->name }}
                                        {{--<div class="room-nav-lesson-name">{{ $value->content }}</div>--}}
                                    </li>
                                @endif

                            @endforeach
                        @else
                            <li class="room-nav-lesson border-bottom">Lớp chưa mở
                                {{--<div class="room-nav-lesson-name">Lớp chưa mở</div>--}}
                            </li>
                        @endif

                    </ul>
                </div>
                <div class="col-md-9 my-tp-5">
                    @if(!empty($theory_detail))
                        <div class="sec-main">
                            <a id="lop1">
                                <span class="sub-line">{{ $theory_detail->name }}: {{ $theory_detail->content }}</span>
                            </a>
                        </div>
                        <div class="bg-cl-fff">
                            <div class="container-fluid pt-4 pbt-4">
                                <div class="card-header">
                                    <span class="sub-line">Video</span>
                                </div>
                                <div class="lesson-video">
                                    @if(!empty($id))
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $id }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    @else
                                        <div style="background-color: #cccccc7a; padding: 10px; margin-top: 5px; margin-bottom: 5px">
                                            <h5>Video đang cập nhật</h5>
                                        </div>
                                    @endif
                                </div>
                                <div class="complete-button">
                                    <button class="btn bg-theme mt-4 w3_pvt-link-bnr scroll bg-theme3 text-white">Học xong
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-cl-fff">
                            <div class="container-fluid pt-4 pbt-4">
                                <div class="card-header">
                                    <span class="sub-line">Bài tập</span>
                                </div>
                                <div style="background-color: #cccccc7a; padding: 10px; margin-top: 5px; margin-bottom: 5px">
                                    <h5>Các bạn chuẩn bị giấy, bút để hoàn thành các bài tập sau:</h5>
                                </div>
                                @if(!empty($exercise))
                                    <div class="lesson-exercise">
                                        <img src="{{ asset('web/images\exercise\0002.jpg') }}">
                                    </div>
                                    <form method="post" action="{{route('student.exercise.answer')}}" id="form-input">
                                        <input type="hidden" name="exercise" value="{{ $exercise->id }}">
                                        {{ csrf_field() }}
                                        <div class="list-lesson-answer" id="list-answer">
                                            @php
                                            $left = 0;
                                            $right = (int) ($answer_count/2);
                                            @endphp
                                            @for($i = 0; $i < $answer_count; $i++)
                                                @if($i % 2 == 0)
                                                    <div id="question-{{ $left +1 }}" class="lesson-answer">
                                                        <span>Câu {{ $left +1 }}: </span>
                                                        @foreach($list_answer as $key => $value)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answer[{{ $left }}][]"
                                                                       id="exampleRadios{{ $left }}{{ $key }}" value="{{ $key }}">
                                                                <label class="form-check-label"
                                                                       for="exampleRadios{{ $left }}{{ $key }}">{{ $value }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @php
                                                        $left = $left + 1;
                                                    @endphp
                                                @else
                                                    <div id="question-{{ $right +1 }}" class="lesson-answer">
                                                        <span>Câu {{ $right +1 }}: </span>
                                                        @foreach($list_answer as $key => $value)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answer[{{ $right }}][]"
                                                                       id="exampleRadios{{ $right }}{{ $key }}" value="{{ $key }}">
                                                                <label class="form-check-label"
                                                                       for="exampleRadios{{ $right }}{{ $key }}">{{ $value }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @php
                                                        $right = $right + 1;
                                                    @endphp
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="complete-button" id="button-submmit">
                                            <button class="btn bg-theme mt-4 w3_pvt-link-bnr scroll bg-theme3 text-white" id="button-submit" onclick="return onSubmitProject()">Nộp
                                                bài
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="lesson-exercise">
                                        Không có bài tập nào
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="sec-main">
                            <a id="lop1">
                                <span class="sub-line">Lớp chưa mở</span>
                            </a>
                        </div>
                        <div class="bg-cl-fff">
                            <div class="container-fluid pt-4 pbt-4">
                                <div class="card-header">
                                    <span class="sub-line">Video</span>
                                </div>
                                <div class="lesson-video">
                                    Không có video nào
                                </div>
                            </div>
                        </div>
                        <div class="bg-cl-fff">
                            <div class="container-fluid pt-4 pbt-4">
                                <div class="card-header">
                                    <span class="sub-line">Bài tập</span>
                                </div>

                                <div class="lesson-exercise">
                                    Không có bài tập nào
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function onSubmitProject() {
            var max_answer = "<?php echo $answer_count?>";
            var answer_count = $('input:radio:checked').length;
            if(answer_count == max_answer){
                btn_loading.loading("list-answer");
                formHelper.postFormJson('form-input', function (result) {
                    if (result.result == 0) {
                        btn_loading.hide("list-answer");
                        toastr.warning(result.message);
                    } else {
                        toastr.success(result.message);
                        btn_loading.hide("list-answer");
                        dialog.show('Kết quả', result.result);
                        $("#form-input").removeAttr("action");
                        $("#form-input").removeAttr("method");
                        $("#button-submmit").html("<button class=\"btn bg-theme mt-4 w3_pvt-link-bnr scroll bg-theme3 text-white\" type='button' id=\"button-submit\">Hoàn\n" +
                            "                                            thành\n" +
                            "                                        </button>")
                    }
                });
            }else{
                toastr.warning("Bạn chưa trả lời hết tất cả câu hỏi");
            }

        }
    </script>
@endsection



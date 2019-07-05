@extends('default')
@section('title', 'Góc phụ huynh')
@section('content')
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <div class="container pt-md-5 pt-4">
            <div class="sec-main">
                <span class="sub-line">Góc phụ huynh</span>
            </div>
            <div class="pb-lg-5 pb-sm-4">
                <ul class="demo row">
                    @if(count($comments) > 0)
                        @if(count($comments)%3 == 0){
                            @foreach ($comments as $comment)
                                <li class="col-lg-4  col-md-6">
                                    <div class="img-grid">
                                        <div class="gallery-grid1" style="text-align: center">
                                            @php
                                                $avatar = !empty($comment->avatar) ? $comment->avatar : "logo final 1.jpg"
                                            @endphp
                                            <img src="{{ asset("img/".$avatar) }}" alt=" " style="width: auto; height: 220px" class="img-fluid" />
                                        </div>
                                        <div class="port-desc text-center">
                                            <span class="line-wthree"></span>
                                            <h6 class="main-title-w3pvt text-center">Phụ huynh học sinh {{ $comment->student_name }}</h6>
                                            <p>
                                                {{ $comment->content }}
                                            </p>
                                            <p  class="text-theme">
                                                -{{ $comment->parent_name }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @elseif (count($comments)%3 == 1)
                            @for ($i=0; $i < count($comments) - 1; $i++)
                                <li class="col-lg-4  col-md-6">
                                    <div class="img-grid">
                                        <div class="gallery-grid1" style="text-align: center">
                                            @php
                                                $avatar = !empty($comments[$i]->avatar) ? $comments[$i]->avatar : "logo final 1.jpg"
                                            @endphp
                                            <img src="{{ asset("img/".$avatar) }}" alt=" " style="width: auto; height: 220px" class="img-fluid" />
                                        </div>
                                        <div class="port-desc text-center">
                                            <span class="line-wthree"></span>
                                            <h6 class="main-title-w3pvt text-center">Phụ huynh học sinh {{ $comments[$i]->student_name }}</h6>
                                            <p>
                                                {{ $comments[$i]->content }}
                                            </p>
                                            <p  class="text-theme">
                                                -{{ $comments[$i]->parent_name }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                            <li class="col-lg-12  col-md-12">
                                <div class="img-grid">
                                    <div class="gallery-grid1" style="text-align: center">
                                        @php
                                            $avatar = !empty($comments[$i]->avatar) ? $comments[$i]->avatar : "logo final 1.jpg"
                                        @endphp
                                        <img src="{{ asset("img/".$avatar) }}" alt=" " style="width: auto; height: 220px" class="img-fluid" />
                                    </div>
                                    <div class="port-desc text-center">
                                        <span class="line-wthree"></span>
                                        <h6 class="main-title-w3pvt text-center">Phụ huynh học sinh {{ $comments[$i]->student_name }}</h6>
                                        <p>
                                            {{ $comments[$i]->content }}
                                        </p>
                                        <p  class="text-theme">
                                            -{{ $comments[$i]->parent_name }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @else
                            @for ($i=0; $i < count($comments) - 2; $i++)
                                <li class="col-lg-4  col-md-6">
                                    <div class="img-grid">
                                        <div class="gallery-grid1" style="text-align: center">
                                            @php
                                                $avatar = !empty($comments[$i]->avatar) ? $comments[$i]->avatar : "logo final 1.jpg"
                                            @endphp
                                            <img src="{{ asset("img/".$avatar) }}" alt=" " style="width: auto; height: 220px" class="img-fluid" />
                                        </div>
                                        <div class="port-desc text-center">
                                            <span class="line-wthree"></span>
                                            <h6 class="main-title-w3pvt text-center">Phụ huynh học sinh {{ $comments[$i]->student_name }}</h6>
                                            <p>
                                                {{ $comments[$i]->content }}
                                            </p>
                                            <p  class="text-theme">
                                                -{{ $comments[$i]->parent_name }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                            @for ($i = count($comments) - 2; $i < count($comments); $i++) {
                                <li class="col-lg-6  col-md-6">
                                    <div class="img-grid" style="text-align: center">
                                        @php
                                            $avatar = !empty($comments[$i]->avatar) ? $comments[$i]->avatar : "logo final 1.jpg"
                                        @endphp
                                        <div class="gallery-grid1">
                                            <img src="{{ asset("img/".$avatar) }}" alt=" " style="width: auto; height: 220px" class="img-fluid" />
                                        </div>
                                        <div class="port-desc text-center">
                                            <span class="line-wthree"></span>
                                            <h6 class="main-title-w3pvt text-center">Phụ huynh học sinh {{ $comments[$i]->student_name }}</h6>
                                            <p>
                                                {{ $comments[$i]->content }}
                                            </p>
                                            <p  class="text-theme">
                                                -{{ $comments[$i]->parent_name }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                        @endif
                    @else
                        <li class="col-lg-12  col-md-12">
                            <div class="img-grid">
                                <div class="gallery-grid1" style="text-align: center">
                                    @php
                                        $avatar = !empty($comments[$i]->avatar) ? $comments[$i]->avatar : "logo final 1.jpg"
                                    @endphp
                                    <img src="{{ asset("img/".$avatar) }}" alt=" " style="width: auto; height: 220px" class="img-fluid" />
                                </div>
                                <div class="port-desc text-center">
                                    <span class="line-wthree"></span>
                                    <h6 class="main-title-w3pvt text-center">Không có cảm nhận nào</h6>
                                    <p>
                                        Không có cảm nhận nào
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endif
                    {{ $comments->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection

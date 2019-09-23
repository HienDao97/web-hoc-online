@extends('default')
@section('title', 'Tài liệu')
@section('content')
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <section class="team_wthree py-4" id="team">
            <div class="container py-lg-5">
                <div class="sec-main">
                    <span class="sub-line">Tài liệu</span>
                </div>
                <div class="container-grid py-4 py-lg-5">
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('home.document.course', $courses[0]->id) }}">
                            <div class="team-text bg-theme1">
                                <h4 class="text-theme1">Lớp 1</h4>
                                <span class="my-2 d-block">Tài liệu </span>
                                <p>Tổng hợp tài liệu hay về lớp 1.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('home.document.course', $courses[1]->id) }}">
                            <div class="team-text bg-theme2">
                                <h4 class="text-theme2">Lớp 2</h4>
                                <span class="my-2 d-block">Tài liệu </span>
                                <p>Tổng hợp tài liệu hay về lớp 2.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('home.document.course', $courses[2]->id) }}">
                            <div class="team-text bg-theme3">
                                <h4 class="text-theme3">Lớp 3</h4>
                                <span class="my-2 d-block">Sách luyện đề</span>
                                <p>Tổng hợp tài liệu hay về lớp 3.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <a href="{{ route('home.document.course', $courses[3]->id) }}">
                            <div class="team-text bg-theme4">
                                <h4 class="text-theme4">Lớp 4</h4>
                                <span class="my-2 d-block">Tài liệu </span>
                                <p>Tổng hợp tài liệu hay về lớp 4.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <a href="{{ route('home.document.course', $courses[4]->id) }}">
                            <div class="team-text bg-theme5">
                                <h4 class="text-theme5">Lớp 5</h4>
                                <span class="my-2 d-block">Tài liệu </span>
                                <p>Tổng hợp tài liệu hay về lớp 5.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


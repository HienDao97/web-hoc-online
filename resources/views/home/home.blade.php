@extends('default')
@section('title', 'Trang chủ')
@section('content')
    <section class="wthree-row  w3-about position-relative" id="about">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="1000">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="border-radius:50%; height: 10px; width: 10px"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" style="border-radius:50%; height: 10px; width: 10px"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2" style="border-radius:50%; height: 10px; width: 10px"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{ asset('web/images/banner1.jpg') }}" alt="First slide" style="height: 498px; ">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset('web/images/banner2.jpg') }}" alt="Second slide" style="height: 498px; ">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset('web/images/banner3.jpg') }}" alt="Third slide" style="height: 498px; ">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="sr-only">Next</span>
          </a>
        </div>
        @if(empty(Auth::user()->id))
            <div class="abt-pos" style="top: -74px;">
                <h4>Đăng ký tài khoản</h4>
                <div class="contcat-form">
                    <form action="{{ route('home.register.post') }}" method="post" class="register-wthree">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-white">
                                        Họ tên con
                                    </label>
                                    <input class="form-control" type="text" placeholder="Họ tên con" name="email" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-white">
                                        Số điện thoại phụ huynh
                                    </label>
                                    <input class="form-control" type="text" placeholder="Số điện thoại phụ huynh" name="email"
                                           required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-white">
                                        Mật khẩu
                                    </label>
                                    <input class="form-control" type="password" placeholder="Mật khẩu" name="email" required="">
                                </div>
                                <div class="col-md-6 mt-md-0 mt-4">
                                    <label class="text-white">
                                        Nhập lại mật khẩu
                                    </label>
                                    <input class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="name"
                                           required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-white">
                                        Email của phụ huynh
                                    </label>
                                    <input class="form-control" type="email" placeholder="Email của phụ huynh" name="email"
                                           required="">
                                </div>
                            </div>
                        </div>
                        <div class="sub-w3l">
                            <div class="sub-w3_pvt">
                                <input type="checkbox" id="brand2" value="">
                                <label for="brand2" class="mb-3 text-dark">
                                    <span></span>Tôi đồng ý với điều khoản của trang web</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit"
                                        class="btn  btn-block w-100 font-weight-bold text-capitalize bg-theme1 text-white">Đăng
                                    ký
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </section>
    <!-- //about -->
    <!-- portfolio -->
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <div class="container pt-md-5 pt-4" style="padding-top: 0.5rem !important;">
            <div class="sec-main">
                <span class="sub-line">Khóa học</span>
            </div>
            <div class="container" style="margin-bottom:  20px">
                <div class="row">
                    <?php
                        if(count($courses)%3 == 0){
                            foreach ($courses as $scourse) {
                                echo '<a href="'. route("home.classroom.detail", $courses[$i]->id) .'">
                                    <div class="col-lg-4">
                                        <div class="w3ls-servgrid card">
                                            <div class="card-header">
                                                <span class="sub-line">' . $course->name . '</span>
                                                <!--                             <h4 class="serv-title">
                                                                                Lớp
                                                                            </h4> -->
                                            </div>
                                            <div class="card-block">
                                                <p class="card-title servgrid-title">
                                                    ' . $course->class_info . '
                                                </p>
                                                <a href="#portfolio" class="text-capitalize servgrid_link btn scroll">Vào học</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                            }
                        } elseif (count($courses)%3 == 1) {
                            for ($i=0; $i < count($courses) - 1; $i++) {
                                echo '<a href="'. route("home.classroom.detail", $courses[$i]->id) .'">
                                    <div class="col-lg-4">
                                        <div class="w3ls-servgrid card">
                                            <div class="card-header">
                                                <span class="sub-line">' . $courses[$i]->name . '</span>
                                                <!--                             <h4 class="serv-title">
                                                                                Lớp
                                                                            </h4> -->
                                            </div>
                                            <div class="card-block">
                                                <p class="card-title servgrid-title">
                                                    ' . $courses[$i]->class_info . '
                                                </p>
                                                <a href="#portfolio" class="text-capitalize servgrid_link btn scroll">Vào học</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                            }
                            echo '<a href="'. route("home.classroom.detail", $courses[$i]->id) .'">
                                    <div class="col-lg-12">
                                        <div class="w3ls-servgrid card">
                                            <div class="card-header">
                                                <span class="sub-line">' . $courses[count($courses)]->name . '</span>
                                                <!--                             <h4 class="serv-title">
                                                                                Lớp
                                                                            </h4> -->
                                            </div>
                                            <div class="card-block">
                                                <p class="card-title servgrid-title">
                                                    ' . $courses[count($courses)]->class_info . '
                                                </p>
                                                <a href="#portfolio" class="text-capitalize servgrid_link btn scroll">Vào học</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                        } else{
                            for ($i=0; $i < count($courses) - 2; $i++) {
                                echo '<a href="'. route("home.classroom.detail", $courses[$i]->id) .'">
                                    <div class="col-lg-4">
                                        <div class="w3ls-servgrid card">
                                            <div class="card-header">
                                                <span class="sub-line">' . $courses[$i]->name . '</span>
                                                <!--                             <h4 class="serv-title">
                                                                                Lớp
                                                                            </h4> -->
                                            </div>
                                            <div class="card-block">
                                                <p class="card-title servgrid-title">
                                                    ' . $courses[$i]->class_info . '
                                                </p>
                                                <a href="" class="text-capitalize servgrid_link btn scroll"></a>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                            }
                            for ($i = count($courses) - 2; $i < count($courses); $i++) {
                                echo '<a href="'. route("home.classroom.detail", $courses[$i]->id) .'">
                                    <div class="col-lg-6">
                                        <div class="w3ls-servgrid card">
                                            <div class="card-header">
                                                <span class="sub-line">' . $courses[$i]->name . '</span>
                                                <!--                             <h4 class="serv-title">
                                                                                Lớp
                                                                            </h4> -->
                                            </div>
                                            <div class="card-block">
                                                <p class="card-title servgrid-title">
                                                    ' . $courses[$i]->class_info . '
                                                </p>
                                                <a href="" class="text-capitalize servgrid_link btn scroll"></a>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonials -->
    <div class="testimonials-wthree py-lg-5 py-4 text-center" id="testimonials">
        <div class="container">
            <div class="sec-main text-left">
                <span class="sub-line text-white">Cảm nhận của phụ huynh và học sinh</span>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto slide-left-wthree">
                    <div class="card mt-md-3">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel"
                             data-interval="100000">
                            <div class="w-100 carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-4">
                                                <div class="testi-img">
                                                    <img src="{{ asset('web/images/t1.jpg') }}" alt="" class="rounded-circle img-fluid"/>
                                                </div>
                                            </div>
                                            <div class="col-md-10 col-sm-8 mt-sm-0 mt-4">
                                                <h3>Cho con của tôi cơ hội</h3>
                                                <p class="my-3">Trước khi biết tới trang web, con tôi học rất kém và sợ
                                                    môn toán, sau khi biết đến trang web cháu đã thích thú với môn toán
                                                    hơn rất nhiều.</p>
                                                <p class="text-theme">- Phạm Văn Minh</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-4">
                                                <div class="testi-img">
                                                    <img src="{{ asset('web/images/t2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-md-10 col-sm-8 mt-sm-0 mt-4">
                                                <h3>Tôi yêu trang web này.</h3>
                                                <p class="my-3">Trước khi biết tới trang web, con tôi học rất kém và sợ
                                                    môn toán, sau khi biết đến trang web cháu đã thích thú với môn toán
                                                    hơn rất nhiều.</p>
                                                <p class="text-theme">- Phạm Văn Minh</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-4">
                                                <div class="testi-img">
                                                    <img src="{{ asset('web/images/t3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-md-10 col-sm-8 mt-sm-0 mt-4">
                                                <h3>Thật tuyệt vời!</h3>
                                                <p class="my-3">Trước khi biết tới trang web, con tôi học rất kém và sợ
                                                    môn toán, sau khi biết đến trang web cháu đã thích thú với môn toán
                                                    hơn rất nhiều.</p>
                                                <p class="text-theme">- Phạm Văn Minh</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right navi">
                                <a class="" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon ico" aria-hidden="true"></span>
                                    <span class="sr-only">Trước</span>
                                </a>
                                <a class="" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon ico" aria-hidden="true"></span>
                                    <span class="sr-only">Sau</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //testimonials -->
    <!-- contact -->
    <div class="contact-wthree pt-lg-5" id="contact">
        <div class="container py-sm-5 py-4">
            <div class="sec-main">
                <span class="sub-line">Thông tin Liên lạc</span>
                <h3 class="wthree-title">Gọi chúng tôi</h3>
            </div>
            <div class="row py-md-4">
                <div class="col-lg-12 px-lg-0">
                    <div class="w3_pvt-contact-top">
                        <ul class="d-flex header-w3pvt pt-0 flex-column">
                            <li>
                                <span class="fa fa-home"></span>
                                <p class="d-inline">Tòa CT1B - Khu đô thị Tân Tây Đô, Đan Phượng, Hà Nội.</p>
                            </li>
                            <li class="my-3">
                                <span class="fa fa-envelope-open"></span>
                                <a href="mailto:example@email.com" class="text-secondary">vutienthanh248@gmail.com</a>
                            </li>
                            <li>
                                <span class="fa fa-phone"></span>
                                <p class="d-inline">0976131472</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sec-main">
                <span class="sub-line">Tham gia nhóm học tập trên Facebook</span>
            </div>
            <div class="row py-md-4">
                <div class="col-lg-12 px-lg-0">
                    <div class="w3_pvt-contact-top">
                        <a href=""><button type="button" class="btn btn-large btn-block btn-primary" > Tham gia ngay!</button></a>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
    <!-- //contact -->
    <!-- map -->
    <div class="map p-2">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d930.7406871604132!2d105.700204712978!3d21.074149986921544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x784cffcfc82c13b!2zS2h1IMSQw7QgVGjhu4s!5e0!3m2!1svi!2s!4v1560619347723!5m2!1svi!2s"
            allowfullscreen></iframe>
    </div>

    <style type="text/css">
        .w3ls-servgrid{
            margin-bottom: 2em;
        }
    </style>
@endsection
    <!-- about -->

<!--// map-->

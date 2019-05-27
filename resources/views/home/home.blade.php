@extends('default')
@section('title', 'Quản lý học sinh')
@section('content')
    <section class="wthree-row  w3-about position-relative" id="about">
        <div class="container">
            <div class="about-head">
                <div class="sec-main">
                    <span class="sub-line">Giới thiệu về chúng tôi</span>
                    <h3 class="wthree-title">Chào mừng tới website của chúng tôi</h3>
                </div>
                <p>Chúng tôi cung cấp dịch vụ học toán chất lương cao cho học sinh tiểu học, chỉ cần ngồi tại nhà cũng có
                    thể học.</p>
                <p>Học sinh được hưởng chương trình đào tạo tốt nhất.</p>

                <div class="ab-btm">
                    <h4>Cung cấp kiến thức toán học cho</h4>
                    <ul class="list-about d-flex">
                        @foreach($courses as $course)
                            <li>
                                {{ $course->name }}
                            </li>
                        @endforeach
                    </ul>
                    <a class="btn bg-theme mt-4 w3_pvt-link-bnr scroll bg-theme3 text-white" href="#services" role="button">Xem
                        thêm</a>
                </div>
            </div>
        </div>
        <div class="abt-pos">
            <h4>Đăng ký tài khoản</h4>
            <div class="contcat-form">
                <form action="#" method="post" class="register-wthree">
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
                                echo '<a href="#' . $course->name . '">
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
                                echo '<a href="#' . $courses[$i]->name . '">
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
                            echo '<a href="#' . $courses[count($courses)]->name . '">
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
                                echo '<a href="#' . $courses[$i]->name . '">
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
                            for ($i = count($courses) - 2; $i < count($courses); $i++) { 
                                echo '<a href="#' . $courses[$i]->name . '">
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
                                                <a href="#portfolio" class="text-capitalize servgrid_link btn scroll">Vào học</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                            }
                        }
                    ?>
                </div>
            </div>
            {{--<div class="container" style="margin-bottom: 20px">--}}
                {{--<div class="row">--}}
                    {{--<a href="#lop4">--}}
                        {{--<div class="col-lg-6">--}}
                            {{--<div class="w3ls-servgrid card">--}}
                                {{--<div class="card-header">--}}
                                    {{--<span class="sub-line">Lớp 4</span>--}}
                                    {{--<!--                             <h4 class="serv-title">--}}
                                                                    {{--Lớp--}}
                                                                {{--</h4> -->--}}
                                {{--</div>--}}
                                {{--<div class="card-block">--}}
                                    {{--<p class="card-title servgrid-title">--}}
                                        {{--Cung cấp kiến thức về bảng cửu chương, cộng trừ nhân chia trong phạm vi 10.--}}
                                    {{--</p>--}}
                                    {{--<a href="#portfolio" class="text-capitalize servgrid_link btn scroll">Vào học</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                    {{--<a href="#lop5">--}}
                        {{--<div class="col-lg-6">--}}
                            {{--<div class="w3ls-servgrid card">--}}
                                {{--<div class="card-header">--}}
                                    {{--<span class="sub-line">Lớp 5</span>--}}
                                    {{--<!--                             <h4 class="serv-title">--}}
                                                                    {{--Lớp--}}
                                                                {{--</h4> -->--}}
                                {{--</div>--}}
                                {{--<div class="card-block">--}}
                                    {{--<p class="card-title servgrid-title">--}}
                                        {{--Cung cấp kiến thức về bảng cửu chương, cộng trừ nhân chia trong phạm vi 10.--}}
                                    {{--</p>--}}
                                    {{--<a href="#portfolio" class="text-capitalize servgrid_link btn scroll">Vào học</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="card-body">
            <h5 class="blog-title card-title font-weight-bold">
                <a href="#exampleModal4" data-toggle="modal" aria-pressed="false" data-target="#exampleModal4"
                   role="button" class="text-theme3">Cras ultricies ligula sed.</a>
            </h5>
            <p>At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit
                ametLorem ipsum dolor sit amet,sed diam nonumy.</p>
            <button type="button" class="btn blog-btn wthree-bnr-btn mt-3 w3_pvt-link-bnr" data-toggle="modal"
                    aria-pressed="false" data-target="#exampleModal4">
                Read more
            </button>
        </div>
    </div>
    </div>
    <!-- testimonials -->
    <div class="testimonials-wthree py-lg-5 py-4 text-center" id="testimonials">
        <div class="container">
            <div class="sec-main text-left">
                <span class="sub-line text-white">Bình luận của phụ huynh</span>
                <h3 class="wthree-title text-theme2">Hãy xem các phụ huynh nói gi?</h3>
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
                                                    <img src="images/t1.jpg" alt="" class="rounded-circle img-fluid"/>
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
                                                    <img src="images/t2.jpg" alt="" class="rounded-circle img-fluid">
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
                                                    <img src="images/t3.jpg" alt="" class="rounded-circle img-fluid">
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
                                <p class="d-inline">Số 26, ngách 241/61, ngõ chợ Khâm Thiên, Đống Đa, Hà Nội.</p>
                            </li>
                            <li class="my-3">
                                <span class="fa fa-envelope-open"></span>
                                <a href="mailto:example@email.com" class="text-secondary">info@example.com</a>
                            </li>
                            <li>
                                <span class="fa fa-phone"></span>
                                <p class="d-inline">0987654321</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 mt-4 px-0">
                        <!-- register form grid -->
                        <div class="contact-form">
                            <h4>Góp ý với chúng tôi</h4>
                            <form action="#" method="post" class="register-wthree">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>
                                                Họ tên
                                            </label>
                                            <input class="form-control" type="text" placeholder="Họ tên" name="email"
                                                   required="">
                                        </div>
                                        <div class="col-lg-4 my-lg-0 my-4">
                                            <label>
                                                Email
                                            </label>
                                            <input class="form-control" type="email" placeholder="example@email.com"
                                                   name="email" required="">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Số điện thoại
                                            </label>
                                            <input class="form-control" type="text" placeholder="xxxx xxxxxx"
                                                   name="email"
                                                   required="">
                                        </div>
                                        <div class="offset-lg-3">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-8">
                                            <label>
                                                Lời nhắn của bạn
                                            </label>
                                            <textarea placeholder="Nhập lời nhắn của bạn vào đây"
                                                      class="form-control"></textarea>
                                        </div>

                                        <div class="col-md-4 d-flex mt-4">
                                            <button type="submit"
                                                    class="btn btn-w3_pvt btn-block w-100 text-white font-weight-bold text-uppercase bg-theme1">
                                                Gửi lời nhắn
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //contact -->
    <!-- map -->
    <div class="map p-2">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.9503398796587!2d-73.9940307!3d40.719109700000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a27e2f24131%3A0x64ffc98d24069f02!2sCANADA!5e0!3m2!1sen!2sin!4v1441710758555"
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

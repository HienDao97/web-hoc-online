@extends('default')
@section('title', 'Trang chủ')
@section('content')
    <section class="container wthree-row  w3-about position-relative" id="about">
	<div class="main-slider">
		<div class="item image">
			<figure>
			  <div class="slide-image slide-media" style="background-image:url('http://admin.vutienthanh.com/img/slide/Anh dang website 2.jpg');">
			    <img data-lazy="http://admin.vutienthanh.com/img/slide/Anh dang website 2.jpg" class="image-entity" />
			  </div>
			</figure>
		</div>
		<div class="item image">
			<figure>
				<div class="slide-image slide-media" style="background-image:url('http://admin.vutienthanh.com/img/slide/Anh website.jpg');">
					<img data-lazy="http://admin.vutienthanh.com/img/slide/Anh website.jpg" class="image-entity" />
				</div>
			</figure>
		</div>
		<div class="item youtube">
			<iframe class="embed-player slide-media" width="750" height="500" src="https://www.youtube.com/embed/BA4FDlSsY1c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="item youtube">
			<iframe class="embed-player slide-media" width="750" height="500" src="https://www.youtube.com/embed/XqbA4ffnNnc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
        <div class="abt-pos register-form" style="top: -50px;">
            <h4 style="font-weight: bold;">Tin tức mới nhất</h4>
            <div class="contcat-form">
                <form action="http://vutienthanh.com/register" method="post" id="form-register" class="register-wthree">
                    <ul class="latest-posts">
                        @foreach($news as $new)
                            <li data-animation="fadeInLeft" class="animated fadeInLeft visible">
                                <div class="post-thumb">
                                    <img class="img-rounded" src="{{ env("ADMIN_APP_URL") . "/img/posts/{$new->thumbnail}" }}" alt="" title="" width="84" height="84">
                                </div>
                                <div class="post-details">
                                    <div class="description">
                                        <a href="#">
                                            <!-- Text -->
                                            {{ $new->summary }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
    </section>
    <div class="testimonials-wthree py-lg-5 py-4 text-center" id="testimonials">
        <div class="container">
            <div class="sec-main text-left">
                <span class="sub-line text-white">Hướng dẫn đăng ký học</span>
            </div>
            <div class="" style="padding-bottom: 20px; text-align: left;">
                <ul>
                    <li>
                        <label style="color: #f5f6f7; font-size: 20px;">Bước 1:</label> <a onclick="return register.create()" style="color: #f5f6f7;font-size: 20px;cursor: pointer;">&nbsp;Đăng ký tài khoản</a>
                    </li>
                    <li>
                        <label style="color: #f5f6f7; font-size: 20px;">Bước 2:</label> <a onclick="return login.create()" style="color: #f5f6f7;  font-size: 20px;cursor: pointer;">&nbsp;Đăng nhập</a>
                    </li>
                    <li>
                        <label style="color: #f5f6f7; font-size: 20px;">Bước 3:</label> <a href="http://vutienthanh.com/khoa-hoc" style="color: #f5f6f7; font-size: 20px;cursor: pointer;">&nbsp;Chọn khóa học trong trang Khóa học</a>
                    </li>
                    <li>
                        <label style="color: #f5f6f7; font-size: 20px;">Bước 4:</label> <a style="color: #f5f6f7; font-size: 20px;cursor: pointer;">&nbsp;Đăng ký khóa học theo hướng dẫn</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
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
                                                <span class="sub-line">' . $courses[$i]->name . '</span>
                                                <!--                             <h4 class="serv-title">
                                                                                Lớp
                                                                            </h4> -->
                                            </div>
                                            <div class="card-block">
                                                <p class="card-title servgrid-title">
                                                    ' . $courses[$iw]->class_info . '
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
                <span class="sub-line text-white">Cảm nhận phụ huynh</span>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto slide-left-wthree">
                    <div class="card mt-md-3">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="10000">
                            <div class="w-100 carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-4">
                                                <div class="testi-img">
                                                    <img src="http://vutienthanh.com/web/images/t1.jpg" alt="" class="rounded-circle img-fluid" />
                                                </div>
                                            </div>
                                            <div class="col-md-10 col-sm-8 mt-sm-0 mt-4">
                                                <h3>Cho con của tôi cơ hội</h3>
                                                <p class="my-3">Trước khi biết tới trang web, con tôi học rất kém và sợ môn toán, sau khi biết đến trang web cháu đã thích thú với môn toán hơn rất nhiều.</p>
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
                                                    <img src="http://vutienthanh.com/web/images/t2.jpg" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-md-10 col-sm-8 mt-sm-0 mt-4">
                                                <h3>Tôi yêu trang web này.</h3>
                                                <p class="my-3">Trước khi biết tới trang web, con tôi học rất kém và sợ môn toán, sau khi biết đến trang web cháu đã thích thú với môn toán hơn rất nhiều.</p>
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
                                                    <img src="http://vutienthanh.com/web/images/t3.jpg" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-md-10 col-sm-8 mt-sm-0 mt-4">
                                                <h3>Thật tuyệt vời!</h3>
                                                <p class="my-3">Trước khi biết tới trang web, con tôi học rất kém và sợ môn toán, sau khi biết đến trang web cháu đã thích thú với môn toán hơn rất nhiều.</p>
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
                                <span class="fa fa-home" style="font-size: 25px;"></span>
                                <p class="d-inline" style="color: #1b1e21">Tòa CT1B - Khu đô thị Tân Tây Đô, Đan Phượng, Hà Nội.</p>
                            </li>
                            <li class="my-3">
                                <span class="fa fa-envelope-open" style="font-size: 23px;"></span>
                                <a href="mailto:vutienthanh248@gmail.com" class="text-secondary" style="color: #1b1e21">vutienthanh248@gmail.com</a>
                            </li>
                            <li>
                                <span class="fa fa-phone" style="font-size: 25px;"></span>
                                <a href="tel:0976131472" class="d-inline" style="color: #1b1e21">0976131472</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 mt-4 px-0">
                        <!-- register form grid -->
                        <div class="contact-form">
                            <h4>Góp ý với chúng tôi</h4>
                            <form action="{{ route('gop.y') }}" method="post" class="register-wthree">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>
                                                Họ tên phụ huynh
                                            </label>
                                            <input class="form-control" type="text" placeholder="Họ tên phụ huynh" name="name"
                                                   required="">
                                        </div>
                                        <div class="col-lg-4 my-lg-0 my-4">
                                            <label>
                                                Năm sinh của con
                                            </label>
                                            <input class="form-control" type="text" placeholder="Năm sinh của con"
                                                   name="age" required="">
                                        </div>
                                        <div class="col-lg-4 my-lg-0 my-4">
                                            <label>
                                                Học lực của con
                                            </label>
                                            <input class="form-control" type="text" placeholder="Học lực của con"
                                                   name="type" required="">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-6">
                                            <label>
                                                Số điện thoại
                                            </label>
                                            <input class="form-control" type="text" placeholder="Số điện thoại"
                                                   name="mobile"
                                                   required="">
                                        </div>
                                        <div class="col-md-6 d-flex mt-4">
                                            <button type="submit"
                                                    class="btn btn-w3_pvt btn-block w-100 text-white font-weight-bold text-uppercase bg-theme1">
                                                Gửi thông tin
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sec-main">
                <span class="sub-line">Tham gia nhóm học tập trên Facebook</span>
            </div>
            <div class="row py-md-4">
                <div class="col-lg-12 px-lg-0">
                    <div class="w3_pvt-contact-top">
                        <a href=""><button type="button" class="btn btn-large btn-block btn-primary fa fa-facebook" style="padding-bottom: 15px;padding-top: 15px"><span style="font-family: Roboto">&nbsp;&nbsp;Tham gia ngay!</span></button></a>
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
@section('scripts')
    <script type="text/javascript">
        function onSubmitProject() {
            if($('#checkbox').is(":checked")){
                $("#message").html("");
                btn_loading.loading("form-register");
                formHelper.postFormJson('form-register', function (result) {
                    if (result.result == 1) {
                        toastr.success(result.message, {timeOut: 5000});
                        dialog.close();
                        btn_loading.loading("body");
                        window.location.reload();
                    } else {
                        btn_loading.hide("form-register");
                        var str = "<div class=\"alert alert-danger\">";
                        for(var key in result.message){
                            str += result.message[key];
                            str += "<br/>";
                        };

                        str += "</div>";
                        $("#register-message").append(str);
                    }
                });
            }else{
                toastr.warning("Hãy đồng ý điều khoản trước khi đăng kí", {timeOut: 5000});
            }

        }
        //document.ready(function () {
            @if(session()->has('messages'))
                console.log("{{session('messages')}}");
            toastr.success("{{session('messages')}}", {timeOut: 5000});
            @endif
        //});



    </script>
@endsection
    <!-- about -->

<!--// map-->

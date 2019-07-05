<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>@yield('title') | {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8"/>
    <meta name="keywords" content="Alphabet Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design"/>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="{{ asset('web/css/bootstrap.css') }}" type="text/css" rel="stylesheet" media="all">
    <!-- portfolio -->
    <link href="{{ asset('web/css/gallery.css') }}" type="text/css" rel="stylesheet" media="all">
    <!-- testimonials -->
    <link href="{{ asset('web/css/testimonials.css') }}" type="text/css" rel="stylesheet" media="all">
    <link href="{{ asset('web/css/style.css') }}" type="text/css" rel="stylesheet" media="all">
    <link href="{{ asset('web/css/home.css') }}" type="text/css" rel="stylesheet" media="all">
    <link href="{{ asset('waitMe/waitMe.css') }}" type="text/css" rel="stylesheet" media="all">

    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" media="all">

    <!-- font-awesome icons -->
    <link href="{{ asset('web/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!-- //online-fonts -->
    <link rel="icon" href="{{ asset('web/images/logo-3.png') }}" type="image/x-icon"/>

</head>

<body id="body">

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '1693554737437218',
            autoLogAppEvents : true,
            version          : 'v3.3'

        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="366964827423981"
     theme_color="#6699cc"
     logged_in_greeting="Xin chào! Tôi có thể giúp gì cho bạn"
     logged_out_greeting="Xin chào! Tôi có thể giúp gì cho bạn">
</div>

<!-- banner -->
@component('components.slider')@endcomponent
<!-- //banner -->
<!-- header -->

<header>
    @component('components.header')@endcomponent
</header>
<!-- //header -->
<!-- about -->
@yield('content')
<footer class="footer py-md-5 pt-md-3 pb-sm-5">
    @component('components.footer')@endcomponent
    <!-- //footer bottom -->
</footer>
<div class="cpy-right">
    @component('components.copy-right')@endcomponent
</div>
<!-- register -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
     style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Đăng ký tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-bg" id="modal_content">
            </div>
        </div>
    </div>
</div>

</body>
<script src="{{ asset('web/js/jquery-2.2.3.min.js') }}"></script>
<!-- //js -->
<!-- script for password match -->
<script>
</script>
<!-- script for password match -->
<!-- Banner  Responsiveslides -->
<script src="{{ asset('web/js/responsiveslides.min.js') }}"></script>
<script>
    // You can also use"$(window).load(function() {"
    $(function () {
        // Slideshow 4
        $("#slider3").responsiveSlides({
            auto: true,
            pager: true,
            nav: false,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script>
<!-- //Banner  Responsiveslides -->
<!-- gallery -->
<script src="{{ asset('web/js/jquery.picEyes.js') }}"></script>
<script src="{{ asset('web/js/counter.js') }}"></script>
<!-- //stats -->
<!-- start-smooth-scrolling -->
<script src="{{ asset('web/js/move-top.js') }}"></script>
<script src="{{ asset('web/js/easing.js') }}"></script>
<script>
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();

            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<script src="{{ asset('web/js/bootstrap.js') }}"></script>
<script src="{{ asset('js/init.js') }}"></script>
<script src="{{ asset('waitMe/waitMe.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>

@yield('scripts')

</html>

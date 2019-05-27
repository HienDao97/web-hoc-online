<div id="home" class="position-relative">
    <div class="header-main">
        <div class="d-sm-flex justify-content-between">
            <a href=""><img src="{{ asset('web/images/logo.png') }}" style="height: 130px"></a>
            <div class="hearder-right-w3_pvt d-flex justify-content-sm-end align-items-center  mt-sm-0 mt-4">
                <ul class="d-flex header-w3_pvt">
                    @if(empty(Auth::user()->id))
                        <li>
                            <button type="button" class="btn w3ls-btn d-block" onclick="return register.create()">
                                <span class="fa fa-sign-in"></span>Đăng ký
                            </button>
                        </li>
                        <li>
                            <button type="button" class="btn w3ls-btn btn-2  d-block" onclick="return login.create()">
                                <span class="fa fa-lock"></span>Đăng nhập
                            </button>
                        </li>
                    @else
                        <li>
                            <button type="button" class="btn w3ls-btn d-block">
                                <span class="fa fa-sign-in"></span>{{ Auth::user()->name }}
                            </button>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="callbacks_container">
    <ul class="rslides" id="slider3">
        <li class="slider-img">
            <div class="container-fluid px-0" style="height: 500px">
                <div class="row">
                    <div class="col-3 col-sm-6 px-0 bg-theme1 banner-left-grid">
                        <div class="banner-text h-100">
                        </div>
                    </div>
                    <div class="col-9 col-sm-6 banner banner1 banner-text">
                    </div>
                </div>
            </div>
        </li>
        <li class="slider-img">
            <div class="container-fluid px-0" style="height: 500px">
                <div class="row">
                    <div class="col-3 col-sm-6 px-0 bg-theme2 banner-left-grid">
                        <div class="banner-text h-100">
                        </div>
                    </div>
                    <div class="col-9 col-sm-6 banner banner2 banner-text">
                    </div>
                </div>
            </div>
        </li>
        <li class="slider-img">
            <div class="container-fluid px-0" style="height: 500px">
                <div class="row">
                    <div class="col-3 col-sm-6 px-0 bg-theme3 banner-left-grid">
                        <div class="banner-text h-100">
                        </div>
                    </div>
                    <div class="col-9 col-sm-6 banner banner3 banner-text">
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
<script type="text/javascript" src="{{ asset('js/login.js') }}"></script>

<div id="home" class="position-relative">
    <div class="header-main">
        <div class="d-sm-flex justify-content-between">
            <a href=""><img src="{{ asset('web/images/logo.png') }}" style="height: 80px"></a>
            <img class="sologan" src="{{ env("ADMIN_APP_URL") . "/img/banner/{$banner->images}" }}">
            <div class="hearder-right-w3_pvt d-flex justify-content-sm-end align-items-center  mt-sm-0 mt-4 login-row">
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
                            <button type="button" class="btn w3ls-btn btn-2  d-block">
                                <a href="{{ route('student.logout') }}" style="color: #fff; text-decoration: none;" ><span class="fa fa-sign-in"></span>Đăng xuất</a>
                            </button>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="callbacks_container">
    <div style="background-color: #248ab2; padding: 3em"></div>
</div>
<script type="text/javascript" src="{{ asset('js/login.js') }}"></script>

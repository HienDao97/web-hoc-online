<form method="post" class="p-sm-3" action="{{route('home.login')}}" id="form-input">
    {{ csrf_field() }}
    <div class="box-header" id="message"></div>
    <div class="form-group">
        <label for="password" class="col-form-label">Số điện thoại</label>
        <input type="text" class="form-control" placeholder="Số điện thoại" name="mobile"
               id="recipient-name"
               required="">
    </div>
    <div class="form-group">
        <label for="password" class="col-form-label">Mật khẩu</label>
        <input type="password" class="form-control" placeholder="Mật khẩu" name="password"
               id="password"
               required="">
    </div>
    <div class="right-w3l">
        <input type="submit" id="button-edit-plan" onclick="return onSubmitProject()" class="form-control bg-theme1" value="Đăng nhập">
    </div>
    <div class="row sub-w3l my-3">
        <div class="col-sm-6 sub-w3_pvt">
            <input type="checkbox" name="remember_me" id="brand1" value="">
            <label for="brand1" class="text-dark">
                <span></span>Ghi nhớ đăng nhập?</label>
        </div>
        <div class="col-sm-6 forgot-w3l text-sm-right">
            <a href="#" class="text-secondary" onclick="return forgotPassword.create()" >Quên mật khẩu?</a>
        </div>
    </div>
    <p class="text-center">Bạn chưa có tài khoản?
        <a href="#" data-toggle="modal" data-target="#exampleModal1" class="text-secondary"
           data-dismiss="modal">
            Đăng ký ngay</a>

    </p>
</form>
<script type="text/javascript" src="{{ "js/login.js" }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script type="text/javascript">
    function onSubmitProject() {
        $("#message").html("");
        btn_loading.loading("button-edit-plan");
        formHelper.postFormJson('form-input', function (result) {
            if (result.result == 1) {
                toastr.success(result.message);
                dialog.close();
                btn_loading.loading("comment_table");
                window.location.reload();
            } else {
                btn_loading.hide("button-edit-plan");
                var str = "<div class=\"alert alert-danger\">";
                for(var key in result.message){
                    str += result.message[key];
                    str += "<br/>";
                };

                str += "</div>";
                $("#message").append(str);
            }
        });
    }
</script>

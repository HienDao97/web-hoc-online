
<form method="post" class="p-sm-3" action="{{route('home.register')}}" id="form-input">
    {{ csrf_field() }}
    <div class="box-header" id="message"></div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Họ tên con</label>
        <input type="text" class="form-control" placeholder="Họ tên con" name="name"
               id="recipient-rname"
               required="">
    </div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Số điện thoại phụ huynh</label>
        <input type="text" class="form-control" placeholder="Số điện thoại phụ huynh" name="mobile"
               id="recipient-rname"
               required="">
    </div>
    <div class="form-group">
        <label for="password1" class="col-form-label">Mật khẩu</label>
        <input type="password" class="form-control" placeholder="Mật khẩu" name="password"
               id="password1"
               required="">
    </div>
    <div class="form-group">
        <label for="password2" class="col-form-label">Nhập lại mật khẩu</label>
        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu"
               name="password_confirmation" id="password2"
               required="">
    </div>
    <div class="form-group">
        <label for="recipient-email" class="col-form-label">Email của phụ huynh</label>
        <input type="email" class="form-control" placeholder="Email của phụ huynh" name="email"
               id="recipient-email"
               required="">
    </div>
    <div class="sub-w3l">
        <div class="sub-w3_pvt">
            <input type="checkbox" id="brand2" value="">
            <label for="brand2" class="mb-3 text-dark" >
                <span></span>Tôi đồng ý với điều khoản của trang web</label>
        </div>
    </div>
    <div class="right-w3l">
        <input type="submit" id="button-edit-plan" onclick="return onSubmitProject()" class="form-control bg-theme1" value="Đăng ký">
    </div>
</form>
<script type="text/javascript">
    function onSubmitProject() {
        $("#message").html("");
        btn_loading.loading("button-edit-plan");
        formHelper.postFormJson('form-input', function (result) {
            if (result.result == 1) {
                alert(result.message);
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

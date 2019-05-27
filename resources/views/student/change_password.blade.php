<form method="post" class="p-sm-3" action="{{route('student.change.password')}}" id="form-input">
    {{ csrf_field() }}
    <div class="box-header" id="message"></div>
    <div class="form-group">
        <label for="password" class="col-form-label">Mật khẩu mới</label>
        <input type="password" class="form-control" placeholder="Mật khẩu" name="password"
               id="password"
               required="">
    </div>
    <div class="form-group">
        <label for="password" class="col-form-label">Nhập lại mật khẩu mới</label>
        <input type="password" class="form-control" placeholder="Mật khẩu" name="password_confirmation"
               id="password"
               required="">
    </div>
    <div class="right-w3l">
        <input type="submit" id="button-edit-plan" onclick="return onSubmitProject()" class="form-control bg-theme1" value="Đăng nhập">
    </div>
</form>
<script type="text/javascript" src="{{ "js/login.js" }}"></script>
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

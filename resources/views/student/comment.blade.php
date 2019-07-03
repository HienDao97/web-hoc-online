<form method="post" class="p-sm-3" action="{{ route('student.comment') }}" id="form-input">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="password1" class="col-form-label">Họ tên phụ huynh</label>
        <input type="text" class="form-control" placeholder="Mời nhập tên" name="parent_name" id="password1"
               required="">
    </div>
    <div class="form-group">
        <label for="password2" class="col-form-label">Để lại cảm nghĩ</label>
        <textarea class="form-control" name="content" placeholder="Mời nhập cảm nghĩ"
                  required=""></textarea>
    </div>
    <div class="right-w3l">
        <input type="button" style="color:white" id="button-edit-plan" onclick="return onSubmitProject()" class="form-control bg-theme1" value="Xác nhận">
    </div>
</form>
<script type="text/javascript" src="{{ asset("js/login.js") }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script type="text/javascript">
    function onSubmitProject() {
        $("#message").html("");
        btn_loading.loading("form-input");
        formHelper.postFormJson('form-input', function (result) {
            if (result.result == 1) {
                toastr.success(result.message);
                dialog.close();
                btn_loading.loading("body", {timeOut: 5000});
                window.location.reload();
            } else {
                btn_loading.hide("form-input");
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

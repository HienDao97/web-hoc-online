<form method="post" class="p-sm-3" action="{{route('home.forgotPassword')}}" id="form-input">
    {{ csrf_field() }}
    <div class="box-header" id="message"></div>
    <div class="form-group">
        <label for="recipient-email" class="col-form-label">Email của phụ huynh</label>
        <input type="email" class="form-control" placeholder="Email của phụ huynh" name="email"
               id="recipient-email"
               required="">
    </div>
    <div class="right-w3l">
        <input type="submit" id="button-edit-plan" class="form-control bg-theme1" onclick="return onSubmitProject()" value="Xác nhận">
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

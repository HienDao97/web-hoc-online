
<style>
    table > thead > tr > th {
        border-bottom: 0;
        background: #248ab2;
        vertical-align: bottom;
        color: black;
    }
    .btn {
        background: #248ab2;
        color: black;
    }
    .bootstrap-datetimepicker-widget table td.day{
        color: black;
    }
    .ui-datepicker-prev span{
        background-color: white;
    }
    .ui-datepicker-next span{
        background-color: white;
    }
    .bootstrap-datetimepicker-widget table td.active{
        background-color: #248ab2;
    }
</style>
<form method="post" class="p-sm-6" action="{{route('home.register')}}" id="form-input">
    {{ csrf_field() }}
    <div class="box-header" id="message"></div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Họ tên con (*)</label>
        <input type="text" class="form-control" placeholder="Họ tên con" name="name"
               id="recipient-rname"
               required="">
    </div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Số điện thoại phụ huynh (*)</label>
        <input type="text" class="form-control" placeholder="Số điện thoại phụ huynh" name="mobile"
               id=""
               required="">
    </div>
    <div class="form-group">
        <label for="datetimepicker1" class="col-form-label">Ngày sinh (*)</label>
        <input type="text" id="datetimepicker1" autocomplete="off" class="form-control" placeholder="Ngày sinh" name="birthday"
               required="">
    </div>
    <div class="form-group">
        <label for="datetimepicker1" class="col-form-label">Trường học (*)</label>
        <input type="text" id="" autocomplete="off" class="form-control" placeholder="Trường học" name="school"
               required="">
    </div>
    <div class="form-group">
        <label for="password1" class="col-form-label">Mật khẩu (*)</label>
        <input type="password" autocomplete="off" class="form-control" placeholder="Mật khẩu" name="password"
               id="password1"
               required="">
    </div>
    <div class="form-group">
        <label for="password2" class="col-form-label">Nhập lại mật khẩu (*)</label>
        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu"
               name="password_confirmation" id="password2"
               required="">
    </div>
    <div class="form-group">
        <label for="recipient-email" class="col-form-label">Email của phụ huynh (*)</label>
        <input type="email" class="form-control" placeholder="Email của phụ huynh" name="email"
               id="recipient-email"
               required="">
    </div>
    <div class="form-group">
        <label for="province" class="col-form-label">Thành phố, tỉnh (*)</label>
        <select class="select2 form-control" id="province" name="province" onchange="return filterArea($(this).val(), 'district')">
            <option value="">-- Chọn thành phố --</option>
            @foreach($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="district" class="col-form-label">Quận, huyện </label>
        <select class="select2 form-control" id="district" name="district" onchange="return filterArea($(this).val(), 'commune')">
            <option value="">-- Chọn quận --</option>
        </select>
    </div>
    <div class="form-group">
        <label for="commune" class="col-form-label">Phường, xã</label>
        <select class="select2 form-control" name="commune" id="commune">
            <option value="">-- Chọn phường --</option>
        </select>
    </div>
    <div class="sub-w3l">
        <div class="sub-w3_pvt">
            <input type="checkbox" id="brand2" value="">
            <label for="brand2" class="mb-3 text-dark" >
                <span></span>Tôi đồng ý với điều khoản của trang web</label>
        </div>
    </div>
    <div class="right-w3l">
        <button type="button" id="button-edit-plan" style="color: white; font-weight: bold" onclick="return onSubmitProject()" class="form-control bg-theme1" >ĐĂNG KÍ</button>
    </div>
</form>
<script type="text/javascript">
    $('#datetimepicker1').datetimepicker({
        format: "DD-MM-YYYY",
    });
    $(".select2").select2();
    function onSubmitProject() {
        if($('#brand2').is(":checked")){
            $("#message").html("");
            btn_loading.loading("form-input");
            formHelper.postFormJson('form-input', function (result) {
                if (result.result == 1) {
                    toastr.success(result.message, {timeOut: 5000});
                    dialog.close();
                    btn_loading.loading("body");
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
        }else{
            toastr.warning("Hãy đồng ý điều khoản trước khi đăng kí", {timeOut: 5000})
        }

    }

    function filterArea(id, type) {
        $.ajax({
            data:{
                id : id,
                type: type,
            },
            url: "{{route('home.filter')}}",
            type: "GET",
            success: function (data) {
                if(data.result == 0){
                    alert(data.message);
                }else{
                    $("#" + type).html("");
                    $("#" + type).append(data.message);
                }
            }
        })
    }
</script>

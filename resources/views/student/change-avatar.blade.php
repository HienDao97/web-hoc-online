<form method="post" class="p-sm-3"id="form-input">
    {{ csrf_field() }}
    <div class="box-header" id="message"></div>
    <div class="form-group">
        <label for="password" class="col-form-label">Ảnh</label>
        <input type="file" class="form-control pull-right" onchange="readURL(this);"
               id="brand_image_new_url">
        <img src="{{ asset('/img/placeholder.png') }}" style="height: 250px;"
             id="image-url" class="form-control">
    </div>
    <div class="right-w3l">
        <button type="button" style="color:white" id="button-edit-plan" onclick="return onSubmitProject()" style="font-weight: bold" class="form-control bg-theme1" value="">ĐỔI ẢNH ĐẠI DIỆN</button>
    </div>
</form>
<script type="text/javascript" src="{{ asset("js/login.js") }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script type="text/javascript">
    function onSubmitProject() {
        $("#message").html("");
        btn_loading.loading("button-edit-plan");
        var new_image_url = $('#brand_image_new_url').prop('files')[0];

        var form_data = new FormData();
        form_data.append('file', new_image_url);
        form_data.append('_token', "{{ csrf_token() }}");
        btn_loading.loading("table");
        $.post({
            data: form_data,
            type: "POST",
            url: '{{ route('student.change.avatar', $item->id) }}',
            processData: false,
            cache: false,
            contentType: false,
            success: function (result) {
                btn_loading.hide("button-edit-plan");
                if (result.result == 1) {
                    toastr.success(result.message);
                    dialog.close();
                    btn_loading.loading("body");
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
            }
        });
    }

    $(document).ready(function () {
        var new_image_url = $('#brand_image_new_url').prop('files')[0];
        $("input[name=file]").val(new_image_url);
    });

    function readURL(input) {
        var new_image_url = $('#brand_image_new_url').prop('files')[0];
        $("input[name=file]").val(new_image_url);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image-url').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

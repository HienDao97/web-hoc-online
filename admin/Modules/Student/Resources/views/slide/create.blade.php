{!! Form::open(['method' => 'POST', 'route' => ['slide.create'], 'class' => 'validate', 'id' => 'form-input']) !!}
{{--<form method="post" action="{{route('product.comment.editComment', ['id'=>$item->id])}}" id="form-input">--}}
<div class="row">
    <div class="col-md-12">
        <div class="box no-border">
            <div id="message"></div>
            <div class="box-body">
                <div class="form-group">
                    <label>Ảnh (Chiều cao tối thiểu 500px)(*)</label>
                    <input type="file" class="form-control pull-right" onchange="readURL(this);"
                           id="brand_image_new_url">
                    <img src="{{ asset('/img/placeholder.png') }}" style="height: 250px;"
                         id="image-url" class="form-control">
                </div>
                <input type="hidden" value="" name="file">
            </div>

        </div>
    </div>

    <div class="col-md-6 text-right">
        <button type="button" id="button-edit-plan" onclick="return onSubmitProject()" class="btn btn-primary buttonsubmit">
            Lưu
        </button>
    </div>
    <div class="col-md-6 text-left">
        <a href="javascript:void(0)" class="btn btn-default" onclick="return dialog.close();">
            Huỷ bỏ
        </a>
    </div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
    function onSubmitProject() {
        $("#message").html("");
        btn_loading.loading("button-edit-plan");
        var new_image_url = $('#brand_image_new_url').prop('files')[0];

        var form_data = new FormData();
        form_data.append('file', new_image_url);
        btn_loading.loading("table");
        $.post({
            data: form_data,
            type: "POST",
            url: '{{ route('slide.create') }}',
            processData: false,
            cache: false,
            contentType: false,
            success: function (result) {
                btn_loading.hide("button-edit-plan");
                if (result.result == 1) {
                    alert(result.message);
                    dialog.close();
                    btn_loading.loading("post_table");
                    window.location.reload();
                } else {
                    alert(result.message);
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

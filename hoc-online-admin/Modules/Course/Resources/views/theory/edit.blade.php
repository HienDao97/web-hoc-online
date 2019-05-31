{!! Form::open(['method' => 'POST', 'route' => ['theory.edit', $item->id], 'class' => 'validate', 'id' => 'form-input']) !!}
{{--<form method="post" action="{{route('product.comment.editComment', ['id'=>$item->id])}}" id="form-input">--}}
<div class="row">
    <div class="col-md-12">
        <div class="box no-border">
            <div class="box-header" id="message"></div>
            <div class="box-body">
                <div class="form-group">
                    <label>Tên bài học(*)</label>
                    <input name="name" type="text" value="{{ $item->name }}" class="form-control" placeholder="Nhập vào tên lớp học" required>
                </div>
                <div class="form-group">
                    <label>Nội dung bài học(*)</label>
                    <textarea name="content" type="text" class="form-control" placeholder="Nhập vào mã nội dung bài học" required>{{ $item->content }}</textarea>
                </div>
                <div class="form-group">
                    <label>Link video(*)</label>
                    <input name="video_link" type="text" class="form-control" value="{{ $item->video_link }}" placeholder="Nhập vào thông tin về link video" required>
                </div>
                <div class="form-group">
                    <label>Khối lớp(*)</label>
                    <select class="form-control" name="course_id" id="course" onchange="return filterStudy($(this).val(), 'classroom')">
                        <option value="">-- Loại khoá học --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" <?php echo ($course->id == $item->course_id) ? "selected" : ""?>>{{ $course->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Khoá hoc(*)</label>
                    <select class="form-control" name="classroom_id" id="classroom">
                        <option value="">-- Khoá học --</option>
                        <option value="{{ $item->classroom_id }}" selected>{{ $item->classroom_name }}</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-6 text-right">
        <button type="button" id="button-edit-plan" onclick="return onSubmitProject()" class="btn btn-primary buttonsubmit">
            Cập nhật
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
        formHelper.postFormJson('form-input', function (result) {
            if (result.result == 1) {
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
    <?php if(!empty($item->course_id)){?>
        filterStudy("{{ $item->course_id }}", "classroom" , "{{ $item->classroom_id  }}");
    <?php } ?>
    function filterStudy(id, type, select_value) {
        $.ajax({
            data:{
                id : id,
                type: type,
                select_value: select_value
            },
            url: "{{route('exercise.filter')}}",
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

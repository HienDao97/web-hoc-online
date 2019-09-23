{!! Form::open(['method' => 'POST', 'route' => ['document.create'], 'class' => 'validate', 'id' => 'form-input']) !!}
{{--<form method="post" action="{{route('product.comment.editComment', ['id'=>$item->id])}}" id="form-input">--}}
<div class="row">
    <div class="col-md-12">
        <div class="box no-border">
            <div id="message"></div>
            <div class="box-body">
                <div class="form-group">
                    <label>Tiêu đề tài liệu(*)</label>
                    <input name="title" type="text" value="{{ old('email') }}" class="form-control" placeholder="Nhập vào tên lớp học" required>
                </div>
                <div class="form-group">
                    <label>Link tài liệu(*)</label>
                    <input name="link" type="text" class="form-control" placeholder="Nhập vào thông tin về link video" required>
                </div>
                <div class="form-group">
                    <label>Khối lớp(*)</label>
                    <select class="form-control" name="course_id" id="course">
                        <option value="">-- Khối lớp --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
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
</script>

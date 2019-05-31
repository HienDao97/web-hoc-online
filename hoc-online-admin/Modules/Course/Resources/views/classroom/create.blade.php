{!! Form::open(['method' => 'POST', 'route' => ['classroom.create'], 'class' => 'validate', 'id' => 'form-input']) !!}
{{--<form method="post" action="{{route('product.comment.editComment', ['id'=>$item->id])}}" id="form-input">--}}
<div class="row">
    <div class="col-md-12">
        <div class="box no-border">
            <div class="box-header" id="message"></div>
            <div class="box-body">
                <div class="form-group">
                    <label>Tên lớp(*)</label>
                    <input name="class_name" type="text" value="{{ old('email') }}" class="form-control" placeholder="Nhập vào tên lớp học" required>
                </div>
                <div class="form-group">
                    <label>Mã lớp học(*)</label>
                    <input name="code" type="text" value="{{ old('name') }}" class="form-control" placeholder="Nhập vào mã lớp học" required>
                </div>
                <div class="form-group">
                    <label>Học phí(*)</label>
                    <input name="tuition" type="text" class="form-control" placeholder="Nhập vào thông tin về học phí" required>
                </div>
                <div class="form-group">
                    <label>Trạng thái(*)</label>
                    <select class="form-control" name="status">
                        @php
                            $list = \Modules\Course\Entities\TheoryGroup::listStatus();
                        @endphp
                        <option value="">-- Trạng thái --</option>
                        @foreach($list as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Loại khoá học(*)</label>
                    <select class="form-control" name="course_id">
                        <option value="">-- Loại khoá học --</option>
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

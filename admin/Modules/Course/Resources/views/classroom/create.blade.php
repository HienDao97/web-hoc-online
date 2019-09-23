{!! Form::open(['method' => 'POST', 'route' => ['classroom.create'], 'class' => 'validate', 'id' => 'form-input']) !!}
{{--<form method="post" action="{{route('product.comment.editComment', ['id'=>$item->id])}}" id="form-input">--}}
<div class="row">
    <div class="col-md-12">
        <div class="box no-border">
            <div id="message"></div>
            <div class="box-body">
                <div class="form-group">
                    <label>Tên khóa học(*)</label>
                    <input name="class_name" type="text" value="{{ old('email') }}" class="form-control" placeholder="Nhập vào tên khóa học" required>
                </div>
                <div class="form-group">
                    <label>Mã khóa học(*)</label>
                    <input name="code" type="text" value="{{ old('name') }}" class="form-control" placeholder="Nhập vào mã khóa học" required>
                </div>
                <div class="form-group">
                    <label>Loại khóa học(*)</label>
                    <select class="form-control" name="type" id="type" onchange="filterHtml()">
                        <option value="1"> Trả tiền</option>
                        <option value="0"> Miễn phí</option>
                    </select>
                </div>
                <div id="cost">
                    <label><input type="checkbox" id="check_sale" name="check_sale" value="1">     Xác nhận muốn giảm giá cho lớp học này</label>
                    <div class="form-group">
                        <label>Số tiền giảm giá (*)</label>
                        <input name="sale" type="text" class="form-control sale" oninput="fomatPrice($(this))" placeholder="Nhập vào số tiền giảm giá" readonly>
                    </div>
                    <div class="form-group">
                        <label>Thời gian bắt đầu và kết thúc</label>
                        <div class='input-group date'>
                            <input type='text' class="form-control" id="datetimepicker1" name="time"  value="{{ Request::get('created_at') }}" readonly />
                            {{--<span class="input-group-addon">--}}
                            {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                            {{--</span>--}}
                            <label class="input-group-addon btn" for="date">
                                <span class="fa fa-calendar open-datetimepicker" disabled></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Học phí(*)</label>
                        <input name="tuition" type="text" class="form-control" oninput="fomatPrice($(this))" placeholder="Nhập vào thông tin về học phí" required>
                    </div>

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
                    <label>Năm học(*)</label>
                    <select class="form-control" name="course_id">
                        <option value="">-- Năm học --</option>
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


    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    function fomatPrice(_this) {
        var val = $(_this).val();
        val = val.replace(/\,/g, "");
        //console.log(val);
        var number = addCommas(val);
        $(_this).val(number);
    }

    function filterHtml() {
        var val = $('#type option:selected').val();
        if(val == "0"){
            $("#cost").html("");
        }else if(val == "1"){
            var str = "<label><input type=\"checkbox\" id=\"check_sale\" name=\"check_sale\" value=\"1\">     Xác nhận muốn giảm giá cho lớp học này</label>\n" +
                "                    <div class=\"form-group\">\n" +
                "                        <label>Số tiền giảm giá (*)</label>\n" +
                "                        <input name=\"sale\" type=\"text\" class=\"form-control sale\" oninput=\"fomatPrice($(this))\" placeholder=\"Nhập vào số tiền giảm giá\" readonly>\n" +
                "                    </div>\n" +
                "<div class=\"form-group\">\n" +
                "                        <label>Thời gian bắt đầu và kết thúc</label>\n" +
                "                        <div class='input-group date'>\n" +
                "                            <input type='text' class=\"form-control\" id=\"datetimepicker1\" name=\"time\" readonly  value=\"\" />\n" +
                "                            {{--<span class=\"input-group-addon\">--}}\n" +
                "                            {{--<span class=\"glyphicon glyphicon-calendar\"></span>--}}\n" +
                "                            {{--</span>--}}\n" +
                "                            <label class=\"input-group-addon btn\" for=\"date\">\n" +
                "                                <span class=\"fa fa-calendar open-datetimepicker\"></span>\n" +
                "                            </label>\n" +
                "                        </div>\n" +
                "                    </div>"+
                "                    <div class=\"form-group\">\n" +
                "                        <label>Học phí(*)</label>\n" +
                "                        <input name=\"tuition\" type=\"text\" class=\"form-control\" oninput=\"fomatPrice($(this))\" placeholder=\"Nhập vào thông tin về học phí\" required>\n" +
                "                    </div>";
            $(function () {
                $('#datetimepicker1').daterangepicker({
                    format: "DD-MM-YYYY",
                });
                $("#datetimepicker1").css('pointer-events', 'none');
            });
            $("#cost").html(str);
            $('#check_sale').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
            $('input').on('ifChecked',function(event){
                $('.sale').prop('required',true);
                $('.sale').prop('readonly',false);

                $("#datetimepicker1").css('pointer-events', '');
                $("#datetimepicker1").prop('readonly', false);
            });
            $('input').on('ifUnchecked',function(event){
                $('.sale').prop('required',false);
                $('.sale').prop('readonly',true);
                $('.sale').val("");

                $("#datetimepicker1").css('pointer-events', 'none');
                $("#datetimepicker1").prop('readonly', true);
            })
        }
    }

    $('#check_sale').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    $('input').on('ifChecked',function(event){
        $('.sale').prop('required',true);
        $('.sale').prop('readonly',false);

        $("#datetimepicker1").css('pointer-events', '');
        $("#datetimepicker1").prop('readonly', false);
    });
    $('input').on('ifUnchecked',function(event){
        $('.sale').prop('required',false);
        $('.sale').prop('readonly',true);
        $('.sale').val("");

        $("#datetimepicker1").css('pointer-events', 'none');
        $("#datetimepicker1").prop('readonly', true);
    })
    $(function () {
        $('#datetimepicker1').daterangepicker({
            format: "DD-MM-YYYY",
        });
        $("#datetimepicker1").css('pointer-events', 'none');

    });

</script>

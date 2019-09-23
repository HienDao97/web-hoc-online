{!! Form::open(['method' => 'POST', 'route' => ['classroom.edit', $item->id], 'class' => 'validate', 'id' => 'form-input']) !!}
{{--<form method="post" action="{{route('product.comment.editComment', ['id'=>$item->id])}}" id="form-input">--}}
<div class="row">
    <div class="col-md-12">
        <div class="box no-border">
            <div id="message"></div>
            <div class="box-body">
                <div class="form-group">
                    <label>Tên khóa học(*)</label>
                    <input name="class_name" type="text" value="{{ $item->class_name }}" class="form-control" placeholder="Nhập vào tên khóa học" required>
                </div>
                <div class="form-group">
                    <label>Mã khóa học(*)</label>
                    <input name="code" type="text" value="{{ $item->code }}" class="form-control" placeholder="Nhập vào mã khóa học" required>
                </div>
                <div class="form-group">
                    <label>Loại lớp học(*)</label>
                    <select class="form-control" name="type" id="type" onchange="filterHtml()">
                        <option value="1" <?php echo ($item->type == 1) ? "selected" : ""?>> Trả phí</option>
                        <option value="0" <?php echo ($item->type == 0) ? "selected" : ""?>> Miễn phí</option>
                    </select>
                </div>
                <div id="cost">
                @if($item->type == 1)
                    <label><input type="checkbox" id="check_sale" name="check_sale" value="1" <?php echo (!empty($item->sale))? "checked" : ""?>>     Xác nhận muốn giảm giá cho lớp học này</label>
                    <div class="form-group">
                        <label>Số tiền giảm giá (*)</label>
                        <input name="sale" type="text" class="form-control sale" oninput="fomatPrice($(this))" placeholder="Nhập vào số tiền giảm giá" value="<?php echo (!empty($item->sale))? number_format($item->sale) : ""?>" <?php echo (!empty($item->sale))? "" : "readonly"?>>
                    </div>
                    <div class="form-group">
                        <label>Thời gian bắt đầu và kết thúc</label>
                        <div class='input-group date'>
                            <input type='text' class="form-control" id="datetimepicker1" name="time" <?php echo (!empty($item->sale))? "" : "readonly"?>  value="" />
                            {{--<span class="input-group-addon">--}}
                            {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                            {{--</span>--}}
                            <label class="input-group-addon btn" for="date">
                                <span class="fa fa-calendar open-datetimepicker"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Học phí(*)</label>
                        <input name="tuition" type="text" class="form-control" oninput="fomatPrice($(this))" value="{{ number_format($item->tuition) }}" placeholder="Nhập vào thông tin về học phí" required>
                    </div>
                @endif
                </div>
                <div class="form-group">
                    <label>Trạng thái(*)</label>
                    <select class="form-control" name="status">
                        @php
                            $list = \Modules\Course\Entities\TheoryGroup::listStatus();
                        @endphp
                        <option value="">-- Trạng thái --</option>
                        @foreach($list as $key => $value)
                            <option value="{{ $key }}" <?php echo ($key == $item->status) ? "selected" : ""?>>{{ $value }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Năm học(*)</label>
                    <select class="form-control" name="course_id">
                        <option value="">-- Năm học --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" <?php echo ($course->id == $item->course_id) ? "selected" : ""?>>{{ $course->name }}</option>
                        @endforeach

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
    //filterHtml("{{ $item->type }}");
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
            });
            $(function () {
                $('#datetimepicker1').daterangepicker({
                    format: "DD-MM-YYYY",
                    startDate: moment("{{ $item->begin_date }}", "DD-MM-YYYY"),
                    endDate: moment("{{ $item->end_date }}", "DD-MM-YYYY")
                });
                $("#datetimepicker1").css('pointer-events', 'none');
            });
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
    });

    $(function () {
        $('#datetimepicker1').daterangepicker({
            format: "DD-MM-YYYY",
            startDate: moment("{{ \Carbon\Carbon::parse($item->begin_date)->format('d-m-Y') }}", "DD-MM-YYYY"),
            endDate: moment("{{ \Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}", "DD-MM-YYYY")
        });
        @if(empty($item->sale))
            $("#datetimepicker1").css('pointer-events', 'none');
        @endif
    });
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
        console.log(val);
        var number = addCommas(val);
        $(_this).val(number);
    }
</script>

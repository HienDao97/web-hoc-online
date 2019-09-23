@extends('layouts.admin_default')
@section('title', trans('core::user.title'))
@section('content')
    <section class="content-header">
        <h1>Tạo bài tập</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('exercise.index') }}"> Bài tập</a></li>
            <li class="active">Thêm mới</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới bài tập</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                {!! Form::open(['method' => 'POST', 'route' => ['exercise.store'], 'class' => 'validate','enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Tên bài tập(*)</label>
                            <input name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Nhập vào tên bài tập" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung bài tập</label>
                            <input type="file" name="content" class="form-control preview-upload-image"/>
                            <img src="{{asset('/img/logo.jpeg')}}" alt="" class="preview-feature-image preview-image"/>
                        </div>
                        <div class="form-group">
                            <label>Khối lớp</label>
                            <select id="course" class="form-control" name="course_id" onchange="filterStudy($(this).val(), 'classroom')">
                                <option value="">-- Chọn khoá học--</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Khoá học</label>
                            <select id="classroom" class="form-control" name="classroom_id" onchange="filterStudy($(this).val(), 'theory')">
                                <option value="">-- Chọn loại khoá học--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bài học</label>
                            <select id="theory" name="theory_id" class="form-control">
                                <option value="">-- Chọn bài học --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Số đáp án</label>
                            <div class="form-inline">
                                <input type="number" class="form-control" id="answer_count" value="">
                                <button id="submit_count" type="button" class="form-control btn-dark">Tạo thêm đáp án</button>
                            </div>
                        </div>
                        <div id="answer"></div>

                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <!-- /.row -->
            </div>
            <div class="box-footer" style="text-align: center">
                <a href="{{ route('exercise.index') }}" class="btn btn-default">Huỷ</a>
                {!! Form::button("Lưu", ['class' => 'btn btn-primary', 'type' => "submit"]) !!}
            </div>
            {!! Form::close() !!}
            <div class="overlay hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('admin-lte/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script>
        var value = 0;
        var last_value = 1;
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: "YYYY-MM-DD",
            });
        });

        $(document).ready(function(){
            $('.input-group-addon').click(function(){
                $('#datetimepicker1 ').datetimepicker("show","format:\"YYYY-MM-DD\"");
            });
        });

        function filterStudy(id, type) {
            $.ajax({
                data:{
                    id : id,
                    type: type
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
        $("#submit_count").on('click', function () {
            value += parseInt($("#answer_count").val());
            console.log(last_value, value);
            if(value == ""){
                alert("Hãy nhập số đáp án");
            }else{
                var str = "";
                //$("#answer").html("");
                $(".row-delete").remove();
                for(var i = last_value; i <= value; i++){
                    str += "<div class=\"form-group\">\n" +
                        "                            <label>Câu"+ i +"</label>\n" +
                        "                            <div class=\"form-inline\" id=exercise_"+ i +" \n" +

                        "  <label class=\"form-check-label\" for=\"\">A</label>\n" +

                        "  <input class=\"form-check-input\" type=\"radio\" id=\"\" name=answer["+ i +"][] value=\"1\">\n" +
                        "  <label class=\"form-check-label\" for=\"\">B</label>\n" +


                        "  <input class=\"form-check-input\" type=\"radio\" id=\"\" name=answer["+ i +"][] value=\"2\">\n" +
                        "  <label class=\"form-check-label\" for=\"\">C</label>\n" +


                        "  <input class=\"form-check-input\" type=\"radio\" id=\"\" name=answer["+ i +"][] value=\"3\">\n" +
                        "  <label class=\"form-check-label\" for=\"\">D</label>\n"+
                    "  <input class=\"form-check-input\" type=\"radio\" id=\"\" name=answer["+ i +"][] value=\"4\">\n";
                    if(i == value){
                        str += "<button type=\"button\" onclick='deleteRow($(this))' class=\"row-delete btn btn-danger btn-xs\"><i class=\"fa fa-trash\">Xoá</i></button>";
                    }
                    str += "                            </div>\n" +
                        "                        </div>";



                }
                last_value += parseInt($("#answer_count").val());
                $("#answer").append(str);
                console.log(last_value, value);
            }

        });

        function deleteRow(_this) {
            $(_this).parent().parent().html("");
            value = value - 1;
            last_value = last_value - 1;
            var str = "";
            str += "<button type=\"button\" onclick='deleteRow($(this))' class=\" row-delete btn btn-danger btn-xs\"><i class=\"fa fa-trash\">Xoá</i></button>";
            $("#exercise_" + value).append(str);
            console.log(last_value, value);
        }

    </script>
@endsection

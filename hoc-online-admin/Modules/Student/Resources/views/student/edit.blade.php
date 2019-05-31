@extends('layouts.admin_default')
@section('title', trans('core::user.title'))
@section('content')
    <section class="content-header">
        <h1>Quản lý học sinh</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('core.user.index') }}"> Học sinh</a></li>
            <li class="active">Thêm mới</li>
        </ol>
    </section>
    <style>
        .select2-container--default .select2-selection--multiple{
            width: 350px;
        }
        .select2-dropdown select2-dropdown--below{
            width: 350px;
        }
    </style>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới học sinh</h3>
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
                {!! Form::open(['method' => 'POST', 'route' => ['student.update', $student->id], 'class' => 'validate','enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Email(*)</label>
                            <input name="email" type="email" value="{{ $student->email }}" class="form-control" placeholder="Nhập vào tên người dùng" required>
                        </div>
                        <div class="form-group">
                            <label>Họ và tên(*)</label>
                            <input name="name" type="textbox" value="{{ $student->name }}" class="form-control" placeholder="Nhập vào email người dùng" required>
                        </div>
                        <label><input type="checkbox" id="check_change_password" name="check_change_password" value="1">     {{trans('core::user.change_password')}}</label>
                        <div class="form-group">
                            <label>Mật khẩu(*)</label>
                            <input name="password" type="password" class="form-control password" placeholder="Nhập vào mật khẩu" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nhập lại mật khẩu(*)</label>
                            <input name="password_confirmation" type="password" class="form-control password_confirmation" placeholder="Nhập lại mật khẩu" readonly>
                        </div>
                        <table class="table">
                            <thead>
                            <th>Khối lớp</th>
                            <th>Khoá học</th>
                            <th>Thêm</th>
                            </thead>
                            <tbody>
                            @if(!empty($courses))
                                @foreach($courses as $course)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="course[]" value="{{ $course->id }}">
                                        {{ $course->name }}
                                        <td>
                                            <select class="form-control select2" name="classroom[{{$course->id}}][]" id="classroom-{{ $course->id }}" multiple="true">
                                                @if(!empty($course->class))
                                                    @foreach($course->class as $class)
                                                        <option value="{{ $class->id }}" <?php echo (in_array($class->id, $studentclass)) ? "selected" : ""?>>{{ $class->class_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger" onclick="minusCollumn($(this))"><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="3">Không có khoá lớp nào</td></tr>
                            @endif
                            </tbody>
                        </table>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số điện thoại(*)</label>
                            <input name="mobile" type="text" class="form-control" value="{{ $student->mobile }}" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group remove-date">
                            <label>Ngày sinh</label>
                            <div class='input-group date'>
                                <input type='text' class="form-control" id="datetimepicker1" name="birthday"  value="{{ $student->birthday }}" />
                                {{--<span class="input-group-addon">--}}
                                {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                {{--</span>--}}
                                <label class="input-group-addon btn" for="date">
                                    <span class="fa fa-calendar open-datetimepicker"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Giới tính</label>
                            <select class="form-control" id="gender" name="gender">

                                <option value="0" <?php echo ($student->gender == 0)? "selected" : ""?>>Nữ</option>
                                <option value="1" <?php echo ($student->gender == 1)? "selected" : ""?>>Nam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái tài khoản</label>
                            <select class="form-control" id="gender" name="status">

                                <option value="0" <?php echo ($student->status == 0)? "selected" : ""?>>Chưa kích hoạt</option>
                                <option value="1" <?php echo ($student->status == 1)? "selected" : ""?>>Kích hoạt</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh đại diện</label>
                            <input type="file" name="avatar" class="form-control preview-upload-image"/>
                            @php
                                if(!empty($student->avatar)){
                                    $avatar = "img/user/".$student->avatar;
                                }else{
                                    $avatar = "img/logo.jpeg";
                                }
                            @endphp
                            <img src="{{asset('/'.$avatar)}}" alt="" class="preview-feature-image preview-image"/>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="box-footer" style="text-align: center">
                <a href="{{ route('student.index') }}" class="btn btn-default">Huỷ</a>
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

                    }else{
                        $("#" + type).html("");
                        $("#" + type).append(data.message);
                    }

                }
            })
        }

        function minusCollumn(_this) {
            $(_this).parent().parent().remove();
        }

        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        $('input').on('ifChecked',function(event){
            $('.password').prop('required',true);
            $('.password_confirmation').prop('required',true);
            $('.password').prop('readonly',false);
            $('.password_confirmation').prop('readonly',false);


        })
        $('input').on('ifUnchecked',function(event){
            $('.password').prop('required',false);
            $('.password_confirmation').prop('required',false);
            $('.password').prop('readonly',true);
            $('.password_confirmation').prop('readonly',true);
            $('.password').val("");
            $('.password_confirmation').val("");
        })

    </script>
@endsection

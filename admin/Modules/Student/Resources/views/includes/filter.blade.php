<div class="row">
    <div class="col-md-5">
        <div class="form-group no-margin remove-date">
            <label>Tên học sinh</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ Request::get('name') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group no-margin remove-date">
            <label>Thời gian tạo</label>
            <div class='input-group date'>
                <input type='text' class="form-control" id="datetimepicker1" name="created_at"  value="{{ Request::get('created_at') }}" onchange="return filter()" />
                {{--<span class="input-group-addon">--}}
                {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                {{--</span>--}}
                <label class="input-group-addon btn" for="date">
                    <span class="fa fa-calendar open-datetimepicker"></span>
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-3 pull-right">
        <div class="form-group">
            <label style="visibility: hidden">TK</label>
            <button type="submit" class="btn btn-primary btn-block" onclick="return filter()"><span class="glyphicon glyphicon-search" aria-hidden="true" ></span> Tìm kiếm</button>
        </div>
    </div>
    <div class="col-md-4">
        <label>Khối lớp</label>
        <select class="form-control" id="course" name="course_id" onchange="filterStudy($(this).val(), 'classroom')">
            <option value="">-- Khối lớp --</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" <?php echo ($course->id == old('course'))? "selected": ""?>>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Khoá học</label>
            <select class="form-control" name="classroom_id" id="classroom">
                <option value="-1">-- Khoá học --</option>
            </select>
        </div>
    </div>


</div>

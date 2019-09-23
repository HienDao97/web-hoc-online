<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Khối lớp(*)</label>
            <select class="form-control" name="course_id" id="course" onchange="return filterStudy($(this).val(), 'classroom')">
                <option value="">-- Khối lớp --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach

            </select>
        </div>
    </div>

    <div class="col-md-4 pull-right">
        <div class="form-group">
            <label style="visibility: hidden">TK</label>
            <button type="submit" class="btn btn-primary btn-block" onclick="return filter()"><span class="glyphicon glyphicon-search" aria-hidden="true" ></span> Search</button>
        </div>
    </div>


</div>
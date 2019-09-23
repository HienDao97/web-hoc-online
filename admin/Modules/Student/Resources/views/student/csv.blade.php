<table id="post_table" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Trạng thái</th>
        <th>Giới tính</th>
        <th>Khối lớp</th>
        <th>Khoá lớp</th>
        <th>Thời gian tạo</th>
    </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td>#{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->mobile }}</td>
                <td>{{ ($student->status == 1) ? "Kích hoạt" : "Chưa kích hoạt" }}</td>
                <td>{{ ($student->gender == 1) ? "Nam" : "Nữ" }}</td>
                <td>{{ $student->course_name }}</td>
                <td>{{ $student->classroom_name }}</td>
                <td>{{ $student->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
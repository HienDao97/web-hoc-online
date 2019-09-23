@extends('layouts.admin_default')
@section('title', 'Quản lý khóa học')
@section('content')
    <section class="content-header">
        <h1>Quản lý khóa học</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Danh sách các khóa học</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if(\Illuminate\Support\Facades\Session::has('header_message'))
                    <div class="alert {{ \Illuminate\Support\Facades\Session::get('alert-class', 'alert-success') }} alert-dismissible auto-hide-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="text-center"><i class="icon fa fa-check"></i> {{ \Illuminate\Support\Facades\Session::get('header_message') }}</h4>
                    </div>
                @endif
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header">
                        @include('student::includes.message')
                        <h3 class="box-title">Danh sách khóa học</h3>
                        @if(Auth::user()->hasPermission(\Illuminate\Support\Facades\Session::get('controller'), "create"))
                            <div class="pull-right">
                                <a class="btn btn-success btn-sm" href="#" onClick="return classroomHelper.create()">Thêm mới khóa học</a>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <table id="post_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên khóa học</th>
                                <th>Mã khóa học</th>
                                <th>Năm học</th>
                                <th>Loại lớp học</th>
                                <th>Học phí</th>
                                <th>Trạng thái</th>
                                <th>Số bài học</th>
                                <th>Số học sinh trong lớp</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="overlay hide">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/theory_group.js') }}"></script>
    <script>

        $(function() {
            table=$('#post_table').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                searching: false,
                ajax: {
                    url: '{{ route("classroom.get") }}',
                    type: 'get',
                    data: function(d) {
                        {{--d.name = $('#name').val();--}}
                        {{--d.created_at = $('#datetimepicker1').val();--}}
                        {{--d.category = $('#category option:selected').val();--}}
                        {{--d.csrf = '{{csrf_field()}}';--}}
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'class_name'},
                    {data: 'code'},
                    {data: 'name'},
                    {data: 'type'},
                    {data: 'tuition'},
                    {data: 'status'},
                    {data: 'number_of_unit', sortable: true},
                    {data: 'student_count', sortable: true},
                    {data: 'created_at', sortable: true,name:'classroom.created_at'},
                    {data: 'actions', orderable: false}
                ],
                "order": [[ 0, "desc" ]],
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi trên một trang",
                    "zeroRecords": "Không tìm bản ghi phù hợp",
                    "info": "Đang hiển thị trang _PAGE_ of _PAGES_",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ tổng số _MAX_ bản ghi)",
                    "info": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ kết quả",
                    "paginate": {
                        "previous":   "«",
                        "next":       "»"
                    },
                    "sProcessing": '<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading'
                },
                "columnDefs": [
                    { "width": "18%", "targets": 7},
                    {"width": "13%", "targets": 7}
                ]
            });
        });

    </script>
@endsection

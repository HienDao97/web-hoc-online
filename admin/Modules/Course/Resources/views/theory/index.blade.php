@extends('layouts.admin_default')
@section('title', 'Quản lý bài học')
@section('content')
    <section class="content-header">
        <h1>Quản lý bài học</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Danh sách các bài học</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header">
                        <h3 class="box-title">Lọc bài học</h3>
                        @include('student::includes.message')
                        @if(session()->has('messages'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thành công</h4>
                                {{session('messages')}}
                            </div>
                        @else
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('course::includes.theory.filter')
                    </div><!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
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
                        <h3 class="box-title">Danh sách bài học</h3>
                        @if(Auth::user()->hasPermission(\Illuminate\Support\Facades\Session::get('controller'), "create"))
                            <div class="pull-right">
                                <a class="btn btn-success btn-sm" href="#" onClick="return theoryHelper.create()">Thêm mới bài họcc</a>
                            </div>
                        @endif

                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <table id="post_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên bài học</th>
                                <th>Khối lớp</th>
                                <th>Khoá học</th>
                                <th>Link video</th>
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
                    url: '{{ route("theory.get") }}',
                    type: 'get',
                    data: function(d) {
                        d.classroom_id = $('#classroom option:selected').val();
                        d.csrf = '{{csrf_field()}}';
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'classroom_name'},
                    {data: 'course_name'},
                   
                    {data: 'video_link'},
                    {data: 'created_at', sortable: true,name:'theories.created_at'},
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
                    { "width": "18%", "targets": 5},
                    {"width": "13%", "targets": 5}
                ]
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

        function filter(){
            table.draw();
        }

    </script>
@endsection

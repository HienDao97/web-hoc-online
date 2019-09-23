@extends('layouts.admin_default')
@section('title', 'Quản lý học sinh')
@section('content')
    <section class="content-header">
        <h1>Quản lý bình luận</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Danh sách bình luận</li>
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
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <table id="post_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên học sinh</th>
                                <th>Tên phụ huynh</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                                <th>Thời gian tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($comments) > 0)
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->student_name }}</td>
                                        <td>{{ $comment->parent_name }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td><button class="btn btn-xs btn-{{ ($comment->public == 1) ? "success" : "default" }}">{{ ($comment->public == 1) ? "Công khai " : "Không công khai" }}</button></td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td>
                                            <a href="#" onclick="commentHelper.edit('{{ $comment->id }}')" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="4">Không có dữ liệu</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            {{ $comments->links() }}
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset("js/slide.js") }}"></script>
@endsection
